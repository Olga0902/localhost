<?php
// Контроллер страниц сайта
class CAdminUsersPage extends CBase
{
	public function __construct(){ parent::__construct(); }
	public function Before(){ parent::Before(); }
	public function Method_Index()
	{
		if(!CUsers::Instance()->Can(7)) $this->Page_Number404();
		$this->title .= 'Інформація про користувачів';
		$db = CMySQL::Instance();
		$result = $db->Select("SELECT * FROM users");
		$html = $this->Template(DIR_TEMPLATES.'tpl_users.inc.tpl', array('content' => $result));
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Інформація про користувачів', 'content' => $html));
	}
}
?>
