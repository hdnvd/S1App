<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\SweetDate;
use Modules\buysell\Entity\buysell_carmakerEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use Modules\buysell\Entity\buysell_carEntity;
use Modules\buysell\Entity\buysell_carcolorEntity;
use Modules\buysell\Entity\buysell_paytypeEntity;
use Modules\buysell\Entity\buysell_cartypeEntity;
use Modules\buysell\Entity\buysell_carbodystatusEntity;
use Modules\buysell\Entity\buysell_carstatusEntity;
use Modules\buysell\Entity\buysell_shasitypeEntity;
use Modules\buysell\Entity\buysell_carmodelEntity;
use Modules\buysell\Entity\buysell_cartagtypeEntity;
use Modules\buysell\Entity\buysell_carentitytypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-25 - 2017-06-15 02:03
*@lastUpdate 1396-03-25 - 2017-06-15 02:03
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecarController extends Controller {
    public function load($ID,$GroupID)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $result=array();
        $carEntityObject=new buysell_carEntity($DBAccessor);
        $body_carcolorEntityObject=new buysell_carcolorEntity($DBAccessor);
        $result['body_carcolor_fid']=$body_carcolorEntityObject->FindAll(new QueryLogic());
        $inner_carcolorEntityObject=new buysell_carcolorEntity($DBAccessor);
        $result['inner_carcolor_fid']=$inner_carcolorEntityObject->FindAll(new QueryLogic());
        $paytypeEntityObject=new buysell_paytypeEntity($DBAccessor);
        $result['paytype_fid']=$paytypeEntityObject->FindAll(new QueryLogic());
        $cartypeEntityObject=new buysell_cartypeEntity($DBAccessor);
        $result['cartype_fid']=$cartypeEntityObject->FindAll(new QueryLogic());
        $carbodystatusEntityObject=new buysell_carbodystatusEntity($DBAccessor);
        $result['carbodystatus_fid']=$carbodystatusEntityObject->FindAll(new QueryLogic());
        $carstatusEntityObject=new buysell_carstatusEntity($DBAccessor);
        $result['carstatus_fid']=$carstatusEntityObject->FindAll(new QueryLogic());
        $shasitypeEntityObject=new buysell_shasitypeEntity($DBAccessor);
        $result['shasitype_fid']=$shasitypeEntityObject->FindAll(new QueryLogic());
        $carmakerEntityObject=new buysell_carmakerEntity($DBAccessor);
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition("cargroup_fid",$GroupID));
        $result['carmaker_fid']=$carmakerEntityObject->FindAll($q);
        $cartagtypeEntityObject=new buysell_cartagtypeEntity($DBAccessor);
        $result['cartagtype_fid']=$cartagtypeEntityObject->FindAll(new QueryLogic());
        $carentitytypeEntityObject=new buysell_carentitytypeEntity($DBAccessor);
        $result['carentitytype_fid']=$carentitytypeEntityObject->FindAll(new QueryLogic());
        $date=new SweetDate(false,true,null);
        $year=$date->date("Y", time(), false, true, 'Asia/Tehran');
        $result['year']=$year;
        if($ID!=-1){
            $carEntityObject->setId($ID);
            $result['car']=$carEntityObject;
            $cmd=$carEntityObject->getCarmodel_fid();
            $carmodelEntityObject=new buysell_carmodelEntity($DBAccessor);
            $carmodelEntityObject->setId($cmd);
            $makerID=$carmodelEntityObject->getCarmaker_fid();
            $result['selectedcarmaker_fid']=$makerID;
            $q=new QueryLogic();
            $q->addCondition(new FieldCondition("carmaker_fid",$makerID));
            $result['carmodel_fid']=$carmodelEntityObject->FindAll($q);

        }
        $result['param1']="";
        $DBAccessor->close_connection();
        return $result;
    }

	public function BtnSave($ID,$details,$price,$adddate,$body_carcolor_fid,$inner_carcolor_fid,$paytype_fid,$cartype_fid,$usagecount,$wheretodate,$carbodystatus_fid,$makedate,$carstatus_fid,$shasitype_fid,$isautogearbox,$carmodel_fid,$cartagtype_fid,$carentitytype_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
        $adddate=time();
        $carEntityObject=null;
        $carModEnt=new buysell_carmodelEntity($DBAccessor);
        $carModEnt->setId($carmodel_fid);
        $GroupID=$carModEnt->getCargroup_fid();
		if($ID==-1){
			$carEntityObject=new buysell_carEntity($DBAccessor);
			$carEntityObject->setDetails($details);
			$carEntityObject->setPrice($price);
			$carEntityObject->setAdddate($adddate);
			$carEntityObject->setBody_carcolor_fid($body_carcolor_fid);
			$carEntityObject->setInner_carcolor_fid($inner_carcolor_fid);
			$carEntityObject->setPaytype_fid($paytype_fid);
			$carEntityObject->setCartype_fid($cartype_fid);
			$carEntityObject->setUsagecount($usagecount);
			$carEntityObject->setRole_systemuser_fid($role_systemuser_fid);
			$carEntityObject->setWheretodate($wheretodate);
			$carEntityObject->setCarbodystatus_fid($carbodystatus_fid);
			$carEntityObject->setMakedate($makedate);
			$carEntityObject->setCarstatus_fid($carstatus_fid);
			$carEntityObject->setShasitype_fid($shasitype_fid);
			$carEntityObject->setIsautogearbox($isautogearbox);
			$carEntityObject->setCarmodel_fid($carmodel_fid);
			$carEntityObject->setCartagtype_fid($cartagtype_fid);
			$carEntityObject->setCarentitytype_fid($carentitytype_fid);
			$carEntityObject->Save();
		}
		else{
			$carEntityObject=new buysell_carEntity($DBAccessor);
			$carEntityObject->setId($ID);
			$carEntityObject->setDetails($details);
			$carEntityObject->setPrice($price);
			$carEntityObject->setBody_carcolor_fid($body_carcolor_fid);
			$carEntityObject->setInner_carcolor_fid($inner_carcolor_fid);
			$carEntityObject->setPaytype_fid($paytype_fid);
			$carEntityObject->setCartype_fid($cartype_fid);
			$carEntityObject->setUsagecount($usagecount);
			$carEntityObject->setRole_systemuser_fid($role_systemuser_fid);
			$carEntityObject->setWheretodate($wheretodate);
			$carEntityObject->setCarbodystatus_fid($carbodystatus_fid);
			$carEntityObject->setMakedate($makedate);
			$carEntityObject->setCarstatus_fid($carstatus_fid);
			$carEntityObject->setShasitype_fid($shasitype_fid);
			$carEntityObject->setIsautogearbox($isautogearbox);
			$carEntityObject->setCarmodel_fid($carmodel_fid);
			$carEntityObject->setCartagtype_fid($cartagtype_fid);
			$carEntityObject->setCarentitytype_fid($carentitytype_fid);
			$carEntityObject->Save();
		}
		$result=$this->load($ID,$GroupID);

		$result['id']=$carEntityObject->getId();
		$DBAccessor->close_connection();
		return $result;
	}
}
?>