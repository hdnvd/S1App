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
class doctorreservelistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$doctorplanEntityObject=new ocms_doctorplanEntity($DBAccessor);
		$result['doctorplan_fid']=$doctorplanEntityObject->FindAll(new QueryLogic());
		$financial_transactionEntityObject=new ocms_transactionEntity($DBAccessor);
		$result['financial_transaction_fid']=$financial_transactionEntityObject->FindAll(new QueryLogic());
		$presencetypeEntityObject=new ocms_presencetypeEntity($DBAccessor);
		$result['presencetype_fid']=$presencetypeEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(ocms_doctorreserveEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$doctorreserveEnt=new ocms_doctorreserveEntity($DBAccessor);
		$result['doctorreserve']=$doctorreserveEnt;
		$allcount=$doctorreserveEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$doctorreserveEnt->FindAll($QueryLogic);
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
	public function load($PageNum)
	{
		$DBAccessor=new dbaccess();
		$doctorreserveEnt=new ocms_doctorreserveEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$doctorplan_fid,$financial_transaction_fid,$presencetype_fid,$reserve_date_from,$reserve_date_to,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$doctorreserveEnt=new ocms_doctorreserveEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("doctorplan_fid","%$doctorplan_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("financial_transaction_fid","%$financial_transaction_fid%",LogicalOperator::LIKE));
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