<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormCode;
use Modules\products\Controllers\ProductGroupManageController;
use Modules\pages\Controllers\languageManageController;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\common\PublicClasses\AppRooter;
use Modules\products\Controllers\ProductController;
use Modules\products\Controllers\ProductManageController;
use Modules\common\PublicClasses\UrlParameter;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class listproducts_Code extends FormCode {
	
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setThemePage("admin.php");
		$this->setTitle("مدیریت محصولات");
	}
	public function load()
	{
		$languageID=CurrentLanguageManager::getCurrentLanguageID();
		$design=new listproducts_Design();
		$ProductController=new ProductManageController();
		$res=$ProductController->loadAllProducts();
		$design->setResult($res);
		return $design->getBodyHTML();
	}
}

?>