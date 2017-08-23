<?php
namespace Modules\room\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\room\Entity\room_carEntity;
use Modules\room\Entity\room_carcolorEntity;
use Modules\room\Entity\room_paytypeEntity;
use Modules\room\Entity\room_cartypeEntity;
use Modules\room\Entity\room_carbodystatusEntity;
use Modules\room\Entity\room_carstatusEntity;
use Modules\room\Entity\room_shasitypeEntity;
use Modules\room\Entity\room_carmodelEntity;
use Modules\room\Entity\room_cartagtypeEntity;
use Modules\room\Entity\room_carentitytypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-05-25 - 2017-08-16 01:15
*@lastUpdate 1396-05-25 - 2017-08-16 01:15
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managecarController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$carEntityObject=new room_carEntity($DBAccessor);
			$body_carcolorEntityObject=new room_carcolorEntity($DBAccessor);
			$result['body_carcolor_fid']=$body_carcolorEntityObject->FindAll(new QueryLogic());
			$inner_carcolorEntityObject=new room_carcolorEntity($DBAccessor);
			$result['inner_carcolor_fid']=$inner_carcolorEntityObject->FindAll(new QueryLogic());
			$paytypeEntityObject=new room_paytypeEntity($DBAccessor);
			$result['paytype_fid']=$paytypeEntityObject->FindAll(new QueryLogic());
			$cartypeEntityObject=new room_cartypeEntity($DBAccessor);
			$result['cartype_fid']=$cartypeEntityObject->FindAll(new QueryLogic());
			$carbodystatusEntityObject=new room_carbodystatusEntity($DBAccessor);
			$result['carbodystatus_fid']=$carbodystatusEntityObject->FindAll(new QueryLogic());
			$carstatusEntityObject=new room_carstatusEntity($DBAccessor);
			$result['carstatus_fid']=$carstatusEntityObject->FindAll(new QueryLogic());
			$shasitypeEntityObject=new room_shasitypeEntity($DBAccessor);
			$result['shasitype_fid']=$shasitypeEntityObject->FindAll(new QueryLogic());
			$carmodelEntityObject=new room_carmodelEntity($DBAccessor);
			$result['carmodel_fid']=$carmodelEntityObject->FindAll(new QueryLogic());
			$cartagtypeEntityObject=new room_cartagtypeEntity($DBAccessor);
			$result['cartagtype_fid']=$cartagtypeEntityObject->FindAll(new QueryLogic());
			$carentitytypeEntityObject=new room_carentitytypeEntity($DBAccessor);
			$result['carentitytype_fid']=$carentitytypeEntityObject->FindAll(new QueryLogic());
		if($ID!=-1){
			$carEntityObject->setId($ID);
			if($carEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['car']=$carEntityObject;
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
		if($ID==-1){
			$carEntityObject=new room_carEntity($DBAccessor);
			$carEntityObject->setDetails($details);
			$carEntityObject->setPrice($price);
			$carEntityObject->setAdddate($adddate);
			$carEntityObject->setBody_carcolor_fid($body_carcolor_fid);
			$carEntityObject->setInner_carcolor_fid($inner_carcolor_fid);
			$carEntityObject->setPaytype_fid($paytype_fid);
			$carEntityObject->setCartype_fid($cartype_fid);
			$carEntityObject->setUsagecount($usagecount);
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
			$carEntityObject=new room_carEntity($DBAccessor);
			$carEntityObject->setId($ID);
			if($carEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$carEntityObject->setDetails($details);
			$carEntityObject->setPrice($price);
			$carEntityObject->setAdddate($adddate);
			$carEntityObject->setBody_carcolor_fid($body_carcolor_fid);
			$carEntityObject->setInner_carcolor_fid($inner_carcolor_fid);
			$carEntityObject->setPaytype_fid($paytype_fid);
			$carEntityObject->setCartype_fid($cartype_fid);
			$carEntityObject->setUsagecount($usagecount);
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
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>