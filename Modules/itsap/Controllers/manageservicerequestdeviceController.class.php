<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_devicetypeEntity;
use Modules\itsap\Entity\itsap_servicerequestEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_servicerequestdeviceEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-16 - 2018-04-05 00:53
*@lastUpdate 1397-01-16 - 2018-04-05 00:53
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicerequestdeviceController extends Controller {
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
	public function load($ID,$ServiceRequestID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$servicerequestdeviceEntityObject=new itsap_servicerequestdeviceEntity($DBAccessor);
		$devicetypeEntityObject=new itsap_devicetypeEntity($DBAccessor);
		$result['devicetype_fid']=$devicetypeEntityObject->FindAll(new QueryLogic());
		$servicerequestEntityObject=new itsap_servicerequestEntity($DBAccessor);
		$result['servicerequest_fid']=$servicerequestEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicerequestdevice_fid',$ID));
		$result['servicerequestdevice']=$servicerequestdeviceEntityObject;
		if($ID!=-1){
			$servicerequestdeviceEntityObject->setId($ID);
			if($servicerequestdeviceEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $servicerequestdeviceEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['servicerequestdevice']=$servicerequestdeviceEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$code,$devicetype_fid,$servicerequest_fid,$description)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$servicerequestdeviceEntityObject=new itsap_servicerequestdeviceEntity($DBAccessor);
		$this->ValidateFieldArray([$code,$devicetype_fid,$servicerequest_fid,$description],[$servicerequestdeviceEntityObject->getFieldInfo(itsap_servicerequestdeviceEntity::$CODE),$servicerequestdeviceEntityObject->getFieldInfo(itsap_servicerequestdeviceEntity::$DEVICETYPE_FID),$servicerequestdeviceEntityObject->getFieldInfo(itsap_servicerequestdeviceEntity::$SERVICEREQUEST_FID),$servicerequestdeviceEntityObject->getFieldInfo(itsap_servicerequestdeviceEntity::$DESCRIPTION)]);
		if($ID==-1){
			$servicerequestdeviceEntityObject->setCode($code);
			$servicerequestdeviceEntityObject->setDevicetype_fid($devicetype_fid);
			$servicerequestdeviceEntityObject->setServicerequest_fid($servicerequest_fid);
			$servicerequestdeviceEntityObject->setDescription($description);
			$servicerequestdeviceEntityObject->Save();
			$ID=$servicerequestdeviceEntityObject->getId();
		}
		else{
			$servicerequestdeviceEntityObject->setId($ID);
			if($servicerequestdeviceEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $servicerequestdeviceEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$servicerequestdeviceEntityObject->setCode($code);
			$servicerequestdeviceEntityObject->setDevicetype_fid($devicetype_fid);
			$servicerequestdeviceEntityObject->setServicerequest_fid($servicerequest_fid);
			$servicerequestdeviceEntityObject->setDescription($description);
			$servicerequestdeviceEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicerequestdevice_fid',$ID));
		$result=$this->load($ID,$servicerequest_fid);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>