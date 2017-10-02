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
use Modules\users\Entity\role_menuitemEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-09 - 2017-10-01 01:08
*@lastUpdate 1396-07-09 - 2017-10-01 01:08
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managemenuitemController extends Controller {    
private $adminMode=true;

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
        if(!$this->adminMode)
            $UserID=$role_systemuser_fid;
		$result=array();
		$menuitemEntityObject=new role_menuitemEntity($DBAccessor);
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
        if(!$this->adminMode)
            $UserID=$role_systemuser_fid;
		$result=array();
		$menuitemEntityObject=new role_menuitemEntity($DBAccessor);
		$this->ValidateFieldArray([$latintitle,$module,$page,$parameters],[$menuitemEntityObject->getFieldInfo(role_menuitemEntity::$LATINTITLE),$menuitemEntityObject->getFieldInfo(role_menuitemEntity::$MODULE),$menuitemEntityObject->getFieldInfo(role_menuitemEntity::$PAGE),$menuitemEntityObject->getFieldInfo(role_menuitemEntity::$PARAMETERS)]);
		if($ID==-1){
			$menuitemEntityObject->setLatintitle($latintitle);
			$menuitemEntityObject->setModule($module);
			$menuitemEntityObject->setPage($page);
			$menuitemEntityObject->setParameters($parameters);
			$menuitemEntityObject->Save();
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
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>