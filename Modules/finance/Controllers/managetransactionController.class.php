<?php
namespace Modules\finance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\finance\Entity\finance_chapterEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\finance\Entity\finance_transactionEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-09 - 2018-01-29 11:26
*@lastUpdate 1396-11-09 - 2018-01-29 11:26
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managetransactionController extends Controller {
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
		$transactionEntityObject=new finance_transactionEntity($DBAccessor);
		$chapterEntityObject=new finance_chapterEntity($DBAccessor);
		$result['chapter_fid']=$chapterEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('transaction_fid',$ID));
		$result['transaction']=$transactionEntityObject;
		if($ID!=-1){
			$transactionEntityObject->setId($ID);
			if($transactionEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $transactionEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['transaction']=$transactionEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$amount,$description,$add_time,$commit_time,$issuccessful,$chapter_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$transactionEntityObject=new finance_transactionEntity($DBAccessor);
		$this->ValidateFieldArray([$amount,$description,$add_time,$commit_time,$issuccessful,$chapter_fid],[$transactionEntityObject->getFieldInfo(finance_transactionEntity::$AMOUNT),$transactionEntityObject->getFieldInfo(finance_transactionEntity::$DESCRIPTION),$transactionEntityObject->getFieldInfo(finance_transactionEntity::$ADD_TIME),$transactionEntityObject->getFieldInfo(finance_transactionEntity::$COMMIT_TIME),$transactionEntityObject->getFieldInfo(finance_transactionEntity::$ISSUCCESSFUL),$transactionEntityObject->getFieldInfo(finance_transactionEntity::$CHAPTER_FID)]);
		if($ID==-1){
			$transactionEntityObject->setAmount($amount);
			$transactionEntityObject->setDescription($description);
			$transactionEntityObject->setAdd_time($add_time);
			$transactionEntityObject->setCommit_time($commit_time);
			$transactionEntityObject->setIssuccessful($issuccessful);
			$transactionEntityObject->setChapter_fid($chapter_fid);
			$transactionEntityObject->Save();
			$ID=$transactionEntityObject->getId();
		}
		else{
			$transactionEntityObject->setId($ID);
			if($transactionEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $transactionEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$transactionEntityObject->setAmount($amount);
			$transactionEntityObject->setDescription($description);
			$transactionEntityObject->setAdd_time($add_time);
			$transactionEntityObject->setCommit_time($commit_time);
			$transactionEntityObject->setIssuccessful($issuccessful);
			$transactionEntityObject->setChapter_fid($chapter_fid);
			$transactionEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('transaction_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>