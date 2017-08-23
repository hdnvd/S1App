<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_componentgroupEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-26 - 2017-02-14 08:52
*@lastUpdate 1395-11-26 - 2017-02-14 08:52
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponentgroupsController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $comEnt=new buysell_componentgroupEntity($DBAccessor);
		if($ID!=-1){
			//Do Something...
		}
		$result['components']=$comEnt->Select(null,null,null,null,null,array('title'),array(false),"0,1000");
		$DBAccessor->close_connection();
		return $result;
	}
}
?>