<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\UList;
use core\CoreClasses\html\UListElement;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Menu;
use core\CoreClasses\services\WidgetDesign;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class ProductGroupProductWidget_Design extends WidgetDesign {
	private $groups;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 */
	public function getBodyHTML($command = "load") {
		$menu=new Menu();		
		$menu->setGroups($this->groups);
		$menu->setTextField("title");
		$menu->setId("sweetmenu");
		return $menu;
	}
	
	public function setGroups($groups)
	{
	    $this->groups = $groups;
	}
}

?>