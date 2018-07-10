<?php

namespace Modules\appman\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\appman\Entity\appman_productkeyEntity;
use Modules\users\PublicClasses\sessionuser;
use Modules\common\PublicClasses\AppDate;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/10/16 23:17:12
 *@lastUpdate 2015/10/16 23:17:12
 *@SweetFrameworkHelperVersion 1.107
*/


class generatekeyController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function generateKey($KeyCount,$AppID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$Ent=new appman_productkeyEntity($DBAccessor);
		$result=array();
		$result['keys']=array();
		for($i=0;$i<$KeyCount;$i++)
		{
		    $tmpKey=$this->makeKey();
		    if($this->isKeyExists($tmpKey, $DBAccessor))//Key Exists,make another key
		        $i--;
		    else 
		    {
		        $sUser=new sessionuser();
		        $Ent->Insert($tmpKey, "notset", "notset", $sUser->getSystemUserID(), "-1", AppDate::now(),$AppID);
		        array_push($result['keys'],$tmpKey);
		    }
		}
		$DBAccessor->close_connection();
		return $result;
	}
	private function makeKey()
	{
	    $chars = array(1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z');
	    $serial = '';
	    $max = count($chars)-1;
	    for($i=0;$i<20;$i++){
	        $serial .= (!($i % 5) && $i ? '-' : '').$chars[rand(0, $max)];
	    }
	    return $serial;
	}
	private function isKeyExists($Key,dbaccess $DBAccessor)
	{
	    $Ent=new appman_productkeyEntity($DBAccessor);
		$result=$Ent->Select(null, $Key, null, null, null, null, null,null, array("id"), array(false), "0,1");
		if($result!=null && count($result)>0)
		    return true;
		else 
		    return false;
	}
}
?>
