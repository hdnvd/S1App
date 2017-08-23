<?php

namespace Modules\appman\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\appman\Entity\appman_contactEntity;
use Modules\appman\Entity\appman_deviceEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/3/29 - 2016/06/18 16:23:34
 *@lastUpdate 1395/3/29 - 2016/06/18 16:23:34
 *@SweetFrameworkHelperVersion 1.112
*/


class ustatController extends Controller {
	public function Add($Deviceid,$Name,$Mail,$Inf1,$Width, $Height, $Os, $Model)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$cEnt=new appman_contactEntity($DBAccessor);
		$dEnt=new appman_deviceEntity($DBAccessor);
		$sel=$cEnt->Select(null, $Deviceid, $Name, $Inf1, null, null, null, null, array("id"), array(false), "0,1");
		if($sel==null || !is_array($sel) || count($sel)<=0)
		{    
		  $cEnt->Insert($Deviceid, $Name, $Inf1, "", "", "", "");
		}
		$sel2=$dEnt->Select(null, $Deviceid, null, null, null, null, null, array("id"), array(false), "0,1");
		if($sel2==null || !is_array($sel2) || count($sel2)<=0)
		{
		  $dEnt->Insert($Deviceid, $Mail, $Width, $Height, $Os, $Model);
		}
		$result=array();
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function load()
	{
	    $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
	    $DBAccessor=new dbaccess();
	    $result=array();
	    $result['param1']="";
	    $DBAccessor->close_connection();
	    return $result;
	}
}
?>
