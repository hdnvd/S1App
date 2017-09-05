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
use Modules\finance\Entity\finance_bankpaymentinfoEntity;
use Modules\finance\Entity\finance_transactionEntity;
use Modules\finance\Entity\finance_statusEntity;
use Modules\finance\Entity\finance_portalEntity;
use Modules\finance\Entity\finance_systemuserEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-13 - 2017-09-04 18:38
*@lastUpdate 1396-06-13 - 2017-09-04 18:38
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class bankpaymentinfoController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$bankpaymentinfoEntityObject=new finance_bankpaymentinfoEntity($DBAccessor);
		if($ID!=-1){
			$bankpaymentinfoEntityObject->setId($ID);
			if($bankpaymentinfoEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['bankpaymentinfo']=$bankpaymentinfoEntityObject;
			$transactionEntityObject=new finance_transactionEntity($DBAccessor);
			$transactionEntityObject->SetId($result['bankpaymentinfo']->getTransaction_fid());
			if($transactionEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['transaction_fid']=$transactionEntityObject;
			$statusEntityObject=new finance_statusEntity($DBAccessor);
			$statusEntityObject->SetId($result['bankpaymentinfo']->getStatus_fid());
			if($statusEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['status_fid']=$statusEntityObject;
			$portalEntityObject=new finance_portalEntity($DBAccessor);
			$portalEntityObject->SetId($result['bankpaymentinfo']->getPortal_fid());
			if($portalEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['portal_fid']=$portalEntityObject;
			$systemuserEntityObject=new finance_systemuserEntity($DBAccessor);
			$systemuserEntityObject->SetId($result['bankpaymentinfo']->getSystemuser_fid());
			if($systemuserEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['systemuser_fid']=$systemuserEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>