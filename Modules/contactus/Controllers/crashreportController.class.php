<?php

namespace Modules\contactus\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\contactus\Entity\contactus_crashreportEntity;
use core\CoreClasses\SweetDate;
use Modules\common\PublicClasses\AppDate;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/08/13 18:48:28
 *@lastUpdate 2015/08/13 18:48:28
 *@SweetFrameworkHelperVersion 1.107
*/


class crashreportController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function AddReport($Appid,$Appversion,$Platform,$Os,$Devicemodel,$Width,$Height,$Systeminfo,$Exceptionid,$Excpetionmessage,$Usermessage,$Syslog,$Accounts,$IP,$UserAgent)
	{
	    $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
	    $DBAccessor=new dbaccess();
	    $Ent=new contactus_crashreportEntity($DBAccessor);
	    $Time=AppDate::now();
	    $Ent->Insert($Width, $Height, $Os, $Devicemodel, $Platform, $Accounts, $Systeminfo, $Time, $IP, $Exceptionid, $Excpetionmessage, $Usermessage, $Appversion, $Syslog, $Appid, $UserAgent);
	    $result=array();
	    $result['param1']="";
	    $DBAccessor->close_connection();
	    return $result;
	}
}
?>
