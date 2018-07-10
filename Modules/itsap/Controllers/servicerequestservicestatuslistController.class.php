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
use Modules\itsap\Entity\itsap_servicerequestservicestatusEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-17 - 2017-12-08 09:41
*@lastUpdate 1396-09-17 - 2017-12-08 09:41
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class servicerequestservicestatuslistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$servicestatusEntityObject=new itsap_servicestatusEntity($DBAccessor);
		$result['servicestatus_fid']=$servicestatusEntityObject->FindAll(new QueryLogic());
		$servicerequestEntityObject=new itsap_servicerequestEntity($DBAccessor);
		$result['servicerequest_fid']=$servicerequestEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(itsap_servicerequestservicestatusEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$servicerequestservicestatusEnt=new itsap_servicerequestservicestatusEntity($DBAccessor);
		$result['servicerequestservicestatus']=$servicerequestservicestatusEnt;
		$allcount=$servicerequestservicestatusEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$servicerequestservicestatusEnt->FindAll($QueryLogic);
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
		$servicerequestservicestatusEnt=new itsap_servicerequestservicestatusEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$servicestatus_fid,$servicerequest_fid,$start_date_from,$start_date_to,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$servicerequestservicestatusEnt=new itsap_servicerequestservicestatusEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("servicestatus_fid","%$servicestatus_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("servicerequest_fid","%$servicerequest_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("start_date",$start_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("start_date",$start_date_to,LogicalOperator::Smaller));
		$sortByField=$servicerequestservicestatusEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>