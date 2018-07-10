<?php
namespace Modules\oras\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\oras\Entity\oras_roleEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 03:02
*@lastUpdate 1396-07-12 - 2017-10-04 03:02
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
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
		$roleEntityObject=new oras_roleEntity($DBAccessor);
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
		$roleEntityObject=new oras_roleEntity($DBAccessor);
		$this->ValidateFieldArray([$title],[$roleEntityObject->getFieldInfo(oras_roleEntity::$TITLE)]);
		if($ID==-1){
			$roleEntityObject->setTitle($title);
			$roleEntityObject->Save();
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
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>