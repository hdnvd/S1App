<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_employeeEntity;
use Modules\itsap\Entity\itsap_servicerequestservicestatusEntity;
use Modules\itsap\Entity\itsap_servicestatusEntity;
use Modules\itsap\Entity\itsap_servicetypeEntity;
use Modules\itsap\Entity\itsap_topunitEntity;
use Modules\itsap\Entity\itsap_unitEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_servicerequestEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-29 - 2017-12-20 15:49
*@lastUpdate 1396-09-29 - 2017-12-20 15:49
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class outboxController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$servicetypeEntityObject=new itsap_servicetypeEntity($DBAccessor);
		$result['servicetype_fid']=$servicetypeEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(itsap_servicerequestEntity::$ROLE_SYSTEMUSER_FID,$UserID));



        //Get Requester Employee Unit
        $emp=new itsap_employeeEntity($DBAccessor);
        $q1=new QueryLogic();
        $q1->addCondition(new FieldCondition(itsap_employeeEntity::$ROLE_SYSTEMUSER_FID,$role_systemuser_fid));
        $emp=$emp->FindOne($q1);
        if($emp==null || $emp->getId()<0) throw new DataNotFoundException();
        $result['employee']=$emp;
        $unit=new itsap_unitEntity($DBAccessor);
        $unit->setId($emp->getUnit_fid());
        if($unit==null || $unit->getId()<0) throw new DataNotFoundException();
        $result['unit']=$unit;

        $topunit=new itsap_topunitEntity($DBAccessor);
        $topunit->setId($unit->getTopunit_fid());
        if($topunit==null || $topunit->getId()<0) throw new DataNotFoundException();
        $result['topunit']=$topunit;

        $itunit=new itsap_unitEntity($DBAccessor);
        $qq=new QueryLogic();
        $qq->addCondition(new FieldCondition(itsap_unitEntity::$ISFAVA,"1"));
        $qq->addCondition(new FieldCondition(itsap_unitEntity::$TOPUNIT_FID,$topunit->getId()));
        $itunit=$itunit->FindOne($qq);
        if($itunit==null || $itunit->getId()<0) throw new DataNotFoundException();
        $result['itunit']=$itunit;

        $itunitAdmin=new itsap_employeeEntity($DBAccessor);
        $itunitAdmin->setId($itunit->getAdmin_employee_fid());
        if($itunitAdmin==null || $itunitAdmin->getId()<0) throw new DataNotFoundException();
        $result['itunitadmin']=$itunitAdmin;

        //EOF Get Requester Employee Unit

        $QueryLogic->addCondition(new FieldCondition(itsap_servicerequestEntity::$UNIT_FID,$unit->getId()));
		$servicerequestEnt=new itsap_servicerequestEntity($DBAccessor);
		$result['servicerequest']=$servicerequestEnt;
		$allcount=$servicerequestEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$servicerequestEnt->FindAll($QueryLogic);
		$data=$result['data'];
        $AllCount1 = count($data);
        for ($i = 0; $i < $AllCount1; $i++) {
            $emp=new itsap_employeeEntity($DBAccessor);
            $q1=new QueryLogic();
            $q1->addCondition(new FieldCondition(itsap_employeeEntity::$ROLE_SYSTEMUSER_FID,$data[$i]->getRole_systemuser_fid()));
            $emp=$emp->FindOne($q1);
            $unit=new itsap_unitEntity($DBAccessor);
            $unit->setId($data[$i]->getUnit_fid());
            $topUnit=new itsap_topunitEntity($DBAccessor);
            $topUnit->setId($unit->getTopunit_fid());
            $result['requesters'][$i]['employee']=$emp;
            $result['requesters'][$i]['unit']=$unit;
            $result['requesters'][$i]['topunit']=$topUnit;

            $StatusesObject=new itsap_servicerequestservicestatusEntity($DBAccessor);
            $myq=new QueryLogic();
            $myq->addCondition(new FieldCondition(itsap_servicerequestservicestatusEntity::$SERVICEREQUEST_FID,$data[$i]->getId()));
            $myq->addOrderBy(itsap_servicerequestservicestatusEntity::$START_DATE,true);
            $CurrentStatus=$StatusesObject->FindOne($myq);
            $StatusEnt=new itsap_servicestatusEntity($DBAccessor);
            $StatusEnt->setId($CurrentStatus->getServicestatus_fid());
            $result['currentstatusinfo'][$i]=$StatusEnt;

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
	public function load($PageNum)
	{
		$DBAccessor=new dbaccess();
		$servicerequestEnt=new itsap_servicerequestEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$title,$servicetype_fid,$description,$priority,$request_date_from,$request_date_to,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$servicerequestEnt=new itsap_servicerequestEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("title","%$title%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("servicetype_fid","%$servicetype_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("description","%$description%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("priority","%$priority%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("request_date",$request_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("request_date",$request_date_to,LogicalOperator::Smaller));
		$sortByField=$servicerequestEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>