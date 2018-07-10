<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\finance\Entity\finance_transactionEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\ocms\Entity\ocms_doctorEntity;
use Modules\ocms\Entity\ocms_doctorplanEntity;
use Modules\ocms\Entity\ocms_presencetypeEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_doctorreserveEntity;
use Modules\users\PublicClasses\User;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-03 - 2018-01-23 00:07
*@lastUpdate 1396-11-03 - 2018-01-23 00:07
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class doctorreservelistController extends Controller {
	private $PAGESIZE=30;
	public function getData($PageNum,QueryLogic $QueryLogic,$username,$password,$Service)
    {
        $Language_fid = CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor = new dbaccess();
        $su = new sessionuser();
        $role_systemuser_fid = AppUserManager::getUserID($username, $password);
        $result = array();
        $doctorplanEntityObject = new ocms_doctorplanEntity($DBAccessor);
        $result['doctorplan_fid'] = $doctorplanEntityObject->FindAll(new QueryLogic());
        $financial_transactionEntityObject = new finance_transactionEntity($DBAccessor);
        $result['financial_transaction_fid'] = $financial_transactionEntityObject->FindAll(new QueryLogic());
        $financial_canceltransactionEntityObject = new finance_transactionEntity($DBAccessor);
        $result['financial_canceltransaction_fid'] = $financial_canceltransactionEntityObject->FindAll(new QueryLogic());
        $presencetypeEntityObject = new ocms_presencetypeEntity($DBAccessor);
        $result['presencetype_fid'] = $presencetypeEntityObject->FindAll(new QueryLogic());
        if ($PageNum <= 0)
            $PageNum = 1;

        if ($Service == "getdoctorreserves") {

            $doctorEnt = new ocms_doctorEntity($DBAccessor);
            $q = new QueryLogic();
            $q->addCondition(new FieldCondition(ocms_doctorEntity::$ROLE_SYSTEMUSER_FID, $role_systemuser_fid));
            $doctorEnt = $doctorEnt->FindOne($q);
            $doctorreserveEnt = new ocms_doctorplanEntity($DBAccessor);
//		$reserveinfo=$doctorreserveEnt->getDoctorReserves($doctorEnt->getId(),'0,100');
//		$result['doctorreserves']=$reserveinfo;
            $allcount = $doctorreserveEnt->getDoctorReserves($doctorEnt->getId(), null, true);
            $result['pagecount'] = $this->getPageCount($allcount[0]['count'], $this->PAGESIZE);
            $Limit = $this->getPageRowsLimit($PageNum, $this->PAGESIZE);
            $result['data'] = $doctorreserveEnt->getDoctorReserves($doctorEnt->getId(), $Limit, false);
        } elseif ($Service == 'getuserreserves')
        {
            $doctorreserveEnt = new ocms_doctorplanEntity($DBAccessor);
//		$reserveinfo=$doctorreserveEnt->getDoctorReserves($doctorEnt->getId(),'0,100');
//		$result['doctorreserves']=$reserveinfo;
            $allcount = $doctorreserveEnt->getUserReserves($role_systemuser_fid, null, true);
            $result['pagecount'] = $this->getPageCount($allcount[0]['count'], $this->PAGESIZE);
            $Limit = $this->getPageRowsLimit($PageNum, $this->PAGESIZE);
            $result['data'] = $doctorreserveEnt->getUserReserves($role_systemuser_fid, $Limit, false);
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
	public function load($PageNum,$username,$password,$Service)
	{
		$DBAccessor=new dbaccess();
		$doctorreserveEnt=new ocms_doctorreserveEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q,$username,$password,$Service);
	}
	public function Search($PageNum,$doctorplan_fid,$financial_transaction_fid,$financial_canceltransaction_fid,$presencetype_fid,$reserve_date_from,$reserve_date_to,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$doctorreserveEnt=new ocms_doctorreserveEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("doctorplan_fid","%$doctorplan_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("financial_transaction_fid","%$financial_transaction_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("financial_canceltransaction_fid","%$financial_canceltransaction_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("presencetype_fid","%$presencetype_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("reserve_date",$reserve_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("reserve_date",$reserve_date_to,LogicalOperator::Smaller));
		$sortByField=$doctorreserveEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>