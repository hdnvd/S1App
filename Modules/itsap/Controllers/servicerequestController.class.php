<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_degreeEntity;
use Modules\itsap\Entity\itsap_devicetypeEntity;
use Modules\itsap\Entity\itsap_employeeEntity;
use Modules\itsap\Entity\itsap_referenceEntity;
use Modules\itsap\Entity\itsap_servicerequestdeviceEntity;
use Modules\itsap\Entity\itsap_servicerequestservicestatusEntity;
use Modules\itsap\Entity\itsap_servicestatusEntity;
use Modules\itsap\Entity\itsap_servicetypeEntity;
use Modules\itsap\Entity\itsap_topunitEntity;
use Modules\itsap\Entity\itsap_unitEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Entity\roleSystemUserEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_servicerequestEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-15 - 2018-04-04 20:22
*@lastUpdate 1397-01-15 - 2018-04-04 20:22
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class servicerequestController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$servicerequestEntityObject=new itsap_servicerequestEntity($DBAccessor);
		$result['servicerequest']=$servicerequestEntityObject;
        $itsap_topunitEntityObject=new itsap_topunitEntity($DBAccessor);
        $result['topunits']=$itsap_topunitEntityObject->FindAll(new QueryLogic());

        $currentEmployee=new itsap_employeeEntity($DBAccessor);
        $empQL=new QueryLogic();
        $empQL->addCondition(new FieldCondition(itsap_employeeEntity::$ROLE_SYSTEMUSER_FID,$role_systemuser_fid));
        $currentEmployee=$currentEmployee->FindOne($empQL);
        if($currentEmployee->getId()<=0)
            throw new DataNotFoundException();
        $currentUnitID=$currentEmployee->getUnit_fid();
        $currentUnit=new itsap_unitEntity($DBAccessor);
        $currentUnit->setId($currentUnitID);
        if($currentUnit->getId()<=0)
            throw new DataNotFoundException();

        $UnitEmpsQL=new QueryLogic();
        $UnitEmpsQL->addCondition(new FieldCondition(itsap_employeeEntity::$UNIT_FID,$currentUnitID));
        $result['unitemployees']=$currentEmployee->FindAll($UnitEmpsQL);
		if($ID!=-1){
			$servicerequestEntityObject->setId($ID);
			if($servicerequestEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['servicerequest']=$servicerequestEntityObject;
			$servicetypeEntityObject=new itsap_servicetypeEntity($DBAccessor);
			$servicetypeEntityObject->SetId($result['servicerequest']->getServicetype_fid());
			if($servicetypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['servicetype_fid']=$servicetypeEntityObject;
			$devicetypeEntityObject=new itsap_devicetypeEntity($DBAccessor);
			$devicetypeEntityObject->SetId($result['servicerequest']->getDevicetype_fid());
//			if($devicetypeEntityObject->getId()==-1)
//				throw new DataNotFoundException();
			$result['devicetype_fid']=$devicetypeEntityObject;

            $DeviceesObject=new itsap_servicerequestdeviceEntity($DBAccessor);
            $q=new QueryLogic();
            $q->addCondition(new FieldCondition(itsap_servicerequestservicestatusEntity::$SERVICEREQUEST_FID,$ID));
            $result['devices']=$DeviceesObject->FindAll($q);
            for($devIndex=0;$result['devices']!="" && $devIndex<count($result['devices']);$devIndex++)
            {
                $devType=new itsap_devicetypeEntity($DBAccessor);
                $devType->setId($result['devices'][$devIndex]->getDevicetype_fid());
                $result['devicetypes'][$devIndex]=$devType;
            }

            $States=new itsap_servicestatusEntity($DBAccessor);
            $result['allstatus']=$States->FindAll(new QueryLogic());
            $StatusesObject=new itsap_servicerequestservicestatusEntity($DBAccessor);
            $q=new QueryLogic();
            $q->addCondition(new FieldCondition(itsap_servicerequestservicestatusEntity::$SERVICEREQUEST_FID,$ID));
            $q->addOrderBy(itsap_servicerequestservicestatusEntity::$START_DATE,true);
            $CurrentStatus=$StatusesObject->FindOne($q);
            $result['currentstatusinfo']=$CurrentStatus;

            $q=new QueryLogic();
            $q->addCondition(new FieldCondition(itsap_servicerequestservicestatusEntity::$SERVICEREQUEST_FID,$ID));
            $q->addOrderBy(itsap_servicerequestservicestatusEntity::$START_DATE,false);
            $AllStatus=$StatusesObject->FindAll($q);
//            print_r($AllStatus);
            $result['allstatuses']=$AllStatus;
            for($stat=0;$stat<count($AllStatus);$stat++)
            {
                $statusInfo=new itsap_servicestatusEntity($DBAccessor);
                $statusInfo->setId($result['allstatuses'][$stat]->getServicestatus_fid());
                $result['allstatusesinfo'][$stat]=$statusInfo;
                $TheEmp=new itsap_employeeEntity($DBAccessor);
                $TheQEmp1=new QueryLogic();
                $TheQEmp1->addCondition(new FieldCondition(itsap_employeeEntity::$ROLE_SYSTEMUSER_FID,$result['allstatuses'][$stat]->getRole_systemuser_fid()));
                $result['allstatusesemployee'][$stat]=$TheEmp->FindOne($TheQEmp1);
            }

            $emp=new itsap_employeeEntity($DBAccessor);
            $qEmp1=new QueryLogic();
            $qEmp1->addCondition(new FieldCondition(itsap_employeeEntity::$ROLE_SYSTEMUSER_FID,$servicerequestEntityObject->getRole_systemuser_fid()));
            $result['requesteremployee']=$emp->FindOne($qEmp1);

        }
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
    public function ChangePriority($ID,$Priority)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $result=array();
        $servicerequestEntityObject=new itsap_servicerequestEntity($DBAccessor);
        $result['servicerequest']=$servicerequestEntityObject;
        if($ID!=-1){
            $servicerequestEntityObject->setId($ID);
            if($servicerequestEntityObject->getId()==-1)
                throw new DataNotFoundException();
            $servicerequestEntityObject->setPriority($Priority);
            $servicerequestEntityObject->Save();
        }
        $result['param1']="";
        $DBAccessor->close_connection();
        return $this->load($ID);
    }
    public function ChangeState($ID,$StateID,$message)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $result=array();
        $servicerequestEntityObject=new itsap_servicerequestEntity($DBAccessor);
        $result['servicerequest']=$servicerequestEntityObject;
        if($ID!=-1){
            $servicerequestEntityObject->setId($ID);
            if($servicerequestEntityObject->getId()==-1)
                throw new DataNotFoundException();
            $statusEnt=new itsap_servicestatusEntity($DBAccessor);
            $statusEnt->setId($StateID);
            if($statusEnt->getId()==-1)
                throw new DataNotFoundException();

            $reqstatusEnt=new itsap_servicerequestservicestatusEntity($DBAccessor);
            $q=new QueryLogic();
            $q->addCondition(new FieldCondition(itsap_servicerequestservicestatusEntity::$SERVICEREQUEST_FID,$ID));
            $q->addOrderBy(itsap_servicerequestservicestatusEntity::$START_DATE,true);
            $reqstatusEnt=$reqstatusEnt->FindOne($q);
            $LastStatus=$reqstatusEnt->getServicestatus_fid();
            if($LastStatus!=$StateID)
            {
                $reqstatusEnt=new itsap_servicerequestservicestatusEntity($DBAccessor);
                $reqstatusEnt->setStart_date(time());
                $reqstatusEnt->setRole_systemuser_fid($role_systemuser_fid);
                $reqstatusEnt->setServicerequest_fid($ID);
                $reqstatusEnt->setServicestatus_fid($StateID);
                $reqstatusEnt->setMessage($message);
                $reqstatusEnt->Save();
            }
        }
        $result['param1']="";
        $DBAccessor->close_connection();
        return $this->load($ID);
    }
    private function addReference($ID,$ITunitID,$EmployeeID,$Message)
    {
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $result=array();
        $servicerequestEntityObject=new itsap_servicerequestEntity($DBAccessor);
        $result['servicerequest']=$servicerequestEntityObject;
        if($ID!=-1){
            $servicerequestEntityObject->setId($ID);
            if($servicerequestEntityObject->getId()==-1)
                throw new DataNotFoundException();

            $ReferenceEnt=new itsap_referenceEntity($DBAccessor);
            $ReferenceEnt->setReference_time(time());
            $ReferenceEnt->setServicerequest_fid($ID);
            $ReferenceEnt->setMessage($Message);
            $ReferenceEnt->setSystemuser_fid($role_systemuser_fid);
            $ReferenceEnt->setEmployee_fid($EmployeeID);
            $ReferenceEnt->setUnit_fid($ITunitID);
            $ReferenceEnt->Save();

        }
        $result['param1']="";
        $DBAccessor->close_connection();
        return $this->load($ID);
    }
    public function Refer($ID,$TopUnitID,$Message)
    {
        $DBAccessor=new dbaccess();
        $unitEnt=new itsap_unitEntity($DBAccessor);
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition(itsap_unitEntity::$TOPUNIT_FID,$TopUnitID));
        $q->addCondition(new FieldCondition(itsap_unitEntity::$ISFAVA,1));
        $unitEnt=$unitEnt->FindOne($q);
        if($unitEnt==null || $unitEnt->getId()<=0)
            throw new DataNotFoundException();
        $ITunitID=$unitEnt->getId();
        $DBAccessor->close_connection();
        return $this->addReference($ID,$ITunitID,-1,$Message);
    }

    public function Assign($ID,$EmployeeID,$Message)
    {
        return $this->addReference($ID,-1,$EmployeeID,$Message);
    }
}
?>