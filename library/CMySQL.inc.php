<?php
// Объект для работы с БД
class CMySQL
{
	private static $instance; // экземпляр класса
	private static $link;
	// Получение экземпляра класса
	// результат - экземпляр класса CMySQL
	public static function Instance()
	{
		if(self::$instance == null) self::$instance = new CMySQL();
		return self::$instance;
	}
	private function __construct()
	{
		setlocale(LC_ALL, 'ru_RU.UTF-8'); // Языковая настройка.
		self::$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME); // Подключение к БД
		if(mysqli_connect_errno()){ printf("Connect failed: %s\n", mysqli_connect_error()); exit(); }
		mysqli_query(self::$link, 'SET NAMES utf8');
	}
	// Выборка строк
	// $query - SQL запрос
	// результат - массив выбранных объектов
	public function Select($query)
	{
		$result = mysqli_query(self::$link, $query);
		if(!$result) die(mysqli_error(self::$link));
		$n = mysqli_num_rows($result);
		$arr = array();
		for($i = 0; $i < $n; $i++)
		{
			$row = mysqli_fetch_assoc($result);
			$arr[] = $row;
		}
		return $arr;
	}
	// Экранирует специальные символы в строке
	public function Real_escape_string($str)
	{
		return mysqli_real_escape_string(self::$link, $str);
	}
	// Вставка строки
	// $table - имя таблицы
	// $object - ассоциативный массив с парами вида "имя столбца - значение"
	// результат - идентификатор новой строки
	public function Insert($table, $object)
	{
		$columns = array();
		$values = array();
		foreach($object as $key => $value)
		{
			$key = $this->Real_escape_string($key . '');
			$columns[] = $key;
			if($value === null) $values[] = 'NULL';
			else
			{
				$value = $this->Real_escape_string($value . '');
				$values[] = "'$value'";
			}
		}
		$columns_s = implode(',', $columns);
		$values_s = implode(',', $values);
		$result = mysqli_query(self::$link, "INSERT INTO $table ($columns_s) VALUES ($values_s)");
		if(!$result) die(mysqli_error(self::$link));
		return mysqli_insert_id(self::$link);
	}
	// Изменение строк
	// $table - имя таблицы
	// $object - ассоциативный массив с парами вида "имя столбца - значение"
	// $where - условие (часть SQL запроса)
	// результат - число измененных строк
	public function Update($table, $object, $where)
	{
		$sets = array();
		foreach($object as $key => $value)
		{
			$key = $this->Real_escape_string($key . '');
			if($value === null) $sets[] = "$key=NULL";
			else
			{
				$value = $this->Real_escape_string($value . '');
				$sets[] = "$key='$value'";
			}
		}
		$sets_s = implode(',', $sets);
		$result = mysqli_query(self::$link, "UPDATE $table SET $sets_s WHERE $where");
		if(!$result) die(mysqli_error(self::$link));
		return mysqli_affected_rows(self::$link);
	}
	// Удаление строк
	// $table - имя таблицы
	// $where - условие (часть SQL запроса)
	// результат - число удаленных строк
	public function Delete($table, $where)
	{
		$result = mysqli_query(self::$link, "DELETE FROM $table WHERE $where");
		if(!$result) die(mysqli_error(self::$link));
		return mysqli_affected_rows(self::$link);
	}
}
?>