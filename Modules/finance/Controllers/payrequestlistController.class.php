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
class payrequestlistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$committypeEntityObject=new finance_committypeEntity($DBAccessor);
		$result['committype_fid']=$committypeEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(finance_payrequestEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$payrequestEnt=new finance_payrequestEntity($DBAccessor);
		$result['payrequest']=$payrequestEnt;
		$allcount=$payrequestEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$payrequestEnt->FindAll($QueryLogic);
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
		$payrequestEnt=new finance_payrequestEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$request_date_from,$request_date_to,$price,$commit_date_from,$commit_date_to,$committype_fid,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$payrequestEnt=new finance_payrequestEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("request_date",$request_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("request_date",$request_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("price","%$price%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("commit_date",$commit_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("commit_date",$commit_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("committype_fid","%$committype_fid%",LogicalOperator::LIKE));
		$sortByField=$payrequestEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>