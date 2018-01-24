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
use Modules\shift\Entity\shift_eshteghalEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-26 - 2018-01-16 20:22
*@lastUpdate 1396-10-26 - 2018-01-16 20:22
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageeshteghalController extends Controller {
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
		$eshteghalEntityObject=new shift_eshteghalEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('eshteghal_fid',$ID));
		$result['eshteghal']=$eshteghalEntityObject;
		if($ID!=-1){
			$eshteghalEntityObject->setId($ID);
			if($eshteghalEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $eshteghalEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['eshteghal']=$eshteghalEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$nameeshteghal)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$eshteghalEntityObject=new shift_eshteghalEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$nameeshteghal],[$eshteghalEntityObject->getFieldInfo(shift_eshteghalEntity::$TITLE),$eshteghalEntityObject->getFieldInfo(shift_eshteghalEntity::$NAMEESHTEGHAL)]);
		if($ID==-1){
			$eshteghalEntityObject->setTitle($title);
			$eshteghalEntityObject->setNameeshteghal($nameeshteghal);
			$eshteghalEntityObject->Save();
			$ID=$eshteghalEntityObject->getId();
		}
		else{
			$eshteghalEntityObject->setId($ID);
			if($eshteghalEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $eshteghalEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$eshteghalEntityObject->setTitle($title);
			$eshteghalEntityObject->setNameeshteghal($nameeshteghal);
			$eshteghalEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('eshteghal_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>