<?php

namespace Modules\products\Controllers;
use core\CoreClasses\services\Controller;
use Modules\parameters\PublicClasses\ParameterManager;
use Modules\products\Entity\ProductEntity;
use Modules\products\Entity\productAdditionalInfoEntity;
use Modules\products\Entity\ProductPhotoEntity;
use Modules\languages\PublicClasses\LanguageTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Entity\products_productproductgroupEntity;

/**
 *
 * @author nahavandi
 *        
 */
class showproductController extends Product {
	private function IncreaseProductVisits($ProductID)
	{
		$ent=new ProductEntity();
		$p=$ent->Select($ProductID, null, null, null, null, null, null, null, null, null, null, null, null,null);
		$ent->Update($ProductID, null, null, null, null, null, null, $p[0]['visits']+1,null, null, null, null,null);
	}
	public function load($ProductID)
	{
		$this->IncreaseProductVisits($ProductID);
		$result['product']=$this->getProductByID($ProductID);
		$result['additionalinfostitle']=$this->getAdditionalInfosTitle();
		return $result;
	}
}

?>