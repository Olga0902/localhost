<?php
// Базовый класс контроллера
abstract class CController
{
	protected $Parameters; // массив с параметрами - полученный методом $_GET
	protected abstract function Render(); // Генерация внешнего шаблона
	protected abstract function Before(); // Функция отрабатывающая до основного метода
	public function Go($Method, $Parameters)
	{
		$this->Parameters = $Parameters;
		$this->Before();
		$this->$Method();
		$this->Render();
	}
	// Запрос произведен методом GET?
	protected function IsGet(){ return $_SERVER['REQUEST_METHOD'] == 'GET'; }
	// Запрос произведен методом POST?
	protected function IsPost(){ return $_SERVER['REQUEST_METHOD'] == 'POST'; }
	// Генерация HTML шаблона в строку.
	protected function Template($fileName, $vars = array())
	{
		// Установка переменных для шаблона.
		foreach($vars as $value => $variable) $$value = $variable;
		// Генерация HTML в буфер
		ob_start();
		@include "$fileName";
		return ob_get_clean();
	}
	// Если вызвали метод, которого нет - завершаем работу
	public function __call($Name, $Parameters){ $this->Page_Number404(); }
	protected function Page_Number404()
	{
		$object = new CPage();
		$object->Go('Method_Page_404', array());
		die();
	}
	// Для прехода на другие страницы или сайты
	protected function Redirect($url)
	{
		if($url[0] == '/') $url = BASE_URL.substr($url, 1);
		header("location: $url");
		exit();
	}
}
?>