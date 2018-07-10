<?php
namespace Modules\finance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\finance\Entity\finance_payrequestEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-08 - 2017-11-29 15:33
*@lastUpdate 1396-09-08 - 2017-11-29 15:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managepayrequestController extends Controller {
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
		$payrequestEntityObject=new finance_payrequestEntity($DBAccessor);
			$committypeEntityObject=new finance_committypeEntity($DBAccessor);
			$result['committype_fid']=$committypeEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('payrequest_fid',$ID));
		$result['payrequest']=$payrequestEntityObject;
		if($ID!=-1){
			$payrequestEntityObject->setId($ID);
			if($payrequestEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $payrequestEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['payrequest']=$payrequestEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$request_date,$price,$commit_date,$committype_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$payrequestEntityObject=new finance_payrequestEntity($DBAccessor);
		$this->ValidateFieldArray([$request_date,$price,$commit_date,$committype_fid],[$payrequestEntityObject->getFieldInfo(finance_payrequestEntity::$REQUEST_DATE),$payrequestEntityObject->getFieldInfo(finance_payrequestEntity::$PRICE),$payrequestEntityObject->getFieldInfo(finance_payrequestEntity::$COMMIT_DATE),$payrequestEntityObject->getFieldInfo(finance_payrequestEntity::$COMMITTYPE_FID)]);
		if($ID==-1){
			$payrequestEntityObject->setRequest_date($request_date);
			$payrequestEntityObject->setPrice($price);
			$payrequestEntityObject->setCommit_date($commit_date);
			$payrequestEntityObject->setCommittype_fid($committype_fid);
			$payrequestEntityObject->Save();
			$ID=$payrequestEntityObject->getId();
		}
		else{
			$payrequestEntityObject->setId($ID);
			if($payrequestEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $payrequestEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$payrequestEntityObject->setRequest_date($request_date);
			$payrequestEntityObject->setPrice($price);
			$payrequestEntityObject->setCommit_date($commit_date);
			$payrequestEntityObject->setCommittype_fid($committype_fid);
			$payrequestEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('payrequest_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>