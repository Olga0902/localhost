<?php
// Контроллер страниц сайта
class CPageGotProd extends CBase
{
	public function __construct(){ parent::__construct(); }
	public function Before(){ parent::Before(); }
  public function Method_Index()
	{ if(!CUsers::Instance()->Can(5)  && !CUsers::Instance()->Can(4)) $this->Page_Number404();
		$this->title .= 'Інформація про готову  продукцію';
		$this->keywords .= 'Готова продукція';
		$this->description .= 'список  готових продуктов';
		$this->styles[] = 'tabsort';
		$this->scripts[] = 'tabsort.min';
		$db = CMySQL::Instance();
		$result = $db->Select("SELECT * FROM gotovaya_produkciya");
		$html = $this->Template(DIR_TEMPLATES.'tpl_gotprod.inc.tpl', array('content' => $result));
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Інформація про готову продукцію на складі', 'content' => $html));
	}
public function  Method_ProGotProd()
{
  if(!CUsers::Instance()->Can(4)) $this->Page_Number404();
  $this->title .= 'Редагування бази даних про готову продукцію ';
  $this->keywords .= 'Готова продукція';
  $this->description .= 'список  готових продуктов';
  $this->styles[] = 'tabsort';
  $this->scripts[] = 'tabedit.min';
  $db = CMySQL::Instance();
  $result = $db->Select("SELECT * FROM gotovaya_produkciya");
  $html = $this->Template(DIR_TEMPLATES.'tpl_progotprod.inc.tpl', array('content' => $result));
  $this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Редагування бази даних про готову продукцію ', 'content' => $html));
}
public function Method_EditGotProd()
  {
    if($this->isPost())
    {
      $db = CMySQL::Instance();
      $result = $db->Update("gotovaya_produkciya", array('Nomer_produkcii' => $_POST['Nomer_produkcii'], 'Nazva_produkcii' => $_POST['Nazva_produkcii'],'Cena' => $_POST['Cena'], 'Kilkist_na_skladi' => $_POST['Kilkist_na_skladi'], 'Vaga_1pro' => $_POST['Vaga_1pro'],
      'Data_vygotovlennya' => $_POST['Data_vygotovlennya'], 'Vzhutu do' => $_POST['Vzhutu_do']),  'ID = '.$_POST['ID']);
      print_r($result);
      if($result > 0) echo $result; else echo "false";
      exit;
    }
  }
  public function Method_AddGotProd()
  {
    if($this->isPost())
    {
      $db = CMySQL::Instance();
      $result = $db->Insert("gotovaya_produkciya", array('Nomer_produkcii' => $_POST['Nomer_produkcii'], 'Nazva_produkcii' => $_POST['Nazva_produkcii'],'Cena' => $_POST['Cena'], 'Kilkist_na_skladi' => $_POST['Kilkist_na_skladi'], 'Vaga_1pro' => $_POST['Vaga_1pro'],
      'Data_vygotovlennya' => $_POST['Data_vygotovlennya'],'Vzhutu do' => $_POST['Vzhutu_do']));
      if($result) echo $result; else echo "false";
      exit;
    }
  }
  public function Method_DeleteGotProd()
  {
    if($this->isPost())
    {
      $db = CMySQL::Instance();
      $result = $db->Delete('gotovaya_produkciya', 'ID = '.$_POST['ID']);
      if($result > 0) echo $result; else echo "false";
      exit;
    }
  }
    public function Method__PDFGotProd()
  {
    require_once(DIR_LIB . 'tcpdf/tcpdf_config_alt.php');
  	require_once(DIR_LIB . 'tcpdf/tcpdf.php'); // подключаем библиотеку

    $CMySQL = CMySQL::Instance();

    $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    $result = mysqli_query($link, "SELECT * FROM gotovaya_produkciya");

    mysqli_close($link);

    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle("Накладна на готову продукцію");
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont('helvetica');
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->SetFont('arial', '', 12);
    $pdf->AddPage();

    $html = '';

    $html .= '<h3 align="right">от «___» __________________ 202__ г.</h3>';
    $html .= '<h1 align="center">Н А К Л А Д Н А  на готову продукцію  № </h1>';
    $html .= '<h3 align="left">Кому:</h3>';
    $html .= '<h3 align="left">От кого:</h3>';

    $html .='
    <table border="1" cellspacing="0" cellpadding="5">
    <tr>
     <th width="13%">Штрих-код продукції</th>
     <th width="30%">Назва продукції</th>
     <th width="15%">Кількість на складі</th>
     <th width="10%">Вага</th>
     <th width="15%">Дата виготовлення</th>
      <th width="15%">Закінчення терміну придатності </th>
    </tr>';

    foreach($result as $item):
    {
    $html .= "
    <tr>
     <td width='13%'>".$item['Nomer_produkcii']."</td>
     <td width='30%'>".$item['Nazva_produkcii']."</td>
     <td width='15%'>".$item['Kilkist_na_skladi']."</td>
     <td width='10%'>".$item['Vaga_1pro']."</td>
     <td width='15%'>".$item['Data_vygotovlennya']."</td>
     <td width='15%'>".$item['Vzhutu_do']."</td>
    </tr>";
    }
    endforeach;

    $html .= '</table>';

    $html .= '<p align="left">Сдал:&#8195;&#8195; _______________&#8195;&#8195;____________________________</p>';
    $html .= '<p align="left">Принял:&#8195;      _______________&#8195;&#8195;____________________________</p>';

    // Вывод HTML кода
    $pdf->writeHTML($html, true, false, true, false, 'C');

    // Завершеия формирования PDF и вывод его
    $pdf->Output('list.pdf');
  }
}
?>
