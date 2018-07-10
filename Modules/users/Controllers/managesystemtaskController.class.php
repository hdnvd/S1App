<?php
namespace Modules\users\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\users\Entity\users_systemtaskEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-24 - 2018-02-13 22:37
*@lastUpdate 1396-11-24 - 2018-02-13 22:37
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managesystemtaskController extends Controller {
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
		$systemtaskEntityObject=new users_systemtaskEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('systemtask_fid',$ID));
		$result['systemtask']=$systemtaskEntityObject;
		if($ID!=-1){
			$systemtaskEntityObject->setId($ID);
			if($systemtaskEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $systemtaskEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['systemtask']=$systemtaskEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$module,$page,$action)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$systemtaskEntityObject=new users_systemtaskEntity($DBAccessor);
		$this->ValidateFieldArray([$module,$page,$action],[$systemtaskEntityObject->getFieldInfo(users_systemtaskEntity::$MODULE),$systemtaskEntityObject->getFieldInfo(users_systemtaskEntity::$PAGE),$systemtaskEntityObject->getFieldInfo(users_systemtaskEntity::$ACTION)]);
		if($ID==-1){
			$systemtaskEntityObject->setModule($module);
			$systemtaskEntityObject->setPage($page);
			$systemtaskEntityObject->setAction($action);
			$systemtaskEntityObject->Save();
			$ID=$systemtaskEntityObject->getId();
		}
		else{
			$systemtaskEntityObject->setId($ID);
			if($systemtaskEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $systemtaskEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$systemtaskEntityObject->setModule($module);
			$systemtaskEntityObject->setPage($page);
			$systemtaskEntityObject->setAction($action);
			$systemtaskEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('systemtask_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>