<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_employeeEntity;
use Modules\itsap\Entity\itsap_servicerequestservicestatusEntity;
use Modules\itsap\Entity\itsap_servicetypeEntity;
use Modules\itsap\Entity\itsap_servicetypegroupEntity;
use Modules\itsap\Entity\itsap_topunitEntity;
use Modules\itsap\Entity\itsap_unitEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Entity\roleSystemUserEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_servicerequestEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-15 - 2018-04-04 01:34
*@lastUpdate 1397-01-15 - 2018-04-04 01:34
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicerequestController extends Controller {
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
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$servicerequestEntityObject=new itsap_servicerequestEntity($DBAccessor);
		$servicetypeEntityObject=new itsap_servicetypeEntity($DBAccessor);
		$result['servicetype_fid']=$servicetypeEntityObject->FindAll(new QueryLogic());

        $servicetypegroupEntityObject=new itsap_servicetypegroupEntity($DBAccessor);
        $result['servicetypegroup_fid']=$servicetypegroupEntityObject->FindAll(new QueryLogic());

//		$devicetypeEntityObject=new itsap_devicetypeEntity($DBAccessor);
//		$result['devicetype_fid']=$devicetypeEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicerequest_fid',$ID));
		$result['servicerequest']=$servicerequestEntityObject;

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

		if($ID!=-1){
			$servicerequestEntityObject->setId($ID);
			if($servicerequestEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $servicerequestEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['servicerequest']=$servicerequestEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$unit_fid,$servicetype_fid,$description,$priority,$file1_flu,$request_date,$letterfile_flu,$securityacceptor_role_systemuser_fid,$letternumber,$letter_date)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$servicerequestEntityObject=new itsap_servicerequestEntity($DBAccessor);
		$file1_fluURL='';
		if($file1_flu!=null && count($file1_flu)>0)
			$file1_fluURL=$file1_flu[0]['url'];
		$letterfile_fluURL='';
		if($letterfile_flu!=null && count($letterfile_flu)>0)
			$letterfile_fluURL=$letterfile_flu[0]['url'];
		$this->ValidateFieldArray([$title,$unit_fid,$servicetype_fid,$description,$priority,$file1_fluURL,$request_date,$letterfile_fluURL,$securityacceptor_role_systemuser_fid,$letternumber,$letter_date],[$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$TITLE),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$UNIT_FID),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$SERVICETYPE_FID),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$DESCRIPTION),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$PRIORITY),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$FILE1_FLU),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$REQUEST_DATE),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$LETTERFILE_FLU),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$SECURITYACCEPTOR_ROLE_SYSTEMUSER_FID),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$LETTERNUMBER),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$LETTER_DATE)]);
        //Get Priority By Service Type
        $ServiceTypeEnt=new itsap_servicetypeEntity($DBAccessor);
        $ServiceTypeEnt->setId($servicetype_fid);
        if($ServiceTypeEnt==null || $ServiceTypeEnt->getId()<0) throw new DataNotFoundException();
        $priority=$ServiceTypeEnt->getPriority();
        //EOF Get Priority By Service Type

        $servicetypeGroupEnt=new itsap_servicetypegroupEntity($DBAccessor);
        $servicetypeGroupEnt->setId($ServiceTypeEnt->getServicetypegroup_fid());
		if($ID==-1){
            //Get Requester Employee Unit
            $emp=new itsap_employeeEntity($DBAccessor);
            $q1=new QueryLogic();
            $q1->addCondition(new FieldCondition(itsap_employeeEntity::$ROLE_SYSTEMUSER_FID,$role_systemuser_fid));
            $emp=$emp->FindOne($q1);
            if($emp==null || $emp->getId()<0) throw new DataNotFoundException();
            $unit=new itsap_unitEntity($DBAccessor);
            $unit->setId($emp->getUnit_fid());
            if($unit==null || $unit->getId()<0) throw new DataNotFoundException();
            //EOF Get Requester Employee Unit

			$servicerequestEntityObject->setTitle($title);
            $servicerequestEntityObject->setUnit_fid($unit->getId());
			$servicerequestEntityObject->setServicetype_fid($servicetype_fid);
			$servicerequestEntityObject->setDescription($description);
			$servicerequestEntityObject->setPriority($priority);
			$servicerequestEntityObject->setFile1_flu($file1_fluURL);
			$servicerequestEntityObject->setRequest_date($request_date);
            $servicerequestEntityObject->setRole_systemuser_fid($role_systemuser_fid);
			$servicerequestEntityObject->setLetterfile_flu($letterfile_fluURL);
			$servicerequestEntityObject->setSecurityacceptor_role_systemuser_fid(-1);
			$servicerequestEntityObject->setIs_securityaccepted(0);
			$servicerequestEntityObject->setSecurityacceptancemessage("");
            $servicerequestEntityObject->setSecurityacceptance_date(-1);
			$servicerequestEntityObject->setLetternumber($letternumber);
			$servicerequestEntityObject->setLetter_date($letter_date);
			$servicerequestEntityObject->Save();
			$ID=$servicerequestEntityObject->getId();
            $statusEnt=new itsap_servicerequestservicestatusEntity($DBAccessor);
            $statusEnt->setServicestatus_fid(1);//Residegi Nashode
            $statusEnt->setServicerequest_fid($ID);
            $statusEnt->setMessage('');
            $statusEnt->setRole_systemuser_fid($role_systemuser_fid);
            $statusEnt->setStart_date(time());
            $statusEnt->Save();
            $servicerequestEntityObject->setLast_servicestatus_fid($statusEnt->getId());
            $servicerequestEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicerequest_fid',$ID));
		$result=$this->load($ID);
		$result['needdevice']=$ServiceTypeEnt->getIs_needdevice();
        $result['id']=$ID;
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>