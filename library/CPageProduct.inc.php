<?php
// Контроллер страниц сайта
class CPageProduct extends CBase
{
	public function __construct(){ parent::__construct(); }
	public function Before(){ parent::Before(); }
  public function Method_Index()
	{ if(!CUsers::Instance()->Can(7) &&  !CUsers::Instance()->Can(5) && !CUsers::Instance()->Can(0) && !CUsers::Instance()->Can(4)) $this->Page_Number404();
		$this->title .= 'Інформація про продукцію';
		$this->keywords .= 'продукты';
		$this->description .= 'список продуктов';
		$this->styles[] = 'tabsort';
		$this->scripts[] = 'tabsort.min';
		$db = CMySQL::Instance();
		$result = $db->Select("SELECT * FROM product");
		$html = $this->Template(DIR_TEMPLATES.'tpl_product.inc.tpl', array('content' => $result));
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Інформація про продукцію', 'content' => $html));
	}
  public function Method_Graph()
	{ if(!CUsers::Instance()->Can(7) && !CUsers::Instance()->Can(5) && !CUsers::Instance()->Can(0) && !CUsers::Instance()->Can(4)) $this->Page_Number404();
		$this->title .= 'Перегляд графіку';
		$this->keywords .= 'товары';
		$this->description .= 'список товаров';
		$db = CMySQL::Instance();
		$result = $db->Select("SELECT * FROM product");
		$html = $this->Template(DIR_TEMPLATES.'tpl_graph.inc.tpl', array('content' => $result));
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Перегляд графіку', 'content' => $html));
	}
  public function Method_ProOper()
	{
		if(!CUsers::Instance()->Can(7) && !CUsers::Instance()->Can(5)) $this->Page_Number404();
		$this->title .= 'Редагування бази даних продукцію ';
		$this->keywords .= 'товары';
		$this->description .= 'список товаров';
		$this->styles[] = 'tabsort';
		$this->scripts[] = 'tabedit.min';
		$db = CMySQL::Instance();
		$result = $db->Select("SELECT * FROM product");
		$html = $this->Template(DIR_TEMPLATES.'tpl_prooper.inc.tpl', array('content' => $result));
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Редагування бази даних про продукцію ', 'content' => $html));
	}
  public function Method_SearchKod()
	{ if(!CUsers::Instance()->Can(7) && !CUsers::Instance()->Can(5) && !CUsers::Instance()->Can(0) && !CUsers::Instance()->Can(4)) $this->Page_Number404();
		$this->title .= 'Введіть штрих-код товару';
		$this->keywords .= 'Штрих-код';
		$this->description .= 'Введіть штрих-код товару';
		$this->scripts[] = 'ajax';
		$html = $this->Template(DIR_TEMPLATES.'tpl_searchkod.inc.tpl');
		$this->content = $this->Template(DIR_TEMPLATES.'tpl_content.inc.tpl', array('name_page' => 'Введіть штрих-код товару', 'content' => $html));
	}
	public function Method_seachProduct()
	{
		if ($this->isPost()) {
			$db = CMySQL::Instance();
			$id_code = $db->Real_escape_string($_POST['id_code']);
			if (isset($id_code)) {
				$result = $db->Select("SELECT * FROM product WHERE code = '" . $id_code . "'");
				if ($result != NULL) {
					$str_data = $result[0]['name'] . "<br />Ціна -" . $result[0]['price'] . ' грн.  ' . "<br />Кількість-" . $result[0]['quantity'] . " шт.</br>";
					if ($result[0]['image'] == NULL) $str_data .= '<img alt="" src="images/no-image.png" width="150" height="150" />';
					else $str_data .= '<img alt="" src="data:image/*;base64,' . $result[0]['image'] . '" width="200" height="200" />';
					echo  $str_data;
				} else echo "Товар отсутствует";
			}
			exit;
		}
	}
	public function Method_Add_Image_Product()
	{
		if($this->isPost())
		{
			$db = CMySQL::Instance();
			//Проверяем пришел ли файл
			if (!empty($_FILES['image']['name'])) {
				//если файл загружен успешно, то проверяем графический ли он
				if(substr($_FILES['image']['type'],0,5)== 'image') {
					//читаем содержимое файла
					$img_binary = file_get_contents($_FILES['image']['tmp_name']);
										//кодирует данные сопособом МІМЕ base64
					$img_Base64 = base64_encode($img_binary);
					//формируем запрос на добавление файла в базу данных
					$db->Update('product', array('image' => $img_Base64), 'id_code='. (int)$_POST['id_product']);
}
				}
			}
		}

   public function Method_EditProduct()
 		{
 			if($this->isPost())
 			{
 				$db = CMySQL::Instance();
 				$result = $db->Update("product", array('code' => $_POST['code'], 'name' => $_POST['name'], 'price' => $_POST['price'], 'quantity' => $_POST['quantity']), 'id_code = '.$_POST['id_code']);
 				if($result > 0) echo $result; else echo "false";
 				exit;
 			}
 		}
 		public function Method_AddProduct()
 		{
 			if($this->isPost())
 			{
 				$db = CMySQL::Instance();
 				$result = $db->Insert("product", array('code' => $_POST['code'], 'name' => $_POST['name'], 'price' => $_POST['price'], 'quantity' => $_POST['quantity']));
 				if($result) echo $result; else echo "false";
 				exit;
 			}
 		}
 		public function Method_DeleteProduct()
 		{
 			if($this->isPost())
 			{
 				$db = CMySQL::Instance();
 				$result = $db->Delete('product', 'id_code = '.$_POST['id_code']);
 				if($result > 0) echo $result; else echo "false";
 				exit;
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
