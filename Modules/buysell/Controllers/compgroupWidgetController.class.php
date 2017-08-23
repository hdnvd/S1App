<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_componentgroupEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-12-20 - 2017-03-10 15:04
*@lastUpdate 1395-12-20 - 2017-03-10 15:04
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class compgroupWidgetController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $compGroup=new buysell_componentgroupEntity($DBAccessor);
		if($ID!=-1){
			//Do Something...
		}
		$result['groups']=$compGroup->Select(null,-1,null,null,null,array(),array(),"0,100");
		$DBAccessor->close_connection();
		return $result;
	}
}
?>