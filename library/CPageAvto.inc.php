<?php
// Контроллер страниц сайта
class CPageAvto extends CBase
{
	public function __construct(){ parent::__construct(); }
	public function Before(){ parent::Before(); }
  public function Method_Index()
	{ if(!CUsers::Instance()->Can(7)  && !CUsers::Instance()->Can(3)) $this->Page_Number404();
		$this->title .= 'Перелік авто підприємства';
		$this->keywords .= 'Авто';
		$this->description .= 'список авто';
		$this->styles[] = 'tabsort';
		$this->scripts[] = 'tabsort.min';
		$db = CMySQL::Instance();
		$result = $db->Select("SELECT * FROM avto");
		$html = $this->Template(DIR_TEMPLATES.'tpl_avto.inc.tpl', array('content' => $result));
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Перелік авто підприємства', 'content' => $html));
	}
	public function Method_ProAvto()
	{ if(!CUsers::Instance()->Can(7)  && !CUsers::Instance()->Can(3)) $this->Page_Number404();
		$this->title .= 'Редагування бази даних автотранспорта підприємства ';
		$this->keywords .= 'Авто';
		$this->description .= 'Авто';
		$this->styles[] = 'tabsort';
		$this->scripts[] = 'tabedit.min';
		$db = CMySQL::Instance();
		$result = $db->Select("SELECT * FROM avto");
		$html = $this->Template(DIR_TEMPLATES.'tpl_avtooper.inc.tpl', array('content' => $result));
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Редагування бази даних  авторанспорта підприємтсва', 'content' => $html));
	}
	public function Method_EditAvto()
		{
			if($this->isPost())
			{
				$db = CMySQL::Instance();
				$result = $db->Update("avto", array( '№avto' => $_POST['№avto'], 'Marka_avtomobilya' => $_POST['Marka_avtomobilya'], 'Tip_dvigatelya' => $_POST['Tip_dvigatelya'], 'Vantazhopidjomnist' => $_POST['Vantazhopidjomnist']), 'ID = '.$_POST['ID']);
				if($result > 0) echo $result; else echo "false";
				exit;
			}
		}
		public function Method_AddAvto()
		{
			if($this->isPost())
			{
				$db = CMySQL::Instance();
				$result = $db->Insert("avto", array( '№avto' => $_POST['№avto'], 'Marka_avtomobilya' => $_POST['Marka_avtomobilya'], 'Tip_dvigatelya' => $_POST['Tip_dvigatelya'], 'Vantazhopidjomnist' => $_POST['Vantazhopidjomnist']));
				if($result) echo $result; else echo "false";
				exit;
			}
		}
		public function Method_DeleteAvto()
    {
      if($this->isPost())
      {
        $db = CMySQL::Instance();
        $result = $db->Delete('avto', 'ID = '.$_POST['ID']);
        if($result > 0) echo $result; else echo "false";
        exit;
      }
    }
		
 public function Method_SearchVaga()
{ if(!CUsers::Instance()->Can(3)) $this->Page_Number404();
	$this->title .= 'Введіть тонаж авто';
	$this->keywords .= 'Тоннаж';
	$this->description .= 'Введіть тоннаж авто ';
	$this->scripts[] = 'ajax';
	$html = $this->Template(DIR_TEMPLATES.'tpl_searchvaga.inc.tpl');
	$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Пошук необхідного авто, відповідно тоннажу продукції ', 'content' => $html));
}

public function Method_seachAvto()
{
	if ($this->isPost()) {
		$db = CMySQL::Instance();
		$id_code = $db->Real_escape_string($_POST['ID']);
		if (isset($ID)) {
			$result = $db->Select("SELECT * FROM avto WHERE Vantazhopidjomnist = '" . $ID . "'");
			if ($result != NULL) {
				$str_data = $result[0]['№avto'] . "<br />Марка -" . $result[0]['Marka_avtomobilya']  . "<br />Тип двигуна-" . $result[0]['Tip_dvigatelya'] ;

				echo  $str_data;
				"<br />Вам потрібен цей автомобіль: ";
			} else echo "Машина відсутня";
		}
		exit;
	}
}
}
	?>
