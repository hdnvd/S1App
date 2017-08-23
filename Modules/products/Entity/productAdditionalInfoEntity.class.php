<?php

namespace Modules\products\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;

/**
 *
 * @author nahavandi
 *        
 */
class productAdditionalInfoEntity extends EntityClass {
	public function Add($ProductId,$AdditionalInfos)
	{
		$Database=new dbquery();
		if(!is_null($AdditionalInfos) && count($AdditionalInfos)>0)
		{
				
			$Query=$Database->InsertInto("productinfo")->Set("product_fid", $ProductId);
			for($i=0;$i<count($AdditionalInfos);$i++)
			{
				$Query=$Query->Set(("info" . ($i+1)), $AdditionalInfos[$i]);
			}
			$Query->Execute();
		}
	}
	public function Edit($ProductId,$AdditionalInfos)
	{
		$Database=new dbquery();
		if(!is_null($AdditionalInfos) && count($AdditionalInfos)>0)
		{
	
			$Query=$Database->Update("productinfo");
			for($i=0;$i<count($AdditionalInfos);$i++)
				$Query=$Query->Set(("info" . ($i+1)), $AdditionalInfos[$i]);
			$Query=$Query->Where()->Equal("product_fid", $ProductId);
			$Query->Execute();
		}
	}
	public function getProductInfo($ProductID)
	{
		$Database=new dbquery();
		$query=$Database->Select("*")->From("productinfo")->Where()->Equal("product_fid", $ProductID);
		return $query->ExecuteAssociated();
	}
}

?>