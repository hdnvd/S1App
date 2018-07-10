<?php

namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/10/6 - 2016/12/26 02:02:59
 *@lastUpdate 1395/10/6 - 2016/12/26 02:02:59
 *@SweetFrameworkHelperVersion 1.112
*/


class edituserinfoController extends Controller {
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
