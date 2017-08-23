<?php

namespace Modules\common\Entity;

use core\CoreClasses\services\EntityClass;
/**
 *
 * @author nahavandi
 *        
 */
class selectabaleEntity extends EntityClass{
	public function Select(array $Fields,array $FieldValues,array $Logics=null)
	{
		$theFields=array();
		for($i=0;$i<count($Fields);$i++)
		{
		$theFields[$i]['name']=$Fields[$i];
		if($i<count($FieldValues))
			$theFields[$i]['value']=$FieldValues[$i];
			else
				$theFields[$i]['value']=null;
		}
		
		return $this->getSelect(array("*"), $theFields,$Logics);
	}
}

?>