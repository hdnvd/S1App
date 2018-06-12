<?php

namespace Modules\sfman\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Entity\sfman_formEntity;
use Modules\sfman\Entity\sfman_moduleEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/10/9 - 2016/12/29 02:42:14
 *@lastUpdate 1395/10/9 - 2016/12/29 02:42:14
 *@SweetFrameworkHelperVersion 1.112
*/


class manageformsController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$Ment=new sfman_moduleEntity($DBAccessor);
		$Fent=new sfman_formEntity($DBAccessor);
		$result['modules']=$Ment->Select(null,null,null,null,array('id'),array(true),"0,100");
		for($i=0;$i<count($result['modules']);$i++)
			$result['modules'][$i]['forms']=$Fent->Select(null,null,null,$result['modules'][$i]['id'],null,array('name'),array(false),'0,200');
		$DBAccessor->close_connection();
		return $result;
	}
}
?>
