<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\WidgetCode;
use Modules\products\Controllers\ProductController;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Forms\productlistwidget_Design;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\products\Controllers\productlistwidgetController;

/**
 *
 * @author nahavandi
 *        
 */
class productlistwidget_Code extends WidgetCode {
	private $ResultCount;
	protected function setResultCount($ResultCount)
	{
		$this->ResultCount=$ResultCount;
	}
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\WidgetCode::load()
	 *
	 */
	public function load() {
		
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$PC=new productlistwidgetController();
		$orderby=$this->getField("orderby");
		$resultlength=$this->getField("count");
		
		$products=$PC->load($orderby, $resultlength, true);
		$products=$products['products'];
		$productsCount=count($products);
		for ($i=0;$i<$productsCount;$i++)
		{
			$link=new AppRooter("products", str_ireplace(" ", "-", $products[$i]['title']));
			$link->setFileFormat(".html");
			$link->addParameter(new UrlParameter("productid", $products[$i]['id']));
			$products[$i]['link']=$link->getAbsoluteURL();
		}
		$design=new productlistwidget_Design();
		$design->setHeight($this->getHeight());
		$design->setWidth($this->getField("itemwidth"));
		$design->setProducts($products);
		$design->setColumnsCount(count($products));
		return $design->getBodyHTML();
	}
}

?>