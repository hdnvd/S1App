<?php

namespace Modules\products\Controllers;

use core\CoreClasses\services\Controller;
use Modules\products\BusinessObjects\productBO;
use Modules\products\EntityObjects\ProductEO;
use Modules\products\Entity\ProductEntity;
use Modules\products\Entity\ProductGroupEntity;
use core\CoreClasses\SweetDate;
use Modules\products\Entity\ProductPhotoEntity;
use Modules\products\Entity\productAdditionalInfoEntity;
use Modules\users\PublicClasses\sessionuser;
use Modules\products\Entity\products_productproductgroupEntity;
use Modules\products\Entity\products_productgroupEntity;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class ProductManageController extends Product 
{
	private function now()
	{
		date_default_timezone_set("UTC");
		$date = new SweetDate(true, true, 'Asia/Tehran');
		return $date->date("Y-m-d H:i:s",false,false);
	}
	public function addProduct($LatinName,$Title,$Description,$MainPhoto,$ThumbnailURL,$Visits,$Rank,$IsPublished,$IsNew,array $AdditionalInfos,$Group,array $Photos,$IsExists)
	{
		$SU=new sessionuser();
		$UserID=$SU->getSystemUserID();
		$AddDate=$this->now();
		$EntityClass=new ProductEntity();
		$productID=$EntityClass->Insert($LatinName, $Title, $Description, $MainPhoto, $ThumbnailURL,$AddDate, $Visits, $Rank, $IsPublished,$IsNew,$IsExists, $UserID);
		
		$InfoEntity=new productAdditionalInfoEntity();
		$InfoEntity->Add($productID,$AdditionalInfos);
		$groupEntity=new products_productproductgroupEntity();
		$groupEntity->Insert($productID, $Group);
		$photoEntity=new ProductPhotoEntity();
		$photo=$Photos;
		for($i=0;$i<count($Photos);$i++)
			$photoEntity->addPhoto($photo[$i], $Title . " " . $i , $productID,$i);
	}
	public function editProduct($ProductID,$LatinName,$Title,$Description,$MainPhoto,$ThumbnailURL,$Visits,$Rank,$IsPublished,$IsNew,array $AdditionalInfos,$Group,array $Photos,$IsExists)
	{

		$SU=new sessionuser();
		$UserID=$SU->getSystemUserID();
		$AddDate=$this->now();
		$EntityClass=new ProductEntity();
		$EntityClass->Update($ProductID, $LatinName, $Title, $Description, $MainPhoto, $ThumbnailURL, $AddDate, $Visits, $Rank, $IsPublished,$IsNew,$IsExists, $UserID);
		
		$InfoEntity=new productAdditionalInfoEntity();
		$InfoEntity->Edit($ProductID, $AdditionalInfos);
		
		$groupEntity=new products_productproductgroupEntity();
		$PPGroupID=$groupEntity->Select(null, $ProductID, null, "0");
		$groupEntity->Update($PPGroupID[0]['id'],$ProductID, $Group, null);
		
		
		$photoEntity=new ProductPhotoEntity();
		$photo=$Photos;
		for($i=0;!is_null($photo) && $i<count($photo);$i++)
		{
			if(!is_null($photo[$i]))
					$photoEntity->editProductPhoto($ProductID, $i, $photo[$i], $Title);
		}
		
	}
	public function loadLangGroups($langID)
	{
		$GE=new products_productgroupEntity();
		return $GE->Select(null, null, $langID, null, null,null, "0,100", null, null);
	}
}

?>