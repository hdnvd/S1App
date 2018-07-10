<?php

namespace Modules\posts\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2016/05/13 16:40:00
 *@lastUpdate 2016/05/13 16:40:00
 *@SweetFrameworkHelperVersion 1.109
*/


class clearcacheController extends Controller {
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
