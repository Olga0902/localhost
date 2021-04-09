<?php
// Базовый контроллер авторизации пользователя
abstract class CAuthBase extends CController
{
	protected $title; // заголовок страницы
	protected $content; // содержание страницы
	protected $styles; // css стили
	protected $scripts; // js-скрипты страницы
	function __construct()
	{
		$this->styles = array('style');
		$this->scripts = array();
	}
	protected function Before()
	{
		$this->title = 'Авторизация пользователя';
		$this->content = '';
	}
	// Генерация базового шаблона
	public function Render()
	{
		echo $this->Template(DIR_TEMPLATES.'tpl_basic.inc.tpl', array('title' => $this->title, 'content' => $this->content, 'styles' => $this->styles, 'scripts' => $this->scripts));
	}
}
?>