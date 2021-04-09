<?php
class CRouter
{
	private $Controller;
	private $Method;
	private $ArrayParameters;
	public function __construct($url)
	{
		$Info_cmd = explode('/', $url);
		$this->ArrayParameters = array();
		foreach($Info_cmd as $StrParameter) if($StrParameter != '') $this->ArrayParameters[] = $StrParameter;
		$this->ArrayParameters[0] = isset($this->ArrayParameters[0]) ? $this->ArrayParameters[0] : 'index';
		$this->Method = 'Method_'.(isset($this->ArrayParameters[1]) ? $this->ArrayParameters[1] : 'Page_404');
		switch($this->ArrayParameters[0])
		{

			case 'index': $this->Controller = 'CPage'; $this->Method = 'Method_Index'; break;
			case 'login': $this->Controller = 'CAuth'; $this->Method = 'Method_login'; break;
			case 'logout': $this->Controller = 'CAuth'; $this->Method = 'Method_logout'; break;
			case 'users': $this->Controller = 'CAdminUsersPage'; $this->Method = 'Method_Index'; break;
			case 'product': $this->Controller = 'CPageProduct'; $this->Method = 'Method_Index'; break;
			case 'klient': $this->Controller = 'CPageKlient'; $this->Method = 'Method_Index'; break;
			case 'pro_oper': $this->Controller = 'CPageProduct'; $this->Method = 'Method_ProOper'; break;
			case 'editproduct': $this->Controller = 'CPageProduct'; $this->Method = 'Method_EditProduct'; break;
			case 'addproduct': $this->Controller = 'CPageProduct'; $this->Method = 'Method_AddProduct'; break;
			case 'delproduct': $this->Controller = 'CPageProduct'; $this->Method = 'Method_DeleteProduct'; break;
			case 'klient_oper': $this->Controller = 'CPageKlient'; $this->Method = 'Method_KlientOper'; break;
			case 'editklient': $this->Controller = 'CPageKlient'; $this->Method = 'Method_EditKlient'; break;
			case 'addklient': $this->Controller = 'CPageKlient'; $this->Method = 'Method_AddKlient'; break;
			case 'delklient': $this->Controller = 'CPageKlient'; $this->Method = 'Method_DeleteKlient'; break;
			case 'graph_pro': $this->Controller = 'CPageProduct'; $this->Method = 'Method_Graph'; break;
			case 'nakladna': $this->Controller = 'CPageNakladna'; $this->Method = 'Method_Index'; break;
			case 'nakladna_oper': $this->Controller = 'CPageNakladna'; $this->Method = 'Method_NakladnaOper'; break;
			case 'editnakladna': $this->Controller = 'CPageNakladna'; $this->Method = 'Method_EditNakladna'; break;
			case 'addnakladna': $this->Controller = 'CPageNakladna'; $this->Method = 'Method_AddNakladna'; break;
			case 'delnakladna': $this->Controller = 'CPageNakladna'; $this->Method = 'Method_DeleteNakladna'; break;
			case 'video': $this->Controller = 'CPage'; $this->Method = 'Method_Video'; break;
			case 'kod': $this->Controller = 'CPageProduct'; $this->Method = 'Method_SearchKod'; break;
			case 'add_image_product': $this->Controller = 'CPageProduct'; $this->Method = 'Method_Add_Image_Product'; break;
			case 'seach_product': $this->Controller = 'CPageProduct'; $this->Method = 'Method_seachProduct'; break;
			case 'excel': $this->Controller = 'CPage'; $this->Method = 'Method_Excel'; break;
			case 'pdf': $this->Controller = 'CPage'; $this->Method = 'Method_PDF'; break;
			case 'wincc': $this->Controller = 'CPage'; $this->Method = 'Method_Wincc'; break;
			case 'photo': $this->Controller = 'CAdminUsersPage'; $this->Method = 'Method_photo'; break;
			case 'pronas': $this->Controller = 'CPage'; $this->Method='Method_Pronas'; break;
			case 'kontaktu': $this->Controller = 'CPage'; $this->Method='Method_Kontakt'; break;
			case 'poradu': $this->Controller = 'CPage'; $this->Method='Method_Poradu'; break;
			case 'spivprazya': $this->Controller = 'CPage'; $this->Method='Method_Spivprazya'; break;
			case 'avtopark': $this->Controller = 'CPageAvto'; $this->Method='Method_Index'; break;
			case 'pro_avtopark': $this->Controller = 'CPageAvto'; $this->Method='Method_ProAvto'; break;
			case 'editavto': $this->Controller = 'CPageAvto'; $this->Method = 'Method_EditAvto'; break;
			case 'addavto': $this->Controller = 'CPageAvto'; $this->Method = 'Method_AddAvto'; break;
			case 'delavto': $this->Controller = 'CPageAvto'; $this->Method = 'Method_DeleteAvto'; break;
			case 'neobh_Vantazhopidjomnist': $this->Controller = 'CPageAvto'; $this->Method = 'Method_SearchVaga'; break;
      case 'seach_avto': $this->Controller = 'CPageAvto'; $this->Method = 'Method_seachAvto'; break;
			case 'zag_obsyag': $this->Controller = 'CPagePaluvo'; $this->Method = 'Method_Vutratu'; break;
			case 'lito ': $this->Controller = 'CPagePaluvo'; $this->Method = 'Method_Lito'; break;
			case 'zuma': $this->Controller = 'CPagePaluvo'; $this->Method = 'Method_Zuma'; break;
			case'paluvo': $this->Controller = 'CPagePaluvo'; $this->Method='Method_Index'; break;
			case 'pro_paluvo': $this->Controller = 'CPagePaluvo'; $this->Method='Method_ProPaluvo'; break;
			case 'editpal': $this->Controller = 'CPagePaluvo'; $this->Method = 'Method_EditPal'; break;
			case 'addpal': $this->Controller = 'CPagePaluvo'; $this->Method = 'Method_AddPal'; break;
			case 'delpal': $this->Controller = 'CPagePaluvo'; $this->Method = 'Method_DeletePal'; break;
      case 'dostavka': $this->Controller = 'CPageDostavka'; $this->Method='Method_Index'; break;
			case 'pro_dostavka': $this->Controller = 'CPageDostavka'; $this->Method = 'Method_ProDost'; break;
			case 'editdostavka': $this->Controller = 'CPageDostavka'; $this->Method = 'Method_EditDost'; break;
			case 'adddostavka': $this->Controller = 'CPageDostavka'; $this->Method = 'Method_AddDost'; break;
			case 'deldostavka': $this->Controller = 'CPageDostavka'; $this->Method = 'Method_DeleteDost'; break;
     case 'got_prod': $this->Controller = 'CPageGotProd'; $this->Method = 'Method_Index'; break;
		 case 'pro_got_prod': $this->Controller = 'CPageGotProd'; $this->Method = 'Method_ProGotProd'; break;
		 case 'editgotprod': $this->Controller = 'CPageGotProd'; $this->Method = 'Method_EditGotProd'; break;
		 case 'addgotprod': $this->Controller = 'CPageGotProd'; $this->Method = 'Method_AddGotProd'; break;
		 case 'delgotprod': $this->Controller = 'CPageGotProd'; $this->Method = 'Method_DeleteGotProd'; break;
		 case 'pdfgotprod': $this->Controller = 'CPageGotProd'; $this->Method = 'Method__PDFGotProd'; break;
		default: $this->Controller = 'CPage';
		}
	}

	public function Request()
	{
		$object = new $this->Controller();
		$object->Go($this->Method, $this->ArrayParameters);
	}
}
?>
