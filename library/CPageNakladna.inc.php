<?php
// Контроллер страниц сайта
class CPageNakladna extends CBase
{
	public function __construct(){ parent::__construct(); }
	public function Before(){ parent::Before(); }
  public function Method_Index()
	{ if(!CUsers::Instance()->Can(7)  && !CUsers::Instance()->Can(5) && !CUsers::Instance()->Can(0) && !CUsers::Instance()->Can(4)) $this->Page_Number404();
		$this->title .= 'Зміст накладних';
		$this->keywords .= 'накладні';
		$this->description .= 'список накладних';
		$this->styles[] = 'tabsort';
		$this->scripts[] = 'tabsort.min';
		$db = CMySQL::Instance();
		$result = $db->Select("SELECT * FROM nakladna");
		$html = $this->Template(DIR_TEMPLATES.'tpl_nakladna.inc.tpl', array('content' => $result));
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Зміст накладних', 'content' => $html));
	}
	public function Method_NakladnaOper()
	{ if(!CUsers::Instance()->Can(7)  && !CUsers::Instance()->Can(5)) $this->Page_Number404();
		$this->title .= 'Зміна бази даних накладних';
		$this->keywords .= 'накладні';
		$this->description .= 'список накладних';
		$this->styles[] = 'tabsort';
		$this->scripts[] = 'tabedit.min';
		$db = CMySQL::Instance();
		$result = $db->Select("SELECT * FROM nakladna");
		$html = $this->Template(DIR_TEMPLATES.'tpl_nakladnaoper.inc.tpl', array('content' => $result));
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Зміна бази даних накладних', 'content' => $html));
	}
	public function Method_EditNakladna()
		{
			if($this->isPost())
			{
				$db = CMySQL::Instance();
				$result = $db->Update("nakladna", array( 'kod_naklod' => $_POST['kod_naklod'], 'lizevoy_shet_kl' => $_POST['lizevoy_shet_kl'], 'data_stvor' => $_POST['data_stvor']), 'id_code = '.$_POST['id_code']);
				if($result > 0) echo $result; else echo "false";
				exit;
			}
		}
		public function Method_AddNakladna()
		{
			if($this->isPost())
			{
				$db = CMySQL::Instance();
				$result = $db->Insert("nakladna", array('kod_naklod' => $_POST['kod_naklod'], 'lizevoy_shet_kl' => $_POST['lizevoy_shet_kl'], 'data_stvor' => $_POST['data_stvor']));
				if($result) echo $result; else echo "false";
				exit;
			}
		}
		public function Method_DeleteNakladna()
		{
			if($this->isPost())
			{
				$db = CMySQL::Instance();
				$result = $db->Delete('nakladna', 'id_code = '.$_POST['id_code']);
				if($result > 0) echo $result; else echo "false";
				exit;
			}
		}

	}
	?>
