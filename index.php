<?php
// 0 - запретить вывод ошибок и предупреждений
// -1 - вывод всех ошибок и предупреждений, необходимо на этапе разработки
error_reporting(-1);
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
header("Content-Type:text/html;charset='utf-8'");
header("Pragma: no-cache");

// Путь к папке, где размещается библиотека классов реализующих работу сайта (файлы имя класса.inc.php)
define('DIR_LIB', 'library/');
// Подключаем файл настроек сайта
include_once(DIR_LIB."config/config.inc.php");

function __autoload($ClassName){ include_once(DIR_LIB."$ClassName.inc.php"); }

session_start();

$cmd = isset($_GET['page']) ? strip_tags($_GET['page']) : '';
$router = new CRouter($cmd);
$router->Request();
?>