<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_doctorreserveEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedoctorreserveController extends Controller {
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
		$doctorreserveEntityObject=new ocms_doctorreserveEntity($DBAccessor);
		$doctorplanEntityObject=new ocms_doctorplanEntity($DBAccessor);
		$result['doctorplan_fid']=$doctorplanEntityObject->FindAll(new QueryLogic());
		$financial_transactionEntityObject=new financial_transactionEntity($DBAccessor);
		$result['financial_transaction_fid']=$financial_transactionEntityObject->FindAll(new QueryLogic());
		$presencetypeEntityObject=new ocms_presencetypeEntity($DBAccessor);
		$result['presencetype_fid']=$presencetypeEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('doctorreserve_fid',$ID));
		$result['doctorreserve']=$doctorreserveEntityObject;
		if($ID!=-1){
			$doctorreserveEntityObject->setId($ID);
			if($doctorreserveEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $doctorreserveEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['doctorreserve']=$doctorreserveEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$doctorplan_fid,$financial_transaction_fid,$presencetype_fid,$reserve_date)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$doctorreserveEntityObject=new ocms_doctorreserveEntity($DBAccessor);
		$this->ValidateFieldArray([$doctorplan_fid,$financial_transaction_fid,$presencetype_fid,$reserve_date],[$doctorreserveEntityObject->getFieldInfo(ocms_doctorreserveEntity::$DOCTORPLAN_FID),$doctorreserveEntityObject->getFieldInfo(ocms_doctorreserveEntity::$FINANCIAL_TRANSACTION_FID),$doctorreserveEntityObject->getFieldInfo(ocms_doctorreserveEntity::$PRESENCETYPE_FID),$doctorreserveEntityObject->getFieldInfo(ocms_doctorreserveEntity::$RESERVE_DATE)]);
		if($ID==-1){
			$doctorreserveEntityObject->setDoctorplan_fid($doctorplan_fid);
			$doctorreserveEntityObject->setFinancial_transaction_fid($financial_transaction_fid);
			$doctorreserveEntityObject->setPresencetype_fid($presencetype_fid);
			$doctorreserveEntityObject->setReserve_date($reserve_date);
			$doctorreserveEntityObject->Save();
			$ID=$doctorreserveEntityObject->getId();
		}
		else{
			$doctorreserveEntityObject->setId($ID);
			if($doctorreserveEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $doctorreserveEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$doctorreserveEntityObject->setDoctorplan_fid($doctorplan_fid);
			$doctorreserveEntityObject->setFinancial_transaction_fid($financial_transaction_fid);
			$doctorreserveEntityObject->setPresencetype_fid($presencetype_fid);
			$doctorreserveEntityObject->setReserve_date($reserve_date);
			$doctorreserveEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('doctorreserve_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>