<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\DataTable;
use core\CoreClasses\html\link;
use core\CoreClasses\html\elementGroup;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\Div;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;

/**
 *
 * @author nahavandi
 *        
 */
class listproducts_Design extends FormDesign {
	private $result;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 */
	public function getBodyHTML($command = "load") {
		
	    $Groups=new ListTable("1");
	    $Groups->setId("products_listproducts_page");
		for ($Gi=0;$Gi<count($this->result);$Gi++)
		{     
		    $List[$Gi]=new ListTable("2");
		    $List[$Gi]->setClass("products_listproducts");
			$List[$Gi]->addElement(new Lable($this->result[$Gi]['groupinfo']['title']),2);
			$List[$Gi]->setLastElementClass("grouptitle");
			for ($Pi=0;$Pi<count($this->result[$Gi]['products']);$Pi++)
			{
			    
			    $Operations[$Gi][$Pi]=new Div();
			    $Operations[$Gi][$Pi]->setClass("operations");

			    $EditLink[$Gi][$Pi]=new AppRooter("products", "addproduct");
			    $EditLink[$Gi][$Pi]->addParameter(new UrlParameter("productid", $this->result[$Gi]['products'][$Pi]['id']));
			    
			    $DeleteLink[$Gi][$Pi]=new AppRooter("products", "deleteproduct");
			    $DeleteLink[$Gi][$Pi]->addParameter(new UrlParameter("productid", $this->result[$Gi]['products'][$Pi]['id']));
			    $Delete[$Gi][$Pi]=new link($DeleteLink[$Gi][$Pi]->getAbsoluteURL(), new Lable("حذف"));
			    $Delete[$Gi][$Pi]->setClass("delete");
			    $Edit[$Gi][$Pi]=new link($EditLink[$Gi][$Pi]->getAbsoluteURL(), new Lable("ویرایش"));
			    $Edit[$Gi][$Pi]->setClass("edit");
			    $Operations[$Gi][$Pi]->addElement($Delete[$Gi][$Pi]);
			    $Operations[$Gi][$Pi]->addElement($Edit[$Gi][$Pi]);
			    
			    $Title[$Gi][$Pi]=new link($EditLink[$Gi][$Pi]->getAbsoluteURL(),new Lable($this->result[$Gi]['products'][$Pi]['title']));
			    $Title[$Gi][$Pi]->setClass("producttitle");
			    $List[$Gi]->addElement($Title[$Gi][$Pi]);
			    $List[$Gi]->addElement($Operations[$Gi][$Pi]);
			}
			$Groups->addElement($List[$Gi]);
		}
		
		$form=new SweetFrom("", "POST", $Groups);
		return $form;
	}

	public function setResult($result)
	{
	    $this->result = $result;
	}
}

?>