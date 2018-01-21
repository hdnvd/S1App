<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_employeeEntity;
use Modules\itsap\Entity\itsap_referenceEntity;
use Modules\itsap\Entity\itsap_servicerequestservicestatusEntity;
use Modules\itsap\Entity\itsap_servicestatusEntity;
use Modules\itsap\Entity\itsap_servicetypeEntity;
use Modules\itsap\Entity\itsap_topunitEntity;
use Modules\itsap\Entity\itsap_unitEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_servicerequestEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-29 - 2017-12-20 15:49
*@lastUpdate 1396-09-29 - 2017-12-20 15:49
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
			$States=new itsap_servicestatusEntity($DBAccessor);
            $result['allstatus']=$States->FindAll(new QueryLogic());

            $CurrentStatus=new itsap_servicerequestservicestatusEntity($DBAccessor);
            $q=new QueryLogic();
            $q->addCondition(new FieldCondition(itsap_servicerequestservicestatusEntity::$SERVICEREQUEST_FID,$ID));
            $q->addOrderBy(itsap_servicerequestservicestatusEntity::$START_DATE,true);
            $CurrentStatus=$CurrentStatus->FindOne($q);
            $result['currentstatusinfo']=$CurrentStatus;

		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
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