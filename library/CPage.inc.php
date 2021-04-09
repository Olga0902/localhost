<?php
// Контроллер страниц сайта
class CPage extends CBase
{
	public function __construct(){ parent::__construct(); }
	public function Before(){ parent::Before(); }
	public function Method_Index()
	{
		$this->title .= '';
		$this->keywords .= 'главная станица';
		$this->description .= 'описание страницы';
		$users = CUsers::Instance();
		//$users->Add(Array('login' => 'dec', 'password' => '12345', 'access_level' => 5));
		//$users->Edit(3, Array('password' => '', 'access_level' => 7));
		//$users->Delete(3);
		//if($users->IsOnline(1)) $html = "On"; else $html = "Off";
		$html = $this->Template(DIR_TEMPLATES.'tpl_index.inc.tpl');
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => '', 'content' => $html));
	}
	public function Method_Video()
	{
		if(!CUsers::Instance()->Can(7) && !CUsers::Instance()->Can(4)) $this->Page_Number404();
		$this->title .= 'Відеоспостереження';
		$this->keywords .= 'Відео';
		$this->description .= 'Відеоспостереження';
		$html = $this->Template(DIR_TEMPLATES.'tpl_video.inc.tpl');
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Відеоспостереження', 'content' => $html));
	}
	public function Method_Pronas()
	{
if(!CUsers::Instance()->Can(7)  && !CUsers::Instance()->Can(0)) $this->Page_Number404();
		$this->title .= 'Про нас';
		$this->keywords .= 'Про нас';
		$this->description .= 'Про нас';
		$html = $this->Template(DIR_TEMPLATES.'tpl_pronas.inc.tpl');
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Про нас', 'content' => $html));
	}
	public function Method_Kontakt()
	{
if(!CUsers::Instance()->Can(7)  && !CUsers::Instance()->Can(0)) $this->Page_Number404();
		$this->title .= 'Контакти';
		$this->keywords .= 'Контакти';
		$this->description .= 'Контакти';
		$html = $this->Template(DIR_TEMPLATES.'tpl_konakt.inc.tpl');
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Ви можете з нами зєднатись по таким контактам', 'content' => $html));
	}
	public function Method_Poradu()
	{
if(!CUsers::Instance()->Can(7)  && !CUsers::Instance()->Can(0)) $this->Page_Number404();
		$this->title .= 'Поради';
		$this->keywords .= 'Поради';
		$this->description .= 'Поради';
		$html = $this->Template(DIR_TEMPLATES.'tpl_poradu.inc.tpl');
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Прийміть до уваги!', 'content' => $html));
	}
	public function Method_Spivprazya()
	{
if(!CUsers::Instance()->Can(7) && !CUsers::Instance()->Can(0)) $this->Page_Number404();
		$this->title .= 'Співпраця';
		$this->keywords .= 'Співпраця';
		$this->description .= 'Співпраця';
		$html = $this->Template(DIR_TEMPLATES.'tpl_spivprazya.inc.tpl');
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Співпраця', 'content' => $html));
	}
	 public function Method_Excel()
	 	{
	 		// Подключаем класс для работы с Excel
	 		require_once(DIR_LIB . 'LIB/PHPExcel.php');
	 		// Подключаем класс для вывода данных в формате excel
	 		require_once(DIR_LIB . 'LIB/PHPExcel/Writer/Excel5.php');
	 		// Создаем объект класса PHPExcel
	 		$xls = new PHPExcel();
	 		// Устанавливаем индекс активного листа
	 		$xls->setActiveSheetIndex(0);
	 		// Получаем активный лист
	 		$sheet = $xls->getActiveSheet();
	 		$sheet->setTitle('Розхідні накладні');
	 		// Вставляем текст в ячейку A1
	 		$sheet->setCellValue("A1", 'Накладні');
	 		$sheet->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	 		$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('#ADFF2F');
	 		// Объединяем ячейки
	 		$sheet->mergeCells('A1:G1');
	 		// Выравнивание текста
	 		$sheet->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	 		$sheet->setCellValue("A2", '№');
	 		$sheet->mergeCells('B2:C2');
	 		$sheet->setCellValue('B2', 'Код накладної');
	 		$sheet->setCellValue("D2", 'Лицевий рахунок накладної');
	 		$sheet->mergeCells('D2:E2');
	 		$sheet->setCellValue("F2", 'Дата створення ');
	 		$sheet->mergeCells('F2:G2');
	 		$sheet->getStyle('A2:G2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	 		$sheet->getStyle('A2:G2')->getFill()->getStartColor()->setRGB('#00FFFF');
	 		$db = CMySQL::Instance();
	 		$result = $db->Select("SELECT * FROM nakladna");
	 		$i = 0;
	 		foreach ($result as $row)
	 		{
	 			// Выводим данные в таблицу
	 			$sheet->setCellValueByColumnAndRow(0, $i + 3, $row["id_code"]);
	 			$sheet->setCellValueByColumnAndRow(1, $i + 3, $row["kod_naklod"]);
	 			$sheet->setCellValueByColumnAndRow(3, $i + 3, $row["lizevoy_shet_kl"]);
	 			$sheet->setCellValueByColumnAndRow(5, $i + 3, $row["data_stvor"]);
	 			// Применяем выравнивание
	 			$sheet->getStyleByColumnAndRow(0, $i + 3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	 			$sheet->getStyleByColumnAndRow(1, $i + 3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	 			$sheet->getStyleByColumnAndRow(3, $i + 3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	 			$sheet->getStyleByColumnAndRow(5, $i + 3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	 			$i++;
	 		}
	 		// Выводим HTTP-заголовки
	 		header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
	 		header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	 		header("Cache-Control: no-cache, must-revalidate");
	 		header("Pragma: no-cache");
	 		header("Content-type: application/vnd.ms-excel");
	 		header("Content-Disposition: attachment; filename=tovar.xls");
	 		// Выводим содержимое файла
	 		$objWriter = new PHPExcel_Writer_Excel5($xls);
	 		$objWriter->save('php://output');
	 		exit;
	 	}
		 public function Method_PDF()
{
	require_once(DIR_LIB . 'tcpdf/tcpdf_config_alt.php');
	require_once(DIR_LIB . 'tcpdf/tcpdf.php'); // подключаем библиотеку
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	// устанавливаем свойства и дополнительную информацию PDF-файла
	// Устанавливаем какой программой сформирован PDF-файл, поумолчанию параметр из файла конфигурации PDF_CREATOR = "TCPDF"
	$pdf->SetCreator(PDF_CREATOR);
	// Устанавливаем кем сформирован PDF-файл, поумолчанию параметр из файла конфигурации PDF_AUTHOR = "TCPDF"
	$pdf->SetAuthor('Olga');
	// Устанавливаем кем сформирован PDF-файл, поумолчанию параметр из файла конфигурации PDF_HEADER_TITLE = "TCPDF Example"
	$pdf->SetTitle(' Розхідні накладні');
	// Устанавливаем тему PDF-файл
	$pdf->SetSubject('Накладні');
	// Устанавливаем ключевыеслова PDF-файла
	$pdf->SetKeywords('ONAFT, PDF, example');
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE,PDF_HEADER_STRING);
	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '14', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '12', PDF_FONT_SIZE_DATA));
	// Установка отступов
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	//  устанавливаем автоматические разрывы страниц
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$pdf->SetFont('arial', 'Розхідні накладні', 15);
	// добавить страницу
	$pdf->AddPage();
	$db = CMySQL::Instance();
  $result = $db->Select("SELECT * FROM nakladna");
	$sql = "SELECT * FROM nakladna";
	$i = 0;
	$html = '<h1 Color="red" >Перелік розхідних накладних</h1>
	<table border="2"  bgcolor="#fff" color="black">
	<tr>
		<td color="black" >№ </td>
	    <td color="black" >Код накладної</td>
		<td color="black" >Лицевий рахунок клієнта</td>
		<td color="black" >Дата створення</td>
	</tr>';
	foreach ($result as $row)
	{
		$html.= "<tr>";
		$html.= "<td>".$row["id_code"]."</td>";
		$html.= "<td>".$row["kod_naklod"]."</td>";
		$html.= "<td>".$row["lizevoy_shet_kl"]."</td>";
		$html.= "<td>".$row["data_stvor"]."</td>";
		$html.= "</tr>";
	}
	$html.= "</table>";
	// Вывод HTML кода
	$pdf->writeHTML($html, true, false, true, false, 'C');
	$pdf->SetLineStyle(array('width' => 0.3, 'color' => array(0,0,0)));
	// Завершеyия формирования PDF и вывод его
	$pdf->Output('pdf.pdf', 'I');
}
public function Method_Wincc()
{

	{ if(!CUsers::Instance()->Can(7)  && !CUsers::Instance()->Can(2)) $this->Page_Number404();
		$this->title .= 'Таблиця зміни температури';
		$this->keywords .= 'температура';
		$this->description .= 'список зміни температури';
		$this->styles[] = 'tabsort';
		$this->scripts[] = 'tabsort.min';
		$db = CMySQL::Instance();
		$result = $db->Select("SELECT * FROM wincc");
		$html = $this->Template(DIR_TEMPLATES.'tpl_wincc.inc.tpl', array('content' => $result));
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Таблиця зміни температури', 'content' => $html));
	}
}
	public function Method_Page_404()
	{
		$StrTitle = 'Страница не существует, либо вы ввели неправильный адрес!';
		$this->title .= 'Error 404';
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_404.inc.tpl', array('message' => $StrTitle));
	}
}
?>
