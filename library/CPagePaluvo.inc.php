<?php
// Контроллер страниц сайта
class CPagePaluvo extends CBase
{
	public function __construct(){ parent::__construct(); }
	public function Before(){ parent::Before(); }
public function Method_Index()
{ if(!CUsers::Instance()->Can(3) && !CUsers::Instance()->Can(7)) $this->Page_Number404();
  $this->title .= 'Норми витрати палива';
  $this->keywords .= 'Паливо';
  $this->description .= 'Паливо';
  $this->styles[] = 'tabsort';
  $this->scripts[] = 'tabsort.min';
  $db = CMySQL::Instance();
  $result = $db->Select("SELECT * FROM paluvo");
  $html = $this->Template(DIR_TEMPLATES.'tpl_paluvo.inc.tpl', array('content' => $result));
  $this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Норми витрати палива', 'content' => $html));
}

public function Method_ProPaluvo()
{ if(!CUsers::Instance()->Can(3)) $this->Page_Number404();
  $this->title .= 'Редагування бази даних норми витрати палива ';
  $this->keywords .= 'Паливо';
  $this->description .= 'Паливо';
  $this->styles[] = 'tabsort';
  $this->scripts[] = 'tabedit.min';
  $db = CMySQL::Instance();
  $result = $db->Select("SELECT * FROM paluvo");
  $html = $this->Template(DIR_TEMPLATES.'tpl_paluvooper.inc.tpl', array('content' => $result));
  $this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Редагування бази даних норми витрати палива', 'content' => $html));
}
public function Method_EditPal()
  {
    if($this->isPost())
    {
      $db = CMySQL::Instance();
      $result = $db->Update("paluvo", array( '№_avto' => $_POST['№_avto'], 'Marka_avto' => $_POST['Marka_avto'], 'Vyd_palyva' => $_POST['Vyd_palyva'],'Litni_vitrati_na_sto_km' => $_POST['Litni_vitrati_na_sto_km'], 'Zimni_vytraty_na_sto_km' => $_POST['Zimni_vytraty_na_sto_km']), 'ID = '.$_POST['ID']);
      if($result > 0) echo $result; else echo "false";
      exit;
    }
  }
  public function Method_AddPal()
  {
    if($this->isPost())
    {
      $db = CMySQL::Instance();
      $result = $db->Insert("paluvo", array( '№_avto' => $_POST['№_avto'], 'Marka_avto' => $_POST['Marka_avto'], 'Vyd_palyva' => $_POST['Vyd_palyva'], 'Litni_vitrati_na_sto_km' => $_POST['Litni_vitrati_na_sto_km'], 'Zimni_vytraty_na_sto_km' => $_POST['Zimni_vytraty_na_sto_km']));
      if($result) echo $result; else echo "false";
      exit;
    }
  }
  public function Method_DeletePal()
  {
    if($this->isPost())
    {
      $db = CMySQL::Instance();
      $result = $db->Delete('paluvo', 'ID = '.$_POST['ID']);
      if($result > 0) echo $result; else echo "false";
      exit;
    }
  }
	public function Method_Vutratu()
	{ if(!CUsers::Instance()->Can(3)) $this->Page_Number404();
		$this->title .= ' Розрахувати загальні витрати палива';
		$this->keywords .= 'Витрати';
		$this->description .= 'Витрати';
		$this->styles[] = 'tabsort';
		$this->scripts[] = 'tabsort.min';
		$db = CMySQL::Instance();
		$result = $db->Select("SELECT * FROM paluvo");
		$html = $this->Template(DIR_TEMPLATES.'tpl_zavobsyag.inc.tpl', array('content' => $result));
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Розрахувати загальниі витрати палива', 'content' => $html));
	}
	public function Method_Zuma() {

 		$this->title .= ' Розрахувати загальні витрати палива зимою';
 		$this->keywords .= 'Витрати зима';
 		$this->description .= 'Витрати зима';
 		$this->styles[] = 'tabsort';
 		$this->scripts[] = 'tabsort.min';
 		$db = CMySQL::Instance();
 		$result = $db->Select("SELECT * FROM paluvo");
 		$html = $this->Template(DIR_TEMPLATES.'tpl_zuma.inc.tpl', array('content' => $result));
 		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Розрахувати загальниі витрати зимою', 'content' => $html));
 	}
}

?>
