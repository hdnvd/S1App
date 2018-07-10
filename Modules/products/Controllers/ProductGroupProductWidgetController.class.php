<?php

namespace Modules\products\Controllers;

use core\CoreClasses\services\Controller;
use Modules\products\BusinessObjects\productGroupBO;
use Modules\products\Entity\ProductGroupEntity;
use Modules\pages\Entity\languageEntity;
use Modules\products\Entity\ProductEntity;
use Modules\products\BusinessObjects\productGroupLangBO;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Entity\products_productgroupEntity;
use Modules\products\Entity\products_productproductgroupEntity;

/**
 *
 * @author nahavandi
 *        
 */
class ProductGroupProductWidgetController extends Controller {
	private $GroupInfo;
	public function load()
	{
// 		echo "ProductGroupProductWidgetController:26";
 		$result["groupproducts"]=$this->loadGroupLangsLinkArray(-1);
		return $result;
	}
	private function loadGroupLangsLinkArray($MotherGroupID)
	{
		$languageID=CurrentLanguageManager::getCurrentLanguageID();
		$ent=new products_productgroupEntity();
		$group=$ent->Select(null, $MotherGroupID, $languageID, null, null,"1", "0,100", null, null);

		if($group!==null)
			for($i=0;$i<count($group);$i++)
			{

				$group[$i]['type']="group";
				$link=new AppRooter("products", str_ireplace(" ", "-", $group[$i]['title']));
				$link->setFileFormat(".group");
				$link->addParameter(new UrlParameter("groupid", $group[$i]['id']));
				$group[$i]['link']= $link->getAbsoluteURL();
				$subs=$this->loadGroupLangsLinkArray($group[$i]['id']);
				if($subs===null)
					$subs=$this->loadGroupLangProductsLinkArray($group[$i]['id']);
				elseif($this->loadGroupLangProductsLinkArray($group[$i]['id'])!==null)
					$subs=array_merge($subs,$this->loadGroupLangProductsLinkArray($group[$i]['id']));
				$group[$i]['subgroups']=$subs;

			}
	//if($MotherGroupID=="-1")
	//	var_dump($group);
			
		return $group;
	}
	private function loadGroupLangProductsLinkArray($GroupID)
	{
		$PEnt=new ProductEntity();
		$ent=new products_productproductgroupEntity();
		$result=$ent->Select(null, null, $GroupID, "0");
		if(!is_null($result))
			
		{
			for($i=0;$i<count($result);$i++)
			{
				$result[$i]['type']="product";
				$product=$PEnt->Select($result[$i]['product_fid'], null, null, null, null, null, null, null, null, "1", null, "0,1", null, false);
				$result[$i]['title']=$product[0]['title'];
				$link=new AppRooter("products", str_ireplace(" ", "-", $result[$i]['title']));
				$link->setFileFormat(".html");
				$link->addParameter(new UrlParameter("productid", $result[$i]['product_fid']));
				$result[$i]['link']=$link->getAbsoluteURL();
			}
		}
		return $result;
	}
	
}

?>