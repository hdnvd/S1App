<?php

namespace Modules\products\Controllers;

use core\CoreClasses\services\Controller;
use Modules\products\Entity\ProductEntity;
use Modules\products\Entity\ProductGroupEntity;
use Modules\products\EntityObjects\ProductEO;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Entity\products_productgrouplangEntity;
use Modules\products\Entity\products_productproductgroupEntity;
use Modules\products\Entity\products_productgroupEntity;

/**
 *
 * @author nahavandi
 *        
 */
class ProductController extends Product {
	
	
	/**
	 * @param Int $groupLangID
	 * @param String $Limit
	 * @return array(products,productscount,groupinfo)
	 */
	public function getGroupLangProducts($groupID,$Limit)
	{
		$ent=new ProductEntity();
		$PGroupLangEnt=new products_productproductgroupEntity();
		$GroupLangEnt=new products_productgroupEntity();
		$result[0]['groupinfo']=$GroupLangEnt->Select($groupID, null, null, null, null,null, "0,1", null, false);
		$result[0]['groupinfo']=$result[0]['groupinfo'][0];
		$result[0]['products']=$ent->getGroupLangProducts($groupLangID,$Limit);
		$result[0]['productscount']=$ent->getGroupLangProductsCount($groupLangID);
		$result[0]['productscount']=$result[0]['productscount'][0]['resultcount'];
		
		return $result;
	}
	
	/**
	 * @param String $ProductTitle
	 * @param String $Limit
	 * @return array(products,productscount)
	 */
	public function searchProductsByTitle($ProductTitle,$Limit)
	{
		$ent=new ProductEntity();
		$ProductTitle="%$ProductTitle%";
		$result[0]['products']=$ent->Select(null, null, $ProductTitle, null, null, null, null, null, null, null, null,$Limit, null,null);
		$result[0]['productscount']=$ent->SelectCount(null, null, $ProductTitle, null, null, null, null, null, null, null, null,$Limit, null,null);
		$result[0]['productscount']=$result[0]['productscount'][0]['resultcount'];
		return $result;
	}
	/**
	 * @param String $Limit
	 * @return array(products,productscount)
	 */
	public function getAll($Limit)
	{
		$ent=new ProductEntity();
		$result[0]['products']=$ent->Select(null, null, null, null, null, null, null, null, null, null,null, $Limit, null, null);
		$result[0]['productscount']=$ent->SelectCount(null, null, null, null, null, null, null, null, null, null, null, null, null,null);
		$result[0]['productscount']=$result[0]['productscount'][0]['resultcount'];
		return $result;
	}
	
	public function getAllGroupsProducts($Limit)
	{
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$ent=new ProductEntity();
		$GroupEnt=new products_productgrouplangEntity();
		$groups=$GroupEnt->Select(null, null, $LanguageID, null, null,null,null);
		for($i=0;$i<count($groups);$i++)
		{
			$result[$i]['groupinfo']=$groups[$i];
			$result[$i]['products']=$ent->getGroupLangProducts($groups[$i]['id']);
			$result[0]['productscount']=$ent->getGroupLangProductsCount($groups[$i]['id']);
		}
		return $result;
	}
	
}

?>