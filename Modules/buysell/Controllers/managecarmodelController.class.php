<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_carmakerEntity;
use Modules\buysell\Entity\buysell_carmodelEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-21 - 2017-02-09 01:49
*@lastUpdate 1395-11-21 - 2017-02-09 01:49
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class managecarmodelController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $CmaEnt=new buysell_carmakerEntity($DBAccessor);
        if($ID>=0)
        {
            $CmodEnt=new buysell_carmodelEntity($DBAccessor);
            $result['carmodel']=$CmodEnt->Select($ID,null,null,null,-1,array('id'),array(false),"0,1")[0];
        }
		$result['carmakers']=$CmaEnt->Select(null,null,null,null,array('title'),array(false),"0,1000");
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($id,$txtLatinTitle,$txtTitle,$cmbMaker,$Cargroup_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
        $cmoEnt=new buysell_carmodelEntity($DBAccessor);
        if($id>0)
            $cmoEnt->Update($id,$cmbMaker,$txtLatinTitle,$txtTitle,$Cargroup_fid);
        else
            $cmoEnt->Insert($cmbMaker,$txtLatinTitle,$txtTitle,$Cargroup_fid);
		$result=array();
		$DBAccessor->close_connection();
		return $this->load($id);
	}
}
?>