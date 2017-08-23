<?php

namespace Modules\products\Controllers;
use core\CoreClasses\services\Controller;
use Modules\products\Entity\ProductEntity;
use Modules\languages\PublicClasses\LanguageTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Entity\products_viewgroupproductsinfoEntity;
use Modules\products\Entity\products_productgroupEntity;
use Modules\products\Entity\products_productproductgroupEntity;

/**
 *
 * @author nahavandi
 *        
 */
class showproductlistController extends Product {
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
	
}

?>