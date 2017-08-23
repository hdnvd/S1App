<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Controllers\ProductGroupManageController;

/**
 *
 * @author hadi
 *        
 */
class ProductGroupProduct_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setThemePage("admin.php");
	}
	public function load()
	{

		$languageID=CurrentLanguageManager::getCurrentLanguageID();
		$design=new ProductGroupProduct_Design();
		$groupsController=new ProductGroupManageController();
		$groups=$groupsController->loadAllGroupLangsLinkArray($languageID);

		$design->setGroups($groups);
		return $design->getBodyHTML();
	}
}

?>