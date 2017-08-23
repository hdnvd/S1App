<?php
namespace Modules\test2\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-07 - 2017-01-26 19:26
*@lastUpdate 1395-11-07 - 2017-01-26 19:26
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class t2Controller extends Controller {
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