<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_servicerequestservicestatusEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-17 - 2017-12-08 09:41
*@lastUpdate 1396-09-17 - 2017-12-08 09:41
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicerequestservicestatusController extends Controller {
	private $adminMode=true;
    public function getAdminMode()
    {
        return $this->adminMode;
    }
        /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$servicerequestservicestatusEntityObject=new itsap_servicerequestservicestatusEntity($DBAccessor);
		$servicestatusEntityObject=new itsap_servicestatusEntity($DBAccessor);
		$result['servicestatus_fid']=$servicestatusEntityObject->FindAll(new QueryLogic());
		$servicerequestEntityObject=new itsap_servicerequestEntity($DBAccessor);
		$result['servicerequest_fid']=$servicerequestEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicerequestservicestatus_fid',$ID));
		$result['servicerequestservicestatus']=$servicerequestservicestatusEntityObject;
		if($ID!=-1){
			$servicerequestservicestatusEntityObject->setId($ID);
			if($servicerequestservicestatusEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $servicerequestservicestatusEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['servicerequestservicestatus']=$servicerequestservicestatusEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$servicestatus_fid,$servicerequest_fid,$start_date)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$servicerequestservicestatusEntityObject=new itsap_servicerequestservicestatusEntity($DBAccessor);
		$this->ValidateFieldArray([$servicestatus_fid,$servicerequest_fid,$start_date],[$servicerequestservicestatusEntityObject->getFieldInfo(itsap_servicerequestservicestatusEntity::$SERVICESTATUS_FID),$servicerequestservicestatusEntityObject->getFieldInfo(itsap_servicerequestservicestatusEntity::$SERVICEREQUEST_FID),$servicerequestservicestatusEntityObject->getFieldInfo(itsap_servicerequestservicestatusEntity::$START_DATE)]);
		if($ID==-1){
			$servicerequestservicestatusEntityObject->setServicestatus_fid($servicestatus_fid);
			$servicerequestservicestatusEntityObject->setServicerequest_fid($servicerequest_fid);
			$servicerequestservicestatusEntityObject->setStart_date($start_date);
			$servicerequestservicestatusEntityObject->Save();
			$ID=$servicerequestservicestatusEntityObject->getId();
		}
		else{
			$servicerequestservicestatusEntityObject->setId($ID);
			if($servicerequestservicestatusEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $servicerequestservicestatusEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$servicerequestservicestatusEntityObject->setServicestatus_fid($servicestatus_fid);
			$servicerequestservicestatusEntityObject->setServicerequest_fid($servicerequest_fid);
			$servicerequestservicestatusEntityObject->setStart_date($start_date);
			$servicerequestservicestatusEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicerequestservicestatus_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>