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
use Modules\iribfinance\Entity\iribfinance_paycenterEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managepaycenterController extends Controller {
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
		$paycenterEntityObject=new iribfinance_paycenterEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('paycenter_fid',$ID));
		$result['paycenter']=$paycenterEntityObject;
		if($ID!=-1){
			$paycenterEntityObject->setId($ID);
			if($paycenterEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $paycenterEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['paycenter']=$paycenterEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$chapter,$accountingcode)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$paycenterEntityObject=new iribfinance_paycenterEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$chapter,$accountingcode],[$paycenterEntityObject->getFieldInfo(iribfinance_paycenterEntity::$TITLE),$paycenterEntityObject->getFieldInfo(iribfinance_paycenterEntity::$CHAPTER),$paycenterEntityObject->getFieldInfo(iribfinance_paycenterEntity::$ACCOUNTINGCODE)]);
		if($ID==-1){
			$paycenterEntityObject->setTitle($title);
			$paycenterEntityObject->setChapter($chapter);
			$paycenterEntityObject->setAccountingcode($accountingcode);
			$paycenterEntityObject->Save();
			$ID=$paycenterEntityObject->getId();
		}
		else{
			$paycenterEntityObject->setId($ID);
			if($paycenterEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $paycenterEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$paycenterEntityObject->setTitle($title);
			$paycenterEntityObject->setChapter($chapter);
			$paycenterEntityObject->setAccountingcode($accountingcode);
			$paycenterEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('paycenter_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>