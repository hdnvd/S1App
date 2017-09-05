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
class bankpaymentinfolistController extends Controller {
	private $PAGESIZE=10;
	public function load($PageNum)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
			$transactionEntityObject=new finance_transactionEntity($DBAccessor);
			$result['transaction_fid']=$transactionEntityObject->FindAll(new QueryLogic());
			$statusEntityObject=new finance_statusEntity($DBAccessor);
			$result['status_fid']=$statusEntityObject->FindAll(new QueryLogic());
			$portalEntityObject=new finance_portalEntity($DBAccessor);
			$result['portal_fid']=$portalEntityObject->FindAll(new QueryLogic());
			$systemuserEntityObject=new finance_systemuserEntity($DBAccessor);
			$result['systemuser_fid']=$systemuserEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$bankpaymentinfoEnt=new finance_bankpaymentinfoEntity($DBAccessor);
		$q=new QueryLogic();
		$allcount=$bankpaymentinfoEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$bankpaymentinfoEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function Search($PageNum,$amount,$payedamount,$cardnumber,$factorserial,$transaction_fid,$status_fid,$start_time,$commit_time,$portal_fid,$name,$family,$systemuser_fid,$phonenumber,$sortby,$isdesc)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
			$transactionEntityObject=new finance_transactionEntity($DBAccessor);
			$result['transaction_fid']=$transactionEntityObject->FindAll(new QueryLogic());
			$statusEntityObject=new finance_statusEntity($DBAccessor);
			$result['status_fid']=$statusEntityObject->FindAll(new QueryLogic());
			$portalEntityObject=new finance_portalEntity($DBAccessor);
			$result['portal_fid']=$portalEntityObject->FindAll(new QueryLogic());
			$systemuserEntityObject=new finance_systemuserEntity($DBAccessor);
			$result['systemuser_fid']=$systemuserEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$bankpaymentinfoEnt=new finance_bankpaymentinfoEntity($DBAccessor);
		$q=new QueryLogic();		
$q->addCondition(new FieldCondition("amount","%$amount%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("payedamount","%$payedamount%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("cardnumber","%$cardnumber%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("factorserial","%$factorserial%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("transaction_fid","%$transaction_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("status_fid","%$status_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("start_time","%$start_time%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("commit_time","%$commit_time%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("portal_fid","%$portal_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("name","%$name%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("family","%$family%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("systemuser_fid","%$systemuser_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("phonenumber","%$phonenumber%",LogicalOperator::LIKE));		
$q->addOrderBy($sortby,$isdesc);
		$allcount=$bankpaymentinfoEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$bankpaymentinfoEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>