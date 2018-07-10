<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\Menu;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\ComboBoxMenu;

/**
 *
 * @author hadi
 *        
 */
class ProductGroupProduct_Design extends FormDesign {
	
	private $groups;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 */
	public function getBodyHTML($command = "load") {
		$menu=new ComboBoxMenu();
		
		$menu->setGroups($this->groups);
		$menu->setClass("productproductgroupcombo");
		return $menu;
	}
	
	public function setGroups($groups)
	{
	    $this->groups = $groups;
	}

	protected function getGroups()
	{
	    return $this->groups;
	}
}

?>