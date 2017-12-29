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
use Modules\itsap\Entity\itsap_degreeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-17 - 2017-12-08 09:41
*@lastUpdate 1396-09-17 - 2017-12-08 09:41
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedegreeController extends Controller {
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
		$degreeEntityObject=new itsap_degreeEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('degree_fid',$ID));
		$result['degree']=$degreeEntityObject;
		if($ID!=-1){
			$degreeEntityObject->setId($ID);
			if($degreeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $degreeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['degree']=$degreeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$priority)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$degreeEntityObject=new itsap_degreeEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$priority],[$degreeEntityObject->getFieldInfo(itsap_degreeEntity::$TITLE),$degreeEntityObject->getFieldInfo(itsap_degreeEntity::$PRIORITY)]);
		if($ID==-1){
			$degreeEntityObject->setTitle($title);
			$degreeEntityObject->setPriority($priority);
			$degreeEntityObject->Save();
			$ID=$degreeEntityObject->getId();
		}
		else{
			$degreeEntityObject->setId($ID);
			if($degreeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $degreeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$degreeEntityObject->setTitle($title);
			$degreeEntityObject->setPriority($priority);
			$degreeEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('degree_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>