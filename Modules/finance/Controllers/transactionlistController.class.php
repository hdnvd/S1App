<?php
namespace Modules\finance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\finance\Entity\finance_bankpaymentinfoEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\finance\Entity\finance_transactionEntity;
use Modules\finance\Entity\finance_chapterEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-15 - 2017-09-06 14:09
*@lastUpdate 1396-06-15 - 2017-09-06 14:09
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class transactionlistController extends Controller {
	private $PAGESIZE=10;
	public function load($PageNum)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
			$chapterEntityObject=new finance_chapterEntity($DBAccessor);
			$result['chapter_fid']=$chapterEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$transactionEnt=new finance_transactionEntity($DBAccessor);
		$q=new QueryLogic();
		$allcount=$transactionEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$transactionEnt->FindAll($q);
        for ($i=0;$i<count($result['data']);$i++)
        {
            $dt=$result['data'][$i];
            $Pent=new finance_bankpaymentinfoEntity($DBAccessor);
            $q2=new QueryLogic();
            $q2->addCondition(new FieldCondition("transaction_fid",$dt->getId(),LogicalOperator::Equal));
            $Pent=$Pent->FindOne($q2);
            $result['bankpayment'][$i]=$Pent;
        }
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function Search($PageNum,$amount,$description,$add_time,$commit_time,$issuccessful,$chapter_fid,$sortby,$isdesc)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
			$chapterEntityObject=new finance_chapterEntity($DBAccessor);
			$result['chapter_fid']=$chapterEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$transactionEnt=new finance_transactionEntity($DBAccessor);
		$q=new QueryLogic();		
$q->addCondition(new FieldCondition("amount","%$amount%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("description","%$description%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("add_time","%$add_time%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("commit_time","%$commit_time%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("issuccessful","%$issuccessful%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("chapter_fid","%$chapter_fid%",LogicalOperator::LIKE));		
$q->addOrderBy($sortby,$isdesc);
		$allcount=$transactionEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$transactionEnt->FindAll($q);
		for ($i=0;$i<count($result['data']);$i++)
            {
                $dt=$result['data'][$i];
                $Pent=new finance_bankpaymentinfoEntity($DBAccessor);
                $q2=new QueryLogic();
                $q2->addCondition(new FieldCondition("transaction_fid",$dt->getId(),LogicalOperator::Equal));
                $Pent=$Pent->FindOne($q2);
                $result['bankpayment'][$i]=$Pent;
            }
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>