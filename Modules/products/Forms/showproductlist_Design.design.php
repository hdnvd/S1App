<?php
namespace Modules\products\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Image;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\Div;

/**
 *
 * @author nahavandi
 *        
 */
class showproductlist_Design extends FormDesign {
	/**
	 * @var array
	 */
	private $Results;
	/**
	 * @var Int
	 */
	private $PageCount;
	/**
	 * @var String 
	 */
	private $PageLinkStart;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 */
	public function getBodyHTML($command = "load") {
		$makethumb=false;
		$Page=new Div();
		$Page->setId("products_productlistpage");
		
		$isnewdiv=new Div();
		$isnewdiv->setClass("products_isnewdiv");
		
		/*$isexistsdiv=new Div();
		$isexistsdiv->setClass("products_isexistsdiv");
		*/
		for($j=0;$j<count($this->Results);$j++)
		{
			
			if(count($this->Results[$j]['products'])>0 && $this->Results[$j]['products'][0]!==null && key_exists("title", $this->Results[$j]['products'][0])) //if the Group Has Any Product
			{
				
				$ProductGroupTitle=new Div();
				$ProductGroupTitle->setClass("products_productgrouptitle");
				if(key_exists("groupinfo", $this->Results[$j]))
					$ProductGroupTitle->addElement(new Lable($this->Results[$j]['groupinfo']['title']));
				
				$ProductsList=new Div();
				$ProductsList->setId("products_productlist");
				for($i=0;$i<count($this->Results[$j]['products']);$i++)
				{
					
						if($makethumb)
							$tmpElement=new Image(DEFAULT_PUBLICURL . "makethumb.php?width=400&file=" . $this->products[$i]['thumburl']);
						else
							$tmpElement=new Image(DEFAULT_PUBLICURL . $this->Results[$j]['products'][$i]['thumburl']);
			
						$tmpLink=new link($this->Results[$j]['products'][$i]['link'], $tmpElement);
						$tmpTable=new Div();
						$tmpTable->setClass("products_productdiv");
						$tmpTable->addElement($tmpLink);
						$tmplable=new Lable($this->Results[$j]['products'][$i]['title']);
						$tmpDiv=new Div();
						/*if($this->Results[$j]['products'][$i]['isexists']=="1")
						    $tmpDiv->addElement($isexistsdiv);*/
						$tmpDiv->addElement($tmplable);
						$tmpDiv->setClass("products_producttitle");
						
						$tmpTable->addElement($tmpDiv);
						if($this->Results[$j]['products'][$i]['isnew']=="1")
							$tmpTable->addElement($isnewdiv);
						$ProductsList->addElement($tmpTable);
					
				}
	
				$Page->addElement($ProductGroupTitle);
				$Page->addElement($ProductsList);
			}
		}
		if($this->PageCount>1)
		{
			$PaginationDiv=new Div();
			for($i=1;$i<=$this->PageCount;$i++)
			{
				$tmpPageLink=new link($this->PageLinkStart . "?pn=$i", $i);
				$PaginationDiv->addElement($tmpPageLink);
			}
			$PaginationDiv->setId("products_pagination");
			$Page->addElement($PaginationDiv);
		}
		return $Page;
	}



	public function setPageCount($PageCount)
	{
	    $this->PageCount = $PageCount;
	}

	public function setPageLinkStart($PageLinkStart)
	{
	    $this->PageLinkStart = $PageLinkStart;
	}

	public function setResults($Results)
	{
	    $this->Results = $Results;
	}
}

?>