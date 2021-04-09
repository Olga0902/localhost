<?php
// Контроллер страниц сайта
class CPageKlient extends CBase
{
	public function __construct(){ parent::__construct(); }
	public function Before(){ parent::Before(); }
	public function Method_Index()
{ if(!CUsers::Instance()->Can(7) && !CUsers::Instance()->Can(3) && !CUsers::Instance()->Can(5)) $this->Page_Number404();
  $this->title .= 'Клієнти, з якими працює пекарня';
  $this->keywords .= 'клієнти';
  $this->description .= 'список клієнтів';
  $this->styles[] = 'tabsort';
  $this->scripts[] = 'tabsort.min';
  $db = CMySQL::Instance();
  $result = $db->Select("SELECT * FROM klient");
  $html = $this->Template(DIR_TEMPLATES.'tpl_klient.inc.tpl', array('content' => $result));
  $this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Клієнти, з якими працює пекарня', 'content' => $html));
}

	public function Method_KlientOper()
	{ if(!CUsers::Instance()->Can(7)  && !CUsers::Instance()->Can(5)) $this->Page_Number404();
		$this->title .= 'Редагування бази даних про клієнта';
		$this->keywords .= 'клієнти';
		$this->description .= 'клієнти';
		$this->styles[] = 'tabsort';
		$this->scripts[] = 'tabedit.min';
		$db = CMySQL::Instance();
		$result = $db->Select("SELECT * FROM klient");
		$html = $this->Template(DIR_TEMPLATES.'tpl_klientoper.inc.tpl', array('content' => $result));
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Редагування бази даних про клієнта', 'content' => $html));
	}
  public function Method_EditKlient()
    {
      if($this->isPost())
      {
        $db = CMySQL::Instance();
        $result = $db->Update("klient", array('lizevoy_shet' => $_POST['lizevoy_shet'], 'nazva_klienta' => $_POST['nazva_klienta'], 'adres_klienta' => $_POST['adres_klienta'], 'data_pidpus_dog' => $_POST['data_pidpus_dog'], 'data_zakinch_dog' => $_POST['data_zakinch_dog']), 'id_code = '.$_POST['id_code']);
        if($result > 0) echo $result; else echo "false";
        exit;
      }
    }
    public function Method_AddKlient()
    {
      if($this->isPost())
      {
        $db = CMySQL::Instance();
        $result = $db->Insert("klient", array('lizevoy_shet' => $_POST['lizevoy_shet'], 'nazva_klienta' => $_POST['nazva_klienta'], 'adres_klienta' => $_POST['adres_klienta'], 'data_pidpus_dog' => $_POST['data_pidpus_dog'], 'data_zakinch_dog' => $_POST['data_zakinch_dog']));
        if($result) echo $result; else echo "false";
        exit;
      }
    }
    public function Method_DeleteKlient()
    {
      if($this->isPost())
      {
        $db = CMySQL::Instance();
        $result = $db->Delete('klient', 'id_code = '.$_POST['id_code']);
        if($result > 0) echo $result; else echo "false";
        exit;
      }
    }
  }
  ?>
