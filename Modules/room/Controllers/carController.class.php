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
class carController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$carEntityObject=new room_carEntity($DBAccessor);
		if($ID!=-1){
			$carEntityObject->setId($ID);
			if($carEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['car']=$carEntityObject;
			$body_carcolorEntityObject=new room_carcolorEntity($DBAccessor);
			$body_carcolorEntityObject->SetId($result['car']->getBody_carcolor_fid());
			if($body_carcolorEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['body_carcolor_fid']=$body_carcolorEntityObject;
			$inner_carcolorEntityObject=new room_carcolorEntity($DBAccessor);
			$inner_carcolorEntityObject->SetId($result['car']->getInner_carcolor_fid());
			if($inner_carcolorEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['inner_carcolor_fid']=$inner_carcolorEntityObject;
			$paytypeEntityObject=new room_paytypeEntity($DBAccessor);
			$paytypeEntityObject->SetId($result['car']->getPaytype_fid());
			if($paytypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['paytype_fid']=$paytypeEntityObject;
			$cartypeEntityObject=new room_cartypeEntity($DBAccessor);
			$cartypeEntityObject->SetId($result['car']->getCartype_fid());
			if($cartypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['cartype_fid']=$cartypeEntityObject;
			$carbodystatusEntityObject=new room_carbodystatusEntity($DBAccessor);
			$carbodystatusEntityObject->SetId($result['car']->getCarbodystatus_fid());
			if($carbodystatusEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['carbodystatus_fid']=$carbodystatusEntityObject;
			$carstatusEntityObject=new room_carstatusEntity($DBAccessor);
			$carstatusEntityObject->SetId($result['car']->getCarstatus_fid());
			if($carstatusEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['carstatus_fid']=$carstatusEntityObject;
			$shasitypeEntityObject=new room_shasitypeEntity($DBAccessor);
			$shasitypeEntityObject->SetId($result['car']->getShasitype_fid());
			if($shasitypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['shasitype_fid']=$shasitypeEntityObject;
			$carmodelEntityObject=new room_carmodelEntity($DBAccessor);
			$carmodelEntityObject->SetId($result['car']->getCarmodel_fid());
			if($carmodelEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['carmodel_fid']=$carmodelEntityObject;
			$cartagtypeEntityObject=new room_cartagtypeEntity($DBAccessor);
			$cartagtypeEntityObject->SetId($result['car']->getCartagtype_fid());
			if($cartagtypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['cartagtype_fid']=$cartagtypeEntityObject;
			$carentitytypeEntityObject=new room_carentitytypeEntity($DBAccessor);
			$carentitytypeEntityObject->SetId($result['car']->getCarentitytype_fid());
			if($carentitytypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['carentitytype_fid']=$carentitytypeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>