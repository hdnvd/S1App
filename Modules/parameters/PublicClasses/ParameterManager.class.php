<?php

namespace Modules\parameters\PublicClasses;

use Modules\parameters\Entity\ParameterEntity;
/**
 *
 * @author Hadi Nahavandi
 *        
 */
class ParameterManager {
    public static function updateParameter($name,$newvalue)
    {
    	$ent=new ParameterEntity();
    	$ent->updateParameter($name, $newvalue);
    	return $name;
    }
    public static function getParameter($name)
    {
    	$ent=new ParameterEntity();
    	$result=$ent->getParameter($name);
    	if($result!==null && count($result)>0)
    		return $result[0]['value'];
    	else 
    		return null;
    }
    
	
	
	
}

?>