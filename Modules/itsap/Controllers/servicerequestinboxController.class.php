<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_devicetypeEntity;
use Modules\itsap\Entity\itsap_employeeEntity;
use Modules\itsap\Entity\itsap_servicerequestservicestatusEntity;
use Modules\itsap\Entity\itsap_servicestatusEntity;
use Modules\itsap\Entity\itsap_servicetypeEntity;
use Modules\itsap\Entity\itsap_servicetypegroupEntity;
use Modules\itsap\Entity\itsap_topunitEntity;
use Modules\itsap\Entity\itsap_unitEntity;
use Modules\itsap\Entity\itsap_viewservicerequesthandlerEntity;
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
class servicerequestinboxController extends Controller {
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

        //Get Admin Fava User`s TopUnit And Other Units of that TopUnit
        $emp=new itsap_employeeEntity($DBAccessor);
        $q1=new QueryLogic();
        $q1->addCondition(new FieldCondition(itsap_employeeEntity::$ROLE_SYSTEMUSER_FID,$role_systemuser_fid));
        $emp=$emp->FindOne($q1);
        $unit=new itsap_unitEntity($DBAccessor);
        $unit->setId($emp->getUnit_fid());

        $isFava=$unit->getIsfava();
        $isSecurity=$unit->getIssecurity();
        $isAdmin=false;
        if($unit->getAdmin_employee_fid()==$emp->getId())
            $isAdmin=true;
        $topUnit=new itsap_topunitEntity($DBAccessor);
        $topUnit->setId($unit->getTopunit_fid());
        $unitEntityObject=new itsap_unitEntity($DBAccessor);
        $result['unit_fid']=$unitEntityObject->FindAll(new QueryLogic());
        $result['topunit_fid']=(new itsap_topunitEntity($DBAccessor))->FindAll(new QueryLogic());
        $result['devicetype_fid']=(new itsap_devicetypeEntity($DBAccessor))->FindAll(new QueryLogic());
        $result['servicetypegroup_fid']=(new itsap_servicetypegroupEntity($DBAccessor))->FindAll(new QueryLogic());
        $result['servicestatus_fid']=(new itsap_servicestatusEntity($DBAccessor))->FindAll(new QueryLogic());

        $servicetypeEntityObject=new itsap_servicetypeEntity($DBAccessor);
        $result['servicetype_fid']=$servicetypeEntityObject->FindAll(new QueryLogic());

        $servicerequestEnt1=new itsap_servicerequestEntity($DBAccessor);
        $count=$servicerequestEnt1->getRequests($isSecurity,$isFava,$isAdmin,$emp->getId(),$topUnit->getId(),$unit->getId(),$QueryLogic,null,true);
        $result['isfave']=$isFava;
        $result['isadmin']=$isAdmin;
        $result['issecurity']=$isSecurity;
        $servicerequestEnt=new itsap_viewservicerequesthandlerEntity($DBAccessor);
		$result['servicerequest']=$servicerequestEnt;
        $allcount=$count[0]['allcount'];
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
        $res=$servicerequestEnt1->getRequests($isSecurity,$isFava,$isAdmin,$emp->getId(),$topUnit->getId(),$unit->getId(),$QueryLogic,$this->getPageRowsLimit($PageNum,$this->PAGESIZE),false);
        $result['data']=$res;
		$data=$result['data'];
        $AllCount1 = count($data);
//        print_r($data[0]);
//        echo $res[0]->getId();
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
		$q->addOrderBy("sr.id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
    public function Search($PageNum,$title,$unit_fid,$servicetype_fid,$description,$priority,$request_date_from,$request_date_to,$SecurityAcceptor_EmployeeId,$is_securityaccepted,$securityacceptancemessage,$securityacceptance_date_from,$securityacceptance_date_to,$letternumber,$letter_date_from,$letter_date_to,$topunit_fid,$devicetype_fid,$deviceCode,$Requester_EmployeeId,$Handler_EmployeeId,$servicetypegroup_fid,$latestStatus,$sortby,$isdesc)
    {
        $DBAccessor=new dbaccess();
        $servicerequestEnt=new itsap_servicerequestEntity($DBAccessor);
        $emp=new itsap_employeeEntity($DBAccessor);
        $emp->setId($Requester_EmployeeId);
        $Requester_SysUserID=$emp->getRole_systemuser_fid();

        $HandlerEmp=new itsap_employeeEntity($DBAccessor);
        $HandlerEmp->setId($Handler_EmployeeId);
        $Handler_SysUserID=$HandlerEmp->getRole_systemuser_fid();

        $SecurityEmp=new itsap_employeeEntity($DBAccessor);
        $SecurityEmp->setId($SecurityAcceptor_EmployeeId);
        $securityacceptor_role_systemuser_fid=$SecurityEmp->getRole_systemuser_fid();


        $q=new QueryLogic();
        $q->addOrderBy("sr.id",true);
        $q->addCondition(new FieldCondition("sr.title","%$title%",LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("sr.unit_fid","%$unit_fid%",LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("sr.servicetype_fid","%$servicetype_fid%",LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("sr.description","%$description%",LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("sr.priority","%$priority%",LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("sr.request_date",$request_date_from,LogicalOperator::Bigger));
        $q->addCondition(new FieldCondition("sr.request_date",$request_date_to,LogicalOperator::Smaller));
        $q->addCondition(new FieldCondition("sr.is_securityaccepted","%$is_securityaccepted%",LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("sr.securityacceptancemessage","%$securityacceptancemessage%",LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("sr.securityacceptance_date",$securityacceptance_date_from,LogicalOperator::Bigger));
        $q->addCondition(new FieldCondition("sr.securityacceptance_date",$securityacceptance_date_to,LogicalOperator::Smaller));
        $q->addCondition(new FieldCondition("sr.letternumber","%$letternumber%",LogicalOperator::LIKE));
        $q->addCondition(new FieldCondition("sr.letter_date",$letter_date_from,LogicalOperator::Bigger));
        $q->addCondition(new FieldCondition("sr.letter_date",$letter_date_to,LogicalOperator::Smaller));
        if($deviceCode!="")
        $q->addCondition(new FieldCondition("device.code","%$deviceCode%",LogicalOperator::LIKE));
        if($topunit_fid>0)
            $q->addCondition(new FieldCondition("u.topunit_fid",$topunit_fid,LogicalOperator::Equal));
        if($devicetype_fid>0)
            $q->addCondition(new FieldCondition("device.devicetype_fid",$devicetype_fid,LogicalOperator::Equal));
        if($servicetypegroup_fid>0)
            $q->addCondition(new FieldCondition("st.servicetypegroup_fid",$servicetypegroup_fid,LogicalOperator::Equal));
        if($latestStatus>0)
            $q->addCondition(new FieldCondition("thestatus.servicestatus_fid",$latestStatus,LogicalOperator::Equal));
        if($securityacceptor_role_systemuser_fid>0)
            $q->addCondition(new FieldCondition("sr.securityacceptor_role_systemuser_fid",$securityacceptor_role_systemuser_fid,LogicalOperator::Equal));
        if($Requester_SysUserID>0)
            $q->addCondition(new FieldCondition("sr.role_systemuser_fid",$Requester_SysUserID,LogicalOperator::Equal));
        $sortByField=$servicerequestEnt->getTableField($sortby);
        if($sortByField!=null)
            $q->addOrderBy($sortByField,$isdesc);
        $DBAccessor->close_connection();
        return $this->getData($PageNum,$q);
    }
}
?>