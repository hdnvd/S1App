<?php

namespace Modules\pages\Forms;

use core\CoreClasses\services\FormCode;
use Modules\pages\Controllers\pageListController;

/**
 *
 * @author Hadi Nahavandis
 *        
 */
class listpages_Code extends FormCode {
	
	public function load(){
		$controller=new pageListController();
		$result=$controller->loadTagPages($_GET['tag']);
 		$design=new listpages_Design();
 		$design->pages=$result;
 		return $design->getBodyHTML();
	}
}

?>