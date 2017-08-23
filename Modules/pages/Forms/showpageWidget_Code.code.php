<?php

namespace Modules\pages\Forms;

use core\CoreClasses\services\WidgetCode;

/**
 *
 * @author nahavandi
 *        
 */
class showpageWidget_Code extends WidgetCode {
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\WidgetCode::load()
	 *
	 */
	public function load() {
		
		$pageCode=new showpage_Code();
		$id=(string)$this->getField("pageid");
		$design=new showpage_Design();
		$design=$pageCode->loadPageText($design,$id);
			
		return $design->getBodyHTML();
	}
}

?>