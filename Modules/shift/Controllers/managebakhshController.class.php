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
use Modules\shift\Entity\shift_bakhshEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-26 - 2018-01-16 19:13
*@lastUpdate 1396-10-26 - 2018-01-16 19:13
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managebakhshController extends Controller {
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
		$bakhshEntityObject=new shift_bakhshEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('bakhsh_fid',$ID));
		$result['bakhsh']=$bakhshEntityObject;
		if($ID!=-1){
			$bakhshEntityObject->setId($ID);
			if($bakhshEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $bakhshEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['bakhsh']=$bakhshEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$sakhtikar)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$bakhshEntityObject=new shift_bakhshEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$sakhtikar],[$bakhshEntityObject->getFieldInfo(shift_bakhshEntity::$TITLE),$bakhshEntityObject->getFieldInfo(shift_bakhshEntity::$SAKHTIKAR)]);
		if($ID==-1){
			$bakhshEntityObject->setTitle($title);
			$bakhshEntityObject->setSakhtikar($sakhtikar);
			$bakhshEntityObject->Save();
			$ID=$bakhshEntityObject->getId();
		}
		else{
			$bakhshEntityObject->setId($ID);
			if($bakhshEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $bakhshEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$bakhshEntityObject->setTitle($title);
			$bakhshEntityObject->setSakhtikar($sakhtikar);
			$bakhshEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('bakhsh_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>