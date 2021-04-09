<?php
// Базовый контроллер сайта
abstract class CBase extends CController
{
	protected $title; // заголовок страницы
	protected $content; // содержание страницы
	protected $keywords; // ключивые слова
	protected $description; // описание страницы
	protected $needLogin; // необходима ли авторизация?
	protected $user; // авторизованный пользователь || null
	protected $styles; // css стили
	protected $scripts; // js-скрипты страницы
	function __construct()
	{
		$this->needLogin = true;
		$this->description = '';
		$this->keywords = '';
		$this->styles = array('style', 'menu');
		$this->scripts = array();
		$this->user = CUsers::Instance()->Get();
	}
	protected function Before()
	{
		if($this->needLogin && $this->user === null) $this->Redirect('/login');
		$this->title = '&laquo;Пример CMS&raquo; &bull; ';
		$this->content = '';
	}
	// Генерация базового шаблона
	public function Render()
	{
		$nav = $this->Template(DIR_TEMPLATES.'tbl_nav.inc.tpl');
		echo $this->Template(DIR_TEMPLATES.'tpl_basic.inc.tpl', array('title' => $this->title, 'content' => $this->content, 'description' => $this->description, 'keywords' => $this->keywords, 'styles' => $this->styles, 'scripts' => $this->scripts, 'nav' => $nav));
	}
}
?>