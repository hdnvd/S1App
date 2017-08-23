<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\buysell\Entity\buysell_carmakerEntity;
use Modules\buysell\Entity\buysell_carphotoEntity;
use Modules\buysell\Entity\buysell_userEntity;
use Modules\common\Entity\common_cityEntity;
use Modules\common\PublicClasses\AppDate;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
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
*@creationDate 1396-03-31 - 2017-06-21 02:02
*@lastUpdate 1396-03-31 - 2017-06-21 02:02
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
		$carEntityObject=new buysell_carEntity($DBAccessor);
		if($ID!=-1){
		    $carEntityObject->setId($ID);
			if($carEntityObject->getId()==-1)
				throw new DataNotFoundException();
            $date=new SweetDate(false,true,null);
            $adddate=$date->date("Y/m/d ", $carEntityObject->getAdddate(), false, true, 'Asia/Tehran');
            $carEntityObject->setAdddate($adddate);
			$result['car']=$carEntityObject;
			$body_carcolorEntityObject=new buysell_carcolorEntity($DBAccessor);
			$body_carcolorEntityObject->SetId($result['car']->getBody_carcolor_fid());
			if($body_carcolorEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['body_carcolor_fid']=$body_carcolorEntityObject;
			$inner_carcolorEntityObject=new buysell_carcolorEntity($DBAccessor);
			$inner_carcolorEntityObject->SetId($result['car']->getInner_carcolor_fid());
			if($inner_carcolorEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['inner_carcolor_fid']=$inner_carcolorEntityObject;
			$paytypeEntityObject=new buysell_paytypeEntity($DBAccessor);
			$paytypeEntityObject->SetId($result['car']->getPaytype_fid());
			if($paytypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['paytype_fid']=$paytypeEntityObject;
			$cartypeEntityObject=new buysell_cartypeEntity($DBAccessor);
			$cartypeEntityObject->SetId($result['car']->getCartype_fid());
			if($cartypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['cartype_fid']=$cartypeEntityObject;
			$carbodystatusEntityObject=new buysell_carbodystatusEntity($DBAccessor);
			$carbodystatusEntityObject->SetId($result['car']->getCarbodystatus_fid());
			if($carbodystatusEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['carbodystatus_fid']=$carbodystatusEntityObject;
			$carstatusEntityObject=new buysell_carstatusEntity($DBAccessor);
			$carstatusEntityObject->SetId($result['car']->getCarstatus_fid());
//			if($carstatusEntityObject->getId()==-1)
//				throw new DataNotFoundException();
			$result['carstatus_fid']=$carstatusEntityObject;
			$shasitypeEntityObject=new buysell_shasitypeEntity($DBAccessor);
			$shasitypeEntityObject->SetId($result['car']->getShasitype_fid());
			if($shasitypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['shasitype_fid']=$shasitypeEntityObject;
			$carmodelEntityObject=new buysell_carmodelEntity($DBAccessor);
			$carmodelEntityObject->SetId($result['car']->getCarmodel_fid());
			if($carmodelEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['carmodel_fid']=$carmodelEntityObject;

            $carmakerEntityObject=new buysell_carmakerEntity($DBAccessor);
            $carmakerEntityObject->SetId($result['carmodel_fid']->getCarmaker_fid());
            if($carmakerEntityObject->getId()==-1)
                throw new DataNotFoundException();
            $result['carmaker_fid']=$carmakerEntityObject;

            $carmakerEntityObject=new buysell_carmakerEntity($DBAccessor);
            $carmakerEntityObject->SetId($result['carmodel_fid']->getCarmaker_fid());
            if($carmakerEntityObject->getId()==-1)
                throw new DataNotFoundException();
            $result['carmaker_fid']=$carmakerEntityObject;

            $userID=$result['car']->getRole_systemuser_fid();
            $UE=new buysell_userEntity($DBAccessor);
            $uq=new QueryLogic();
            $uq->addCondition(new FieldCondition("role_systemuser_fid",$userID));
            $userinf=$UE->FindOne($uq);
            $result['user']=$userinf;
            $cityID=$userinf->getCommon_city_fid();
            $CSE=new common_cityEntity($DBAccessor);
            $CSE->setId($cityID);
            $result['city']=$CSE;

			$cartagtypeEntityObject=new buysell_cartagtypeEntity($DBAccessor);
			$cartagtypeEntityObject->SetId($result['car']->getCartagtype_fid());
			if($cartagtypeEntityObject->getId()==-1)
				throw new DataNotFoundException();

			$result['cartagtype_fid']=$cartagtypeEntityObject;
			$carentitytypeEntityObject=new buysell_carentitytypeEntity($DBAccessor);
			$carentitytypeEntityObject->SetId($result['car']->getCarentitytype_fid());
			if($carentitytypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['carentitytype_fid']=$carentitytypeEntityObject;

			$CarPEnt=new buysell_carphotoEntity($DBAccessor);
			$q=new QueryLogic();
			$q->addCondition(new FieldCondition(buysell_carphotoEntity::$CAR_FID,$ID));
			$q->setLimit("0,5");
            $result['photos']=$CarPEnt->FindAll($q);
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>