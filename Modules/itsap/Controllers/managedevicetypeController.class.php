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
use Modules\itsap\Entity\itsap_devicetypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-13 - 2018-04-02 02:07
*@lastUpdate 1397-01-13 - 2018-04-02 02:07
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedevicetypeController extends Controller {
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
		$devicetypeEntityObject=new itsap_devicetypeEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('devicetype_fid',$ID));
		$result['devicetype']=$devicetypeEntityObject;
		if($ID!=-1){
			$devicetypeEntityObject->setId($ID);
			if($devicetypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $devicetypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['devicetype']=$devicetypeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$devicetypeEntityObject=new itsap_devicetypeEntity($DBAccessor);
		$this->ValidateFieldArray([$title],[$devicetypeEntityObject->getFieldInfo(itsap_devicetypeEntity::$TITLE)]);
		if($ID==-1){
			$devicetypeEntityObject->setTitle($title);
			$devicetypeEntityObject->Save();
			$ID=$devicetypeEntityObject->getId();
		}
		else{
			$devicetypeEntityObject->setId($ID);
			if($devicetypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $devicetypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$devicetypeEntityObject->setTitle($title);
			$devicetypeEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('devicetype_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>