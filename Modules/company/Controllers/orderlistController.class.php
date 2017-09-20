<?php
namespace Modules\company\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\finance\Entity\finance_transactionEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\company\Entity\company_orderEntity;
use Modules\company\Entity\company_packageEntity;
use Modules\company\Entity\company_transactionEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-28 - 2017-09-19 16:32
*@lastUpdate 1396-06-28 - 2017-09-19 16:32
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class orderlistController extends Controller {
	private $PAGESIZE=10;
	public function load($PageNum)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
			$packageEntityObject=new company_packageEntity($DBAccessor);
			$result['package_fid']=$packageEntityObject->FindAll(new QueryLogic());
			$finance_transactionEntityObject=new finance_transactionEntity($DBAccessor);
			$result['finance_transaction_fid']=$finance_transactionEntityObject->FindAll(new QueryLogic());
			$prepayment_finance_transactionEntityObject=new finance_transactionEntity($DBAccessor);
			$result['prepayment_finance_transaction_fid']=$prepayment_finance_transactionEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$orderEnt=new company_orderEntity($DBAccessor);
		$q=new QueryLogic();		
$q->addOrderBy("id",true);
		$allcount=$orderEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$orderEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function Search($PageNum,$descriptions,$similarproducts,$email,$orderdate,$mobile,$name,$family,$paydate,$package_fid,$finance_transaction_fid,$prepayment_finance_transaction_fid,$sortby,$isdesc)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
			$packageEntityObject=new company_packageEntity($DBAccessor);
			$result['package_fid']=$packageEntityObject->FindAll(new QueryLogic());
			$finance_transactionEntityObject=new finance_transactionEntity($DBAccessor);
			$result['finance_transaction_fid']=$finance_transactionEntityObject->FindAll(new QueryLogic());
			$prepayment_finance_transactionEntityObject=new finance_transactionEntity($DBAccessor);
			$result['prepayment_finance_transaction_fid']=$prepayment_finance_transactionEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$orderEnt=new company_orderEntity($DBAccessor);
		$q=new QueryLogic();		
$q->addCondition(new FieldCondition("descriptions","%$descriptions%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("similarproducts","%$similarproducts%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("email","%$email%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("orderdate","%$orderdate%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("mobile","%$mobile%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("name","%$name%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("family","%$family%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("paydate","%$paydate%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("package_fid","%$package_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("finance_transaction_fid","%$finance_transaction_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("prepayment_finance_transaction_fid","%$prepayment_finance_transaction_fid%",LogicalOperator::LIKE));		
$q->addOrderBy($sortby,$isdesc);
		$allcount=$orderEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$orderEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>