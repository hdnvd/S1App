<?php

namespace Modules\slider\Forms;

use core\CoreClasses\services\WidgetCode;
use Modules\slider\Forms\showSliderWidget_Design;
use Modules\slider\Controllers\showSliderWidgetController;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class showSliderWidget_Code extends WidgetCode {
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\WidgetCode::load()
	 *
	 */
	public function load() {
		$ctl=new showSliderWidgetController();
		$Data=$ctl->load();
		$SliderItems=$Data['sliders'];

		
		$design=new showSliderWidget_Design();

		$design->setSliderItems($SliderItems);

		return $design->getBodyHTML();
	}
}

?>