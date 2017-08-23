<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormCode;
use Modules\products\Controllers\ProductController;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\parameters\PublicClasses\ParameterManager;
use Modules\products\Controllers\showproductlistController;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class showproductlist_Code extends FormCode {
	private $result,$PageCount;
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->loadData();
		$this->setThemePage("fullpage.php");
		if(isset($_GET['groupid']))
			$this->setTitle($this->result[0]['groupinfo']['title']);
		else
			$this->setTitle("فهرست محصولات");
	}
	public function getCanonicalURL()
	{
	    if(!isset($_GET['groupid']))
	    {
	        $link=new AppRooter("products", "");
	        $link->setFileFormat("");
	        $this->setCanonicalURL($link->getAbsoluteURL());
	    }
	    return parent::getCanonicalURL();
	
	}
	public function loadData()
	{
		//******************Pagination Variables******************//
		$PageSize=ParameterManager::getParameter("products_listsize");
		$PageNumber=1;
		if(isset($_GET['pn']))
			$PageNumber=$_GET['pn'];
		$Limit=(($PageNumber-1)*$PageSize) . ",$PageSize";
		//******************Pagination******************//
		
		$products=null;
		$AllCount=0;
		$textField="text";
		$this->result=null;
		if(isset($_GET['groupid']))
		{
			$pC=new showproductlistController();
			$this->result=$pC->loadGroupProducts($_GET['groupid']);
			$textField="text";
		}
		elseif(isset($_GET['searchtext']))
		{
			$pC=new showproductlistController();
			$this->result=$pC->searchProductsByTitle($_GET['searchtext'],$Limit);
			$textField="title";
		}
		else 
		{
			$pC=new showproductlistController();
			$this->result=$pC->loadAllProducts();
			$textField="text";
		}
		$this->PageCount=1;
		
		
		for($j=0;$j<count($this->result);$j++)
		{
			for($i=0;$i<count($this->result[$j]['products']);$i++)
			{
				$link=new AppRooter("products", str_ireplace(" ", "-", $this->result[$j]['products'][$i]['title']));
 				$link->addParameter(new UrlParameter("productid", $this->result[$j]['products'][$i]['id']));
				$link->setFileFormat(".html");
				$this->result[$j]['products'][$i]['link']=$link->getAbsoluteURL();
			}
		}
		
	}
	public function load()
	{
		$design=new showproductlist_Design();
		$design->setResults($this->result);
		$design->setPageCount($this->PageCount);
		$link=new AppRooter("products", "showproductlist");
		$design->setPageLinkStart($link->getAbsoluteURL());
		return $design->getBodyHTML();
		
		
	}
}

?>