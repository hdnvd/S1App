<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_servicerequestservicestatusEntity;
use Modules\itsap\Entity\itsap_servicestatusEntity;
use Modules\itsap\Entity\itsap_servicetypeEntity;
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
    public function ChangeState($ID,$StateID)
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
                $reqstatusEnt->Save();
            }
        }
        $result['param1']="";
        $DBAccessor->close_connection();
        return $this->load($ID);
    }
}
?>