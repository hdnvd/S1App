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
use Modules\iribfinance\Entity\iribfinance_bankEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:18
*@lastUpdate 1396-11-05 - 2018-01-25 18:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managebankController extends Controller {
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
		$bankEntityObject=new iribfinance_bankEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('bank_fid',$ID));
		$result['bank']=$bankEntityObject;
		if($ID!=-1){
			$bankEntityObject->setId($ID);
			if($bankEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $bankEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['bank']=$bankEntityObject;
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
		$bankEntityObject=new iribfinance_bankEntity($DBAccessor);
		$this->ValidateFieldArray([$title],[$bankEntityObject->getFieldInfo(iribfinance_bankEntity::$TITLE)]);
		if($ID==-1){
			$bankEntityObject->setTitle($title);
			$bankEntityObject->Save();
			$ID=$bankEntityObject->getId();
		}
		else{
			$bankEntityObject->setId($ID);
			if($bankEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $bankEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$bankEntityObject->setTitle($title);
			$bankEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('bank_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>