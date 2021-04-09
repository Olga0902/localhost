<?php
// Контроллер авторизации пользователя
class CAuth extends CAuthBase
{
	protected $message;
	public function __construct(){ parent::__construct(); $this->message = null; }
	public function Before(){ parent::Before(); }
	public function Method_login()
	{
		$mUsers = CUsers::Instance();
		$mUsers->Logout();
		$mUsers->ClearSessions();
		if($this->isPost())
		{
			if($mUsers->Login($_POST['login'], $_POST['password'])) $this->Redirect('/');
			else $this->message = '<font color="#ff0000">Ошибка авторизации:</font> Вы ввели неправильный логин или пароль';
		}
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_login.inc.tpl', array('message' => $this->message));
	}
	public function Method_logout()
	{
		$mUsers = CUsers::Instance();
		$mUsers->Logout();
		$mUsers->ClearSessions();
		$this->Redirect('/login');
	}
}
?>