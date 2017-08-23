<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_componentgroupEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-26 - 2017-02-14 08:32
*@lastUpdate 1395-11-26 - 2017-02-14 08:32
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponentgroupController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $CompEnt=new buysell_componentgroupEntity($DBAccessor);
		if($ID!=-1){
            $result['component']=$CompEnt->Select($ID,null,null,null,null,array('title'),array(false),"0,1000")[0];
		}
		$result['components']=$CompEnt->Select(null,null,null,null,null,array('title'),array(false),"0,1000");
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$txtLatinTitle,$txtTitle,$cmbMotherGroup)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $CompEnt=new buysell_componentgroupEntity($DBAccessor);
		if($ID==-1){
            $CompEnt->Insert($cmbMotherGroup,$txtLatinTitle,$txtTitle);
		}
		else{
            $CompEnt->Update($ID,$cmbMotherGroup,$txtLatinTitle,$txtTitle);
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $this->load($ID);
	}
}
?>