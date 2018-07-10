<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\WidgetDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Image;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Div;

/**
 *
 * @author nahavandi
 *        
 */
class productlistwidget_Design extends WidgetDesign {
	private $products,$columnsCount;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\WidgetDesign::getBodyHTML()
	 *
	 */
	public function getBodyHTML() {
		$makeThumb=false;
		$Main=new Div();
		$Main->setClass("productlist");
		for ($i=0;$i<count($this->products);$i++)
		{
			$Item=new Div();
			if($makeThumb)
				$tmpIMG=new Image(DEFAULT_PUBLICURL . "makethumb.php?width=400&file=" . $this->products[$i]['mainphoto']);
			else
				$tmpIMG=new Image(DEFAULT_PUBLICURL  . $this->products[$i]['thumburl']);
			$width="";
			if(!is_null($this->getWidth())){
				$width="max-width:" . $this->getWidth() . "px;";
			}
			
			$tmpelement=new link($this->products[$i]['link'], $tmpIMG->getHTML());
			$Item->addElement($tmpelement);
			$Main->addElement($Item);
		}
		
		return $Main;
	}

	public function setProducts($products)
	{
	    $this->products = $products;
	}

	public function setColumnsCount($columnsCount)
	{
	    $this->columnsCount = $columnsCount;
	}
}

?>
