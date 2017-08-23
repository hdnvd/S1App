<?php

namespace Modules\slider\Controllers;
use core\CoreClasses\services\Controller;
use Modules\slider\Entity\slider_slideritemEntity;


class showSliderWidgetController extends Controller {
	/**
	 * @return array[sliders]
	 */
	public function load()
	{
		$SIEntity=new slider_slideritemEntity();
		$result['sliders']=$SIEntity->select();
		return $result;
	}
}
?>
