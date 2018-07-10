<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\common\Entity\common_cityEntity;
use Modules\finance\Exceptions\LowBalanceException;
use Modules\finance\PublicClasses\Payment;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\ocms\Entity\ocms_doctorplanEntity;
use Modules\ocms\Entity\ocms_doctorreserveEntity;
use Modules\ocms\Entity\ocms_specialityEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_doctorEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-08 - 2017-12-29 12:54
*@lastUpdate 1396-10-08 - 2017-12-29 12:54
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class doctorController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$doctorEntityObject=new ocms_doctorEntity($DBAccessor);
		$result['doctor']=$doctorEntityObject;
		if($ID!=-1){
			$doctorEntityObject->setId($ID);
			if($doctorEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['doctor']=$doctorEntityObject;
			$specialityEntityObject=new ocms_specialityEntity($DBAccessor);
			$specialityEntityObject->SetId($result['doctor']->getSpeciality_fid());
			if($specialityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['speciality_fid']=$specialityEntityObject;
//			$common_cityEntityObject=new common_cityEntity($DBAccessor);
//			$common_cityEntityObject->SetId($result['doctor']->getCommon_city_fid());
//			if($common_cityEntityObject->getId()==-1)
//				throw new DataNotFoundException();
			$DPEnt=new ocms_doctorplanEntity($DBAccessor);
//			$result['common_city_fid']=$common_cityEntityObject;
            $result['freeplans']=$DPEnt->getDoctorFreePlans($ID,null,null);
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}

    public function reserve($DoctorPlanID,$PresenceTypeID)
    {
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $ent=new ocms_doctorplanEntity($DBAccessor);
        $ent->setId($DoctorPlanID);
        if($ent->getId()<=0)
            throw new DataNotFoundException();
        $DrEnt=new ocms_doctorEntity($DBAccessor);
        $DrEnt->setId($ent->getDoctor_fid());
        if($DrEnt->getId()<=0)
            throw new DataNotFoundException();
        $Payment=new Payment();
        $UserBalance=$Payment->getBalance(1,$role_systemuser_fid);
//        echo $UserBalance;
        if($UserBalance<$DrEnt->getPrice())
            throw new LowBalanceException();
        $result=$Payment->startTransaction(-1*$DrEnt->getPrice(),$role_systemuser_fid,'','','','رزرو وقت',1,false,'',$role_systemuser_fid);
        $resEnt=new ocms_doctorreserveEntity($DBAccessor);
        $resEnt->setReserve_date(time());
        $resEnt->setDoctorplan_fid($DoctorPlanID);
        $resEnt->setPresencetype_fid($PresenceTypeID);
        $resEnt->setRole_systemuser_fid($role_systemuser_fid);
        $resEnt->setFinancial_transaction_fid($result['transaction']['id']);
        $resEnt->Save();
        return [];


    }
}
?>