<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\WidgetCode;

/**
 *
 * @author nahavandi
 *        
 */
class searchWidget_Code extends WidgetCode {
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\WidgetCode::load()
	 *
	 */
	public function load() {
		
		$design=new searchWidget_Design();
		return $design->getBodyHTML();
	}
}

?>