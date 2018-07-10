<?php
namespace Modules\fileshop\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\fileshop\Entity\fileshop_filetransactionEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-09 - 2017-11-30 16:35
*@lastUpdate 1396-09-09 - 2017-11-30 16:35
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managefiletransactionController extends Controller {
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
		$filetransactionEntityObject=new fileshop_filetransactionEntity($DBAccessor);
		$fileEntityObject=new fileshop_fileEntity($DBAccessor);
		$result['file_fid']=$fileEntityObject->FindAll(new QueryLogic());
		$finance_bankpaymentinfoEntityObject=new finance_bankpaymentinfoEntity($DBAccessor);
		$result['finance_bankpaymentinfo_fid']=$finance_bankpaymentinfoEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('filetransaction_fid',$ID));
		$result['filetransaction']=$filetransactionEntityObject;
		if($ID!=-1){
			$filetransactionEntityObject->setId($ID);
			if($filetransactionEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $filetransactionEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['filetransaction']=$filetransactionEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$file_fid,$finance_bankpaymentinfo_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$filetransactionEntityObject=new fileshop_filetransactionEntity($DBAccessor);
		$this->ValidateFieldArray([$file_fid,$finance_bankpaymentinfo_fid],[$filetransactionEntityObject->getFieldInfo(fileshop_filetransactionEntity::$FILE_FID),$filetransactionEntityObject->getFieldInfo(fileshop_filetransactionEntity::$FINANCE_BANKPAYMENTINFO_FID)]);
		if($ID==-1){
			$filetransactionEntityObject->setFile_fid($file_fid);
			$filetransactionEntityObject->setFinance_bankpaymentinfo_fid($finance_bankpaymentinfo_fid);
			$filetransactionEntityObject->Save();
			$ID=$filetransactionEntityObject->getId();
		}
		else{
			$filetransactionEntityObject->setId($ID);
			if($filetransactionEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $filetransactionEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$filetransactionEntityObject->setFile_fid($file_fid);
			$filetransactionEntityObject->setFinance_bankpaymentinfo_fid($finance_bankpaymentinfo_fid);
			$filetransactionEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('filetransaction_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>