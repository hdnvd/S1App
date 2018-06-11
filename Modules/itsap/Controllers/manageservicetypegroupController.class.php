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
use Modules\itsap\Entity\itsap_servicetypegroupEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-13 - 2018-04-02 01:58
*@lastUpdate 1397-01-13 - 2018-04-02 01:58
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicetypegroupController extends Controller {
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
		$servicetypegroupEntityObject=new itsap_servicetypegroupEntity($DBAccessor);
		$servicetypegroupEntityObject=new itsap_servicetypegroupEntity($DBAccessor);
		$result['servicetypegroup_fid']=$servicetypegroupEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicetypegroup_fid',$ID));
		$result['servicetypegroup']=$servicetypegroupEntityObject;
		if($ID!=-1){
			$servicetypegroupEntityObject->setId($ID);
			if($servicetypegroupEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $servicetypegroupEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['servicetypegroup']=$servicetypegroupEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$servicetypegroup_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$servicetypegroupEntityObject=new itsap_servicetypegroupEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$servicetypegroup_fid],[$servicetypegroupEntityObject->getFieldInfo(itsap_servicetypegroupEntity::$TITLE),$servicetypegroupEntityObject->getFieldInfo(itsap_servicetypegroupEntity::$SERVICETYPEGROUP_FID)]);
		if($ID==-1){
			$servicetypegroupEntityObject->setTitle($title);
			$servicetypegroupEntityObject->setServicetypegroup_fid($servicetypegroup_fid);
			$servicetypegroupEntityObject->Save();
			$ID=$servicetypegroupEntityObject->getId();
		}
		else{
			$servicetypegroupEntityObject->setId($ID);
			if($servicetypegroupEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $servicetypegroupEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$servicetypegroupEntityObject->setTitle($title);
			$servicetypegroupEntityObject->setServicetypegroup_fid($servicetypegroup_fid);
			$servicetypegroupEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicetypegroup_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>