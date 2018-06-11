<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_servicetypegroupEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_servicetypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-13 - 2018-04-02 02:04
*@lastUpdate 1397-01-13 - 2018-04-02 02:04
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicetypeController extends Controller {
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
		$servicetypeEntityObject=new itsap_servicetypeEntity($DBAccessor);
		$servicetypegroupEntityObject=new itsap_servicetypegroupEntity($DBAccessor);
		$result['servicetypegroup_fid']=$servicetypegroupEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicetype_fid',$ID));
		$result['servicetype']=$servicetypeEntityObject;
		if($ID!=-1){
			$servicetypeEntityObject->setId($ID);
			if($servicetypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $servicetypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['servicetype']=$servicetypeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$priority,$servicetypegroup_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$servicetypeEntityObject=new itsap_servicetypeEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$priority,$servicetypegroup_fid],[$servicetypeEntityObject->getFieldInfo(itsap_servicetypeEntity::$TITLE),$servicetypeEntityObject->getFieldInfo(itsap_servicetypeEntity::$PRIORITY),$servicetypeEntityObject->getFieldInfo(itsap_servicetypeEntity::$SERVICETYPEGROUP_FID)]);
		if($ID==-1){
			$servicetypeEntityObject->setTitle($title);
			$servicetypeEntityObject->setPriority($priority);
			$servicetypeEntityObject->setServicetypegroup_fid($servicetypegroup_fid);
			$servicetypeEntityObject->Save();
			$ID=$servicetypeEntityObject->getId();
		}
		else{
			$servicetypeEntityObject->setId($ID);
			if($servicetypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $servicetypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$servicetypeEntityObject->setTitle($title);
			$servicetypeEntityObject->setPriority($priority);
			$servicetypeEntityObject->setServicetypegroup_fid($servicetypegroup_fid);
			$servicetypeEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicetype_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>