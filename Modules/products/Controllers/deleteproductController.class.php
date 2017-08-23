<?php

namespace Modules\products\Controllers;
use core\CoreClasses\services\Controller;
use Modules\products\Entity\ProductEntity;
use Modules\products\Entity\products_productproductgroupEntity;
use Modules\products\Entity\ProductPhotoEntity;


class deleteproductController extends Controller {
	public function load($ProductID)
	{
		$E=new ProductEntity();
		$E->Delete($ProductID);
		$PPGroupEnt=new products_productproductgroupEntity();
		$productPhotoEnt=new ProductPhotoEntity();

		$ProductPhotos=$productPhotoEnt->getProductPhotos($ProductID);
		$ProductGroups=$PPGroupEnt->Select(null, $ProductID, null, "0");
		for($i=0;$i<count($ProductGroups);$i++)
			$PPGroupEnt->Update($ProductGroups[0]['id'], null, null, "1");
		for($i=0;$i<count($ProductPhotos);$i++)
			$productPhotoEnt->Update($ProductPhotos[0]['id'], null, null, null, null, "1");
	}
}
?>
