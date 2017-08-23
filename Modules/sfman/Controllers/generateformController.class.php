<?php

namespace Modules\sfman\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Entity\sfman_formEntity;
use Modules\sfman\Entity\sfman_moduleEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/10/9 - 2016/12/29 02:25:33
 *@lastUpdate 1395/10/9 - 2016/12/29 02:25:33
 *@SweetFrameworkHelperVersion 1.112
*/


class generateformController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$Ment=new sfman_moduleEntity($DBAccessor);
		$result['modules']=$Ment->Select(null,null,null,null,array('id'),array(true),"0,100");
		$DBAccessor->close_connection();
		return $result;
	}
	public function makeform($ModuleID,$Name,$Title)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$Fent=new sfman_formEntity($DBAccessor);
		$Fent->Insert($Name,$Title,$ModuleID,true);
		$DBAccessor->close_connection();
		return $result;
	}
}
?>
