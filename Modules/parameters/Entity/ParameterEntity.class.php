<?php

namespace Modules\parameters\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use Modules\common\PublicClasses\AppDate;

/**
 *
 * @author nahavandi
 *        
 */
class ParameterEntity extends EntityClass {
	public function updateParameter($parameterName,$newValue)
    {
    	$Database=new dbquery();
    	$Res=$this->getParameter($parameterName);
    	$query=null;
    	if($Res!=null && is_array($Res) && count($Res)>0)
    	   $query=$Database->Update("parameter")->Set("value", $newValue)->Set("lastupdate", AppDate::now())->Where()->Equal("name", $parameterName);
    	else 
    	   $query=$Database->InsertInto("parameter")->Set("name", $parameterName)->Set("value", $newValue)->Set("lastupdate", AppDate::now());
    	return $query->Execute();
    }
    public function getParameter($parameterName)
    {
		$Database=new dbquery();
    	$query=$Database->Select("*")->From("parameter")->Where()->Equal("name", $parameterName);
    	return $query->ExecuteAssociated();
    }
}

?>