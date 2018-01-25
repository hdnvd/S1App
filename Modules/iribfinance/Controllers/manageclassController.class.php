<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_classEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 19:02
*@lastUpdate 1396-11-05 - 2018-01-25 19:02
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageclassController extends Controller {
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
		$classEntityObject=new iribfinance_classEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('class_fid',$ID));
		$result['class']=$classEntityObject;
		if($ID!=-1){
			$classEntityObject->setId($ID);
			if($classEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $classEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['class']=$classEntityObject;
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
		$classEntityObject=new iribfinance_classEntity($DBAccessor);
		$this->ValidateFieldArray([$title],[$classEntityObject->getFieldInfo(iribfinance_classEntity::$TITLE)]);
		if($ID==-1){
			$classEntityObject->setTitle($title);
			$classEntityObject->Save();
			$ID=$classEntityObject->getId();
		}
		else{
			$classEntityObject->setId($ID);
			if($classEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $classEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$classEntityObject->setTitle($title);
			$classEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('class_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>