<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormCode;
use Modules\products\Controllers\ProductController;
use Modules\languages\PublicClasses\LanguageTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Controllers\showproductController;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\languages\PublicClasses\ModuleTranslator;

/**
 *
 * @author nahavandi
 *        
 */
class showproduct_Code extends FormCode {
	private $ProductInfo;
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->LoadProduct();
		$this->setTitle($this->ProductInfo['product'][0]['title']);
		
	}
	public function getCanonicalURL()
	{
	    $this->LoadProduct();
	    $link=new AppRooter("products", str_ireplace(" ", "-", $this->ProductInfo['product'][0]['title']));
	    $link->addParameter(new UrlParameter("productid", $this->ProductInfo['product'][0]['id']));
	    $link->setFileFormat(".html");
	    $this->setCanonicalURL($link->getAbsoluteURL());
	    return parent::getCanonicalURL();
	
	}
	private function LoadProduct()
	{
	    if($this->ProductInfo==null)
	    {
		  $PC=new showproductController();
		  $this->ProductInfo=$PC->load($_GET['productid']);
	    }
	}
	public function load()
	{
		$LangName=CurrentLanguageManager::getCurrentLanguageName();
		$Translator=new LanguageTranslator();
		$Translator->setLanguageName($LangName);
		$MTranslator=new ModuleTranslator("products");
		$MTranslator->setLanguageName($LangName);
		if(!isset($_GET['productid']))
			return "کد محصول وارد نشده";
		
		
		$design=new showproduct_Design();
		$result=$this->ProductInfo;
		$design->setLblGroupLang($Translator->getWordTranslation("groups"));
		$design->setLblMainPhoto("تصاویر:");
		$design->setLblDesc($Translator->getWordTranslation("productinfo") . ":");
		$design->setLblDescText($result['product'][0]['description']);
		$design->setLblIsExistsTitle($MTranslator->getWordTranslation("isexists") . ":");
		if($result['product'][0]['isexists']==1)
		  $design->setIsExists($MTranslator->getWordTranslation("exists"));
		else 
		  $design->setIsExists($MTranslator->getWordTranslation("notexists"));
		$design->setLblDescText($result['product'][0]['description']);
		$design->setImgMainPhoto($result['product'][0]['mainphoto']);
		$design->setLblVisitsTitle($Translator->getWordTranslation("visits"));
		$design->setVisits($result['product'][0]['visits']);
		$design->setPhotos($result['product'][0]['photo']);
		$design->setLblTitle($Translator->getWordTranslation("productname") . ":");
		$design->setLblTitleText($result['product'][0]['title']);
		$additionalinfo=null;
		if(!is_null($result['product'][0]['additionalinfo'])&& count($result['product'][0]['additionalinfo'])>0)
			$additionalinfo=$result['product'][0]['additionalinfo'][0];
		$design->setAdditionalInfos($additionalinfo);
		$infotitle=$result['additionalinfostitle'];
		$design->setProduct($result['product']);
		$design->setAdditionalInfosTitle($infotitle);

		return $design->getBodyHTML();
	}
}

?>