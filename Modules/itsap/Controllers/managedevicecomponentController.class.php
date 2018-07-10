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
use Modules\itsap\Entity\itsap_devicecomponentEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-13 - 2018-04-02 02:09
*@lastUpdate 1397-01-13 - 2018-04-02 02:09
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedevicecomponentController extends Controller {
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
		$devicecomponentEntityObject=new itsap_devicecomponentEntity($DBAccessor);
		$devicetypeEntityObject=new itsap_devicetypeEntity($DBAccessor);
		$result['devicetype_fid']=$devicetypeEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('devicecomponent_fid',$ID));
		$result['devicecomponent']=$devicecomponentEntityObject;
		if($ID!=-1){
			$devicecomponentEntityObject->setId($ID);
			if($devicecomponentEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $devicecomponentEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['devicecomponent']=$devicecomponentEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$devicetype_fid,$title)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$devicecomponentEntityObject=new itsap_devicecomponentEntity($DBAccessor);
		$this->ValidateFieldArray([$devicetype_fid,$title],[$devicecomponentEntityObject->getFieldInfo(itsap_devicecomponentEntity::$DEVICETYPE_FID),$devicecomponentEntityObject->getFieldInfo(itsap_devicecomponentEntity::$TITLE)]);
		if($ID==-1){
			$devicecomponentEntityObject->setDevicetype_fid($devicetype_fid);
			$devicecomponentEntityObject->setTitle($title);
			$devicecomponentEntityObject->Save();
			$ID=$devicecomponentEntityObject->getId();
		}
		else{
			$devicecomponentEntityObject->setId($ID);
			if($devicecomponentEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $devicecomponentEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$devicecomponentEntityObject->setDevicetype_fid($devicetype_fid);
			$devicecomponentEntityObject->setTitle($title);
			$devicecomponentEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('devicecomponent_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>