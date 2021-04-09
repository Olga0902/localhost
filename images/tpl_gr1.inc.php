<?php
require_once ('../library/jpgraph/jpgraph.php');
require_once ('../library/jpgraph/jpgraph_pie.php');
require_once ('../library/jpgraph/jpgraph_pie3d.php');

$data = array(4, 5, 12,10,4,20,45);
$usluga = array("Хлеб Белковой Киевский", "Хлеб «Бородинский 1939»", "Хлеб «Пшенично-ржаной»", "Хлеб «Пшеничный»","Хлеб Азиатский 550г","Хлеб <Медовый безжрожжевой>","Хлеб солодовый");
// Создаём график
$graph = new PieGraph(725, 350);
$graph->clearTheme();
// убираем совершенно неуместную в данном случае рамку
$graph->SetFrame(false);
// Заголовок графика
$graph->title->Set("Відсоткове відношення реалізації  хліба за місяць ");
$graph->title->SetFont(FF_ARIAL, FS_BOLD, 13);
$graph->title->SetColor('#0000CD');
$graph->SetColor('#BC8F8F');
$graph->SetFrame(true, 'green', 3);
// Создаём круговую диаграмму 3D
$plot = new PiePlot3D($data);
// Угол наклона диаграммы
$plot->SetAngle(45);
// Размер диаграммы [0 - 0.5]
$plot->SetSize(0.4);
// Выделения кусочка "пирога", указывается номер последовательности
$plot->ExplodeSlice(6);
// Расположение диаграммы
$plot->SetCenter(0.25);
// Подписи для сегментов диаграммы
$plot->SetLegends($usluga);
// Присоединяем диаграмму к графику
$graph->Add($plot);
// Выводим график
$graph->Stroke();
?>
