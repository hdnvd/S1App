<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_servicerequestEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-07-29 - 2018-10-21 15:46
*@lastUpdate 1397-07-29 - 2018-10-21 15:46
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class servicerequestlistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$unitEntityObject=new itsap_unitEntity($DBAccessor);
		$result['unit_fid']=$unitEntityObject->FindAll(new QueryLogic());
		$servicetypeEntityObject=new itsap_servicetypeEntity($DBAccessor);
		$result['servicetype_fid']=$servicetypeEntityObject->FindAll(new QueryLogic());
		$securityacceptor_role_systemuserEntityObject=new itsap_systemuserEntity($DBAccessor);
		$result['securityacceptor_role_systemuser_fid']=$securityacceptor_role_systemuserEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(itsap_servicerequestEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$servicerequestEnt=new itsap_servicerequestEntity($DBAccessor);
		$result['servicerequest']=$servicerequestEnt;
		$allcount=$servicerequestEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$servicerequestEnt->FindAll($QueryLogic);
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
		$servicerequestEnt=new itsap_servicerequestEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$title,$unit_fid,$servicetype_fid,$description,$priority,$request_date_from,$request_date_to,$securityacceptor_role_systemuser_fid,$is_securityaccepted,$securityacceptancemessage,$securityacceptance_date_from,$securityacceptance_date_to,$letternumber,$letter_date_from,$letter_date_to,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$servicerequestEnt=new itsap_servicerequestEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("title","%$title%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("unit_fid","%$unit_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("servicetype_fid","%$servicetype_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("description","%$description%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("priority","%$priority%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("request_date",$request_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("request_date",$request_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("securityacceptor_role_systemuser_fid","%$securityacceptor_role_systemuser_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("is_securityaccepted","%$is_securityaccepted%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("securityacceptancemessage","%$securityacceptancemessage%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("securityacceptance_date",$securityacceptance_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("securityacceptance_date",$securityacceptance_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("letternumber","%$letternumber%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("letter_date",$letter_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("letter_date",$letter_date_to,LogicalOperator::Smaller));
		$sortByField=$servicerequestEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>