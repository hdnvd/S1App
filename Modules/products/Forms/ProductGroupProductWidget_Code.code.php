<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormCode;
use Modules\products\Controllers\ProductGroupManageController;
use core\CoreClasses\services\WidgetCode;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Controllers\ProductGroupProductWidgetController;

/**
 *
 * @author Hadi Nahavandi
 * @version 0.1
 * LastUpdate 2014/May/20 2:10
 * @tutorial Loads Product Groups As Menu And Their Products As Their SubMenus
 *        
 */
class ProductGroupProductWidget_Code extends WidgetCode {
	public function load()
	{
// 		echo "ProductGroupProductWidget_Code";
		$design=new ProductGroupProductWidget_Design();
		$groupsController=new ProductGroupProductWidgetController();
		
		$groups=$groupsController->load();
		$design->setGroups($groups['groupproducts']);
		return $design->getBodyHTML();
		return "";
	}
}

?>