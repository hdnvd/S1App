<?php
namespace Modules\onlineclass\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\onlineclass\Entity\onlineclass_levelEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 15:53
*@lastUpdate 1396-07-25 - 2017-10-17 15:53
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managelevelController extends Controller {
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
		$levelEntityObject=new onlineclass_levelEntity($DBAccessor);
		$result['level']=$levelEntityObject;
		if($ID!=-1){
			$levelEntityObject->setId($ID);
			if($levelEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $levelEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['level']=$levelEntityObject;
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
		$levelEntityObject=new onlineclass_levelEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$priority],[$levelEntityObject->getFieldInfo(onlineclass_levelEntity::$TITLE),$levelEntityObject->getFieldInfo(onlineclass_levelEntity::$PRIORITY)]);
		if($ID==-1){
			$levelEntityObject->setTitle($title);
			$levelEntityObject->setPriority($priority);
			$levelEntityObject->Save();
		}
		else{
			$levelEntityObject->setId($ID);
			if($levelEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $levelEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$levelEntityObject->setTitle($title);
			$levelEntityObject->setPriority($priority);
			$levelEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>