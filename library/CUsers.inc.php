<?php
// Менеджер пользователей - администраторы и операторы
class CUsers
{
	private static $instance; // экземпляр класса
	private $db; // объект для работы с БД
	private $sid; // идентификатор текущей сессии
	private $uid; // идентификатор текущего пользователя
	private $onlineMap; // карта пользователей online
	private $privileges_cache; // кэш привиллегий пользователя, чтобы БД не мучать при вызове метода Can
	// Получение экземпляра класса
	// результат - экземпляр класса CUsers
	public static function Instance()
	{
		if(self::$instance == null) self::$instance = new CUsers();
		return self::$instance;
	}
	private function __construct()
	{
		$this->db = CMySQL::Instance();
		$this->sid = null;
		$this->uid = null;
		$this->onlineMap = null;
		$this->privileges_cache = array();
	}
	public function All()
	{
		return $this->db->Select("SELECT * FROM users");
	}
	// Добавить пользователя
	public function Add($fields)
	{
		if(trim($fields['password']) == "") unset($fields['password']);
		else $fields['password'] = md5($fields['password']);
		return $this->db->Insert("users", $fields);
	}
	// Редактирование данных пользователя
	public function Edit($id_user, $fields)
	{
		if(trim($fields['password']) == "") unset($fields['password']);
		else $fields['password'] = md5($fields['password']);
		$id_user = (int)$id_user;
		return $this->db->Update("users", $fields, "id_user=".$id_user);
	}
	// Удаление пользователя
	public function Delete($id_user)
	{
		$id_user = (int)$id_user;
		// Если это главный админ сайта, то его удалить нельзя
		if($id_user == 1) return false;
		return $this->db->Delete('users', 'id_user='.$id_user);
	}
	
	// Очистка неиспользуемых сессий
	public function ClearSessions()
	{
		// Если сессия старее 20 мин. удаляем
		$min = date('Y-m-d H:i:s', time() - 60 * 20);
		$t = "time_last < '%s'";
		$where = sprintf($t, $min);
		$this->db->Delete('sessions', $where);
	}
	// Авторизация
	// $login 		- логин
	// $password 	- пар/оль
	// результат	- true или false
	public function Login($login, $password)
	{
		// вытаскиваем пользователя из БД
		$user = $this->GetByLogin($login);
		if($user == null) return false;
		$id_user = $user['id_user'];
		// проверяем пароль
		if($user['password'] != md5($password)) return false;
		// открываем сессию и запоминаем SID
		$this->sid = $this->OpenSession($id_user);
		return true;
	}
	// Выход
	public function Logout()
	{
		unset($_SESSION['sid']);
		$this->sid = null;
		$this->uid = null;
		// вытаскиваем пользователя из БД
		$user = $this->Get();
		if($user == null) return false; else return true;
	}
	// Получение пользователя
	// $id_user 	- если не указан, брать текущего
	// результат	- объект пользователя
	public function Get($id_user = null)
	{
		// Если id_user не указан, берем его по текущей сессии
		if($id_user == null) $id_user = $this->GetUid();
		if($id_user == null) return null;
		// А теперь просто возвращаем пользователя по id_user
		$query = sprintf("SELECT * FROM users WHERE id_user = '%d'", $id_user);
		$result = $this->db->Select($query);
		return isset($result[0]) ? $result[0] : null;
	}
	// Получает пользователя по логину
	public function GetByLogin($login)
	{
		$query = sprintf("SELECT * FROM users WHERE login = '%s'", $this->db->Real_escape_string($login));
		$result = $this->db->Select($query);
		return isset($result[0]) ? $result[0] : null;
	}
	// Проверка наличия привилегии
	// $privileges 	- имя привилегии
	// $id_user 	- если не указан, значит, для текущего
	// результат	- true или false
	public function Can($privileges, $id_user = null)
	{
		if($id_user == null) $id_user = $this->GetUid();
		if($id_user == null) return false;
		if(!isset($this->privileges_cache[$privileges][$id_user]))
		{
			$query = sprintf("SELECT count(*) as bool_level FROM users WHERE id_user = '%d' AND access_level = '%d'", $id_user, $privileges);
			$result = $this->db->Select($query);
			$this->privileges_cache[$privileges][$id_user] = ($result[0]['bool_level'] > 0);
		}
		return $this->privileges_cache[$privileges][$id_user];
	}
	// Проверка активности пользователя
	// $id_user 	- идентификатор
	// результат	- true если online
	public function IsOnline($id_user)
	{
		if($this->onlineMap == null)
		{
			$query = sprintf("SELECT DISTINCT id_user FROM sessions", $id_user);
			$result = $this->db->Select($query);
			foreach($result as $item) $this->onlineMap[$item['id_user']] = true;
		}
		return ($this->onlineMap[$id_user] != null);
	}
	// Получение id текущего пользователя
	// результат - UID
	public function GetUid()
	{
		// Проверка кеша
		if($this->uid != null) return $this->uid;
		// Берем по текущей сессии
		$sid = $this->GetSid();
		if($sid == null) return null;
		$query = sprintf("SELECT id_user FROM sessions WHERE sid = '%s'", $this->db->Real_escape_string($sid));
		$result = $this->db->Select($query);
		// Если сессию не нашли - значит пользователь не авторизован
		if(count($result) == 0) return null;
		// Если нашли - запоминм ее
		$this->uid = $result[0]['id_user'];
		return $this->uid;
	}
	// Функция возвращает идентификатор текущей сессии
	// результат - SID
	private function GetSid()
	{
		// Проверка кеша
		if($this->sid != null) return $this->sid;
		// Ищем SID в сессии
		$sid = isset($_SESSION['sid']) ? $_SESSION['sid'] : null;
		// Если нашли, попробуем обновить time_last в базе
		// Заодно и проверим, есть ли сессия там
		if($sid != null)
		{
			$session = array();
			$session['time_last'] = date('Y-m-d H:i:s');
			$where = sprintf("sid = '%s'", $this->db->Real_escape_string($sid));
			$affected_rows = $this->db->Update('sessions', $session, $where);
			if($affected_rows == 0)
			{
				$query = sprintf("SELECT count(*) FROM sessions WHERE sid = '%s'", $this->db->Real_escape_string($sid));
				$result = $this->db->Select($query);
				if($result[0]['count(*)'] == 0) $sid = null;
			}
		}
		// Запоминаем в кеш.
		if($sid != null) $this->sid = $sid;
		// Возвращаем, наконец, SID
		return $sid;
	}
	// Открытие новой сессии
	// результат - SID
	private function OpenSession($id_user)
	{
		// генерируем SID
		$sid = $this->GenerateStr(10);
		// вставляем SID в БД
		$now = date('Y-m-d H:i:s');
		$session = array();
		$session['id_user'] = $id_user;
		$session['sid'] = $sid;
		$session['time_start'] = $now;
		$session['time_last'] = $now;
		$this->db->Insert('sessions', $session);
		// регистрируем сессию в PHP сессии
		$_SESSION['sid'] = $sid;
		// возвращаем SID
		return $sid;
	}
	// Генерация случайной последовательности
	// $length 		- ее длина
	// результат	- случайная строка
	private function GenerateStr($length = 10)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;
		while(strlen($code) < $length) $code .= $chars[mt_rand(0, $clen)];
		return $code;
	}
}
?>
