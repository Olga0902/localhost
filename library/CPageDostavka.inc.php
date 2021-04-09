<?php
// Контроллер страниц сайта
class CPageDostavka extends CBase
{
	public function __construct(){ parent::__construct(); }
	public function Before(){ parent::Before(); }
public function Method_Index()
{ if(!CUsers::Instance()->Can(3) && !CUsers::Instance()->Can(5) && !CUsers::Instance()->Can(7)) $this->Page_Number404();
  $this->title .= 'Статус доставки';
  $this->keywords .= 'Доставка';
  $this->description .= 'Доставка';
  $this->styles[] = 'tabsort';
  $this->scripts[] = 'tabsort.min';
  $db = CMySQL::Instance();
  $result = $db->Select("SELECT * FROM dostavka");
  $html = $this->Template(DIR_TEMPLATES.'tpl_dostavka.inc.tpl', array('content' => $result));
  $this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Інформація про статус доставки', 'content' => $html));
}
public function Method_ProDost()
{ if(!CUsers::Instance()->Can(3)) $this->Page_Number404();
  $this->title .= 'Статус доставки ';
  $this->keywords .= 'Доставка';
  $this->description .= 'Доставка';
  $this->styles[] = 'tabsort';
  $this->scripts[] = 'tabedit.min';
  $db = CMySQL::Instance();
  $result = $db->Select("SELECT * FROM dostavka");
  $html = $this->Template(DIR_TEMPLATES.'tpl_pro_dostavka.inc.tpl', array('content' => $result));
  $this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Інформація про статус доставки', 'content' => $html));
}
public function Method_EditDost()
  {
    if($this->isPost())
    {
      $db = CMySQL::Instance();
      $result = $db->Update("dostavka", array( 'Nomer_zakazu' => $_POST['Nomer_zakazu'], 'Nazva_zakladu' => $_POST['Nazva_zakladu'], 'Adres' => $_POST['Adres'], 'Data_dostavki' => $_POST['Data_dostavki'],'№avto' => $_POST['№avto'], 'Status' => $_POST['Status']), 'ID = '.$_POST['ID']);
      if($result > 0) echo $result; else echo "false";
      exit;
    }
  }
  public function Method_AddDost()
  {
    if($this->isPost())
    {
      $db = CMySQL::Instance();
      $result = $db->Insert("dostavka", array('Nomer_zakazu' => $_POST['Nomer_zakazu'], 'Nazva_zakladu' => $_POST['Nazva_zakladu'], 'Adres' => $_POST['Adres'], 'Data_dostavki' => $_POST['Data_dostavki'], '№avto' => $_POST['№avto'], 'Status' => $_POST['Status']));
      if($result) echo $result; else echo "false";
      exit;
    }
  }
  public function Method_DeletDost()
  {
    if($this->isPost())
    {
      $db = CMySQL::Instance();
      $result = $db->Delete('dostavka', 'ID = '.$_POST['ID']);
      if($result > 0) echo $result; else echo "false";
      exit;
    }
  }
}
?>
