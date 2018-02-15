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
use Modules\users\Entity\users_menuitemEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-20 - 2018-02-09 00:17
*@lastUpdate 1396-11-20 - 2018-02-09 00:17
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managemenuitemController extends Controller {
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
		$menuitemEntityObject=new users_menuitemEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('menuitem_fid',$ID));
		$result['menuitem']=$menuitemEntityObject;
		if($ID!=-1){
			$menuitemEntityObject->setId($ID);
			if($menuitemEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $menuitemEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['menuitem']=$menuitemEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$latintitle,$module,$page,$parameters)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$menuitemEntityObject=new users_menuitemEntity($DBAccessor);
		$this->ValidateFieldArray([$latintitle,$module,$page,$parameters],[$menuitemEntityObject->getFieldInfo(users_menuitemEntity::$LATINTITLE),$menuitemEntityObject->getFieldInfo(users_menuitemEntity::$MODULE),$menuitemEntityObject->getFieldInfo(users_menuitemEntity::$PAGE),$menuitemEntityObject->getFieldInfo(users_menuitemEntity::$PARAMETERS)]);
		if($ID==-1){
			$menuitemEntityObject->setLatintitle($latintitle);
			$menuitemEntityObject->setModule($module);
			$menuitemEntityObject->setPage($page);
			$menuitemEntityObject->setParameters($parameters);
			$menuitemEntityObject->Save();
			$ID=$menuitemEntityObject->getId();
		}
		else{
			$menuitemEntityObject->setId($ID);
			if($menuitemEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $menuitemEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$menuitemEntityObject->setLatintitle($latintitle);
			$menuitemEntityObject->setModule($module);
			$menuitemEntityObject->setPage($page);
			$menuitemEntityObject->setParameters($parameters);
			$menuitemEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('menuitem_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>