<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_roleEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-27 - 2018-01-17 15:45
*@lastUpdate 1396-10-27 - 2018-01-17 15:45
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageroleController extends Controller {
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
		$roleEntityObject=new shift_roleEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('role_fid',$ID));
		$result['role']=$roleEntityObject;
		if($ID!=-1){
			$roleEntityObject->setId($ID);
			if($roleEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $roleEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['role']=$roleEntityObject;
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
		$roleEntityObject=new shift_roleEntity($DBAccessor);
		$this->ValidateFieldArray([$title],[$roleEntityObject->getFieldInfo(shift_roleEntity::$TITLE)]);
		if($ID==-1){
			$roleEntityObject->setTitle($title);
			$roleEntityObject->Save();
			$ID=$roleEntityObject->getId();
		}
		else{
			$roleEntityObject->setId($ID);
			if($roleEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $roleEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$roleEntityObject->setTitle($title);
			$roleEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('role_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>