<?php
namespace Modules\users\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Entity\sfman_moduleEntity;
use Modules\users\Entity\users_systemroletaskEntity;
use Modules\users\Entity\users_systemtaskEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\users\Entity\users_systemroleEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-19 - 2018-02-08 15:47
*@lastUpdate 1396-11-19 - 2018-02-08 15:47
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managesystemroleController extends Controller {
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
		$systemroleEntityObject=new users_systemroleEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('systemrole_fid',$ID));
		$SystemtaskListEntityObject=new users_systemtaskEntity($DBAccessor);
        $moduleEnt=new sfman_moduleEntity($DBAccessor);
        $EnabledModules=$moduleEnt->FindAll(new QueryLogic([new FieldCondition("isenabled","1")]));
        $AllCount1 = count($EnabledModules);
        for ($i = 0; $i < $AllCount1; $i++) {
            $EnabledModuleIDs[$i]=$EnabledModules[$i]->getName();
        }
		$result['systemtasks']=$SystemtaskListEntityObject->FindAll(new QueryLogic([new FieldCondition(users_systemtaskEntity::$MODULE,$EnabledModuleIDs,LogicalOperator::IN)],[users_systemtaskEntity::$MODULE],[false]));
		$result['systemrole']=$systemroleEntityObject;
		if($ID!=-1){
			$systemroleEntityObject->setId($ID);
			if($systemroleEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $systemroleEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$users_systemrolesystemtaskEntityEntityObject=new users_systemroletaskEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('systemrole_fid',$ID));
			$result['systemrolesystemtasks']=$users_systemrolesystemtaskEntityEntityObject->FindAll($RelationLogic);
			$result['systemrole']=$systemroleEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$defaultmodule,$defaultpage,$indexparameters,$Systemtasks)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$systemroleEntityObject=new users_systemroleEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$defaultmodule,$defaultpage,$indexparameters],[$systemroleEntityObject->getFieldInfo(users_systemroleEntity::$TITLE),$systemroleEntityObject->getFieldInfo(users_systemroleEntity::$DEFAULTMODULE),$systemroleEntityObject->getFieldInfo(users_systemroleEntity::$DEFAULTPAGE),$systemroleEntityObject->getFieldInfo(users_systemroleEntity::$INDEXPARAMETERS)]);
		if($ID==-1){
			$systemroleEntityObject->setTitle($title);
			$systemroleEntityObject->setDefaultmodule($defaultmodule);
			$systemroleEntityObject->setDefaultpage($defaultpage);
			$systemroleEntityObject->setIndexparameters($indexparameters);
			$systemroleEntityObject->Save();
			$ID=$systemroleEntityObject->getId();
		}
		else{
			$systemroleEntityObject->setId($ID);
			if($systemroleEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $systemroleEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$systemroleEntityObject->setTitle($title);
			$systemroleEntityObject->setDefaultmodule($defaultmodule);
			$systemroleEntityObject->setDefaultpage($defaultpage);
			$systemroleEntityObject->setIndexparameters($indexparameters);
			$systemroleEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('systemrole_fid',$ID));
		$users_systemrolesystemtaskEntityObject=new users_systemroletaskEntity($DBAccessor);
		$CurrentSystemtasks=$users_systemrolesystemtaskEntityObject->FindAll($RelationLogic);
		$CurrentSystemtasksCount = count($CurrentSystemtasks);
		for ($i = 0; $i < $CurrentSystemtasksCount; $i++) {
			if(array_search($CurrentSystemtasks[$i]->getId(),$CurrentSystemtasks)===FALSE)
				$CurrentSystemtasks[$i]->Remove();
			else
			{
				unset($CurrentSystemtasks[$i]);
				$CurrentSystemtasks=array_values($CurrentSystemtasks);
			}
		}
		$SystemtasksCount = count($Systemtasks);
		for ($i = 0; $i < $SystemtasksCount; $i++) {
			$users_systemrolesystemtaskEntityObject=new users_systemroletaskEntity($DBAccessor);
			$users_systemrolesystemtaskEntityObject->setSystemrole_fid($ID);
			$users_systemrolesystemtaskEntityObject->setSystemtask_fid($Systemtasks[$i]);
			$users_systemrolesystemtaskEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>