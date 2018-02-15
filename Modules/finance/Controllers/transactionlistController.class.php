<?php
namespace Modules\finance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\finance\Entity\finance_bankpaymentinfoEntity;
use Modules\finance\Entity\finance_chapterEntity;
use Modules\finance\PublicClasses\Payment;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Entity\users_userEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\finance\Entity\finance_transactionEntity;
use Modules\users\PublicClasses\User;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-09 - 2018-01-29 11:26
*@lastUpdate 1396-11-09 - 2018-01-29 11:26
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class transactionlistController extends Controller {
	private $PAGESIZE=25;
	public function getData($PageNum,QueryLogic $QueryLogic,$SystemUserID)
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
		if($SystemUserID!=null && $SystemUserID>0)
            $QueryLogic->addCondition(new FieldCondition(finance_transactionEntity::$ROLE_SYSTEMUSER_FID,$SystemUserID));
		$transactionEnt=new finance_transactionEntity($DBAccessor);
		$result['transaction']=$transactionEnt;
		$allcount=$transactionEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$transactionEnt->FindAll($QueryLogic);
        for ($i=0;$i<count($result['data']);$i++)
        {
            $dt=$result['data'][$i];
//            echo $dt->getRole_systemuser_fid();
            if($dt->getRole_systemuser_fid()>0)
            {

                $user=new users_userEntity($DBAccessor);
                $qqq=new QueryLogic([0=>new FieldCondition(users_userEntity::$ROLE_SYSTEMUSER_FID,$dt->getRole_systemuser_fid())]);
                $user=$user->FindOne($qqq);
                $result['userinfo'][$i]=$user;
            }
            $Pent=new finance_bankpaymentinfoEntity($DBAccessor);
            $q2=new QueryLogic();
            $q2->addCondition(new FieldCondition("transaction_fid",$dt->getId(),LogicalOperator::Equal));
            $Pent=$Pent->FindOne($q2);
            $result['bankpayment'][$i]=$Pent;
        }
		$DBAccessor->close_connection();
		return $result;
	}
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
	public function load($PageNum,$SystemUserID)
	{
		$DBAccessor=new dbaccess();
		$transactionEnt=new finance_transactionEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q,$SystemUserID);
	}
    public function getUserBalance($UserName,$Password)
    {

        $Payment=new Payment();
        $SystemUserID=User::getSystemUserIDFromUserPass($UserName,$Password);
        $UserBalance=$Payment->getBalance(1,$SystemUserID);
        $result['data'][0]['balance']=$UserBalance;
        return $result;
    }
	public function Search($PageNum,$amount,$description,$add_time_from,$add_time_to,$commit_time_from,$commit_time_to,$issuccessful,$chapter_fid,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$transactionEnt=new finance_transactionEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("amount","%$amount%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("description","%$description%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("add_time",$add_time_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("add_time",$add_time_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("commit_time",$commit_time_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("commit_time",$commit_time_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("issuccessful","%$issuccessful%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("chapter_fid","%$chapter_fid%",LogicalOperator::LIKE));
		$sortByField=$transactionEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q,-1);
	}
}
?>