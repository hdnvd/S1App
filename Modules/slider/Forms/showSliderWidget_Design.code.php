<?php

namespace Modules\slider\Forms;

use core\CoreClasses\services\WidgetDesign;
use Modules\slider\classes\slider;
use Modules\common\PublicClasses\AppJSLink;
use core\CoreClasses\html\JavascriptLink;

/**
 *
 * @author hadi
 *        
 */
class showSliderWidget_Design extends WidgetDesign {
	/**
	 * @var array
	 */
	private $SliderItems;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\WidgetDesign::showPage()
	 *
	 */
	public function getBodyHTML() {
		$jsLink=new AppJSLink("slider", "sweetslider");
		$jsLinkHTML=new JavascriptLink($jsLink->getAbsoluteURL());
		for($i=0;$i<count($this->SliderItems);$i++)
			$Images[$i]=DEFAULT_PUBLICURL . $this->SliderItems[$i]['photourl'];
		$slider=new slider($Images, null, 970, 320, null);
		return $slider->getSlide();
	}

	public function setSliderItems($SliderItems)
	{
	    $this->SliderItems = $SliderItems;
	}
}

?>
