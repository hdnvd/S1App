<?php

namespace Modules\company\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\html\Image;
use core\CoreClasses\html\link;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/02/19 12:34:08
 *@lastUpdate 2015/02/19 12:34:08
*/


class products_Design extends FormDesign {
	private $products;
	/**
	 * @var TextBox
	 */
	
	/**
	 * @var DataComboBox
	 */
	
	/**
	 * @var SweetButton
	 */
	
	public function __construct()
	{
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("company_products");
		$Page->addElement(new Lable(""));
		$Page->setClass("sweet_formtitle");
		$LTable1=new Div();
		
		for ($pi=0;$pi<count($this->products);$pi++)
		{
		    $PImage=new Image(DEFAULT_PUBLICURL . $this->products[$pi]['thumbnail']);
		    $PImage->setClass("company_products_productthumbnail");
		    $Link=new link($this->products[$pi]['url'], $PImage);
		    $PTitle=new Div();
		    $PTitle->addElement(new Lable($this->products[$pi]['title']));
		    $PTitle->setClass("company_productinfoitem");
		    $productInfo=new Div();
		    $productInfo->setClass("company_products_productinfo");
		    $productInfo->addElement($Link);
		    $productInfo->addElement($PTitle);
		    $LTable1->addElement($productInfo);
		}
		
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	

	public function setProducts($products)
	{
	    $this->products = $products;
	}
}
?>
