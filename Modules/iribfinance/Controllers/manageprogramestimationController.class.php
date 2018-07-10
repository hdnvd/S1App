<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\iribfinance\Entity\iribfinance_classEntity;
use Modules\iribfinance\Entity\iribfinance_departmentEntity;
use Modules\iribfinance\Entity\iribfinance_employeeEntity;
use Modules\iribfinance\Entity\iribfinance_paycenterEntity;
use Modules\iribfinance\Entity\iribfinance_programmaketypeEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_programestimationEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:27
*@lastUpdate 1396-11-05 - 2018-01-25 18:27
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageprogramestimationController extends Controller {
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
		$programestimationEntityObject=new iribfinance_programestimationEntity($DBAccessor);
		$departmentEntityObject=new iribfinance_departmentEntity($DBAccessor);
		$result['department_fid']=$departmentEntityObject->FindAll(new QueryLogic());
		$classEntityObject=new iribfinance_classEntity($DBAccessor);
		$result['class_fid']=$classEntityObject->FindAll(new QueryLogic());
		$programmaketypeEntityObject=new iribfinance_programmaketypeEntity($DBAccessor);
		$result['programmaketype_fid']=$programmaketypeEntityObject->FindAll(new QueryLogic());
		$producer_employeeEntityObject=new iribfinance_employeeEntity($DBAccessor);
		$result['producer_employee_fid']=$producer_employeeEntityObject->FindAll(new QueryLogic());
		$executor_employeeEntityObject=new iribfinance_employeeEntity($DBAccessor);
		$result['executor_employee_fid']=$executor_employeeEntityObject->FindAll(new QueryLogic());
		$paycenterEntityObject=new iribfinance_paycenterEntity($DBAccessor);
		$result['paycenter_fid']=$paycenterEntityObject->FindAll(new QueryLogic());
		$makergroup_paycenterEntityObject=new iribfinance_paycenterEntity($DBAccessor);
		$result['makergroup_paycenter_fid']=$makergroup_paycenterEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('programestimation_fid',$ID));
		$result['programestimation']=$programestimationEntityObject;
		if($ID!=-1){
			$programestimationEntityObject->setId($ID);
			if($programestimationEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $programestimationEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['programestimation']=$programestimationEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$department_fid,$class_fid,$programmaketype_fid,$totalprogramcount,$timeperprogram,$is_haslegalproblem,$approval_date,$end_date,$add_date,$producer_employee_fid,$executor_employee_fid,$paycenter_fid,$makergroup_paycenter_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$programestimationEntityObject=new iribfinance_programestimationEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$department_fid,$class_fid,$programmaketype_fid,$totalprogramcount,$timeperprogram,$is_haslegalproblem,$approval_date,$end_date,$add_date,$producer_employee_fid,$executor_employee_fid,$paycenter_fid,$makergroup_paycenter_fid],[$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$TITLE),$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$DEPARTMENT_FID),$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$CLASS_FID),$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$PROGRAMMAKETYPE_FID),$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$TOTALPROGRAMCOUNT),$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$TIMEPERPROGRAM),$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$IS_HASLEGALPROBLEM),$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$APPROVAL_DATE),$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$END_DATE),$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$ADD_DATE),$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$PRODUCER_EMPLOYEE_FID),$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$EXECUTOR_EMPLOYEE_FID),$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$PAYCENTER_FID),$programestimationEntityObject->getFieldInfo(iribfinance_programestimationEntity::$MAKERGROUP_PAYCENTER_FID)]);
		if($ID==-1){
			$programestimationEntityObject->setTitle($title);
			$programestimationEntityObject->setDepartment_fid($department_fid);
			$programestimationEntityObject->setClass_fid($class_fid);
			$programestimationEntityObject->setProgrammaketype_fid($programmaketype_fid);
			$programestimationEntityObject->setTotalprogramcount($totalprogramcount);
			$programestimationEntityObject->setTimeperprogram($timeperprogram);
			$programestimationEntityObject->setIs_haslegalproblem($is_haslegalproblem);
			$programestimationEntityObject->setApproval_date($approval_date);
			$programestimationEntityObject->setEnd_date($end_date);
			$programestimationEntityObject->setAdd_date($add_date);
			$programestimationEntityObject->setProducer_employee_fid($producer_employee_fid);
			$programestimationEntityObject->setExecutor_employee_fid($executor_employee_fid);
			$programestimationEntityObject->setPaycenter_fid($paycenter_fid);
			$programestimationEntityObject->setMakergroup_paycenter_fid($makergroup_paycenter_fid);
			$programestimationEntityObject->Save();
			$ID=$programestimationEntityObject->getId();
		}
		else{
			$programestimationEntityObject->setId($ID);
			if($programestimationEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $programestimationEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$programestimationEntityObject->setTitle($title);
			$programestimationEntityObject->setDepartment_fid($department_fid);
			$programestimationEntityObject->setClass_fid($class_fid);
			$programestimationEntityObject->setProgrammaketype_fid($programmaketype_fid);
			$programestimationEntityObject->setTotalprogramcount($totalprogramcount);
			$programestimationEntityObject->setTimeperprogram($timeperprogram);
			$programestimationEntityObject->setIs_haslegalproblem($is_haslegalproblem);
			$programestimationEntityObject->setApproval_date($approval_date);
			$programestimationEntityObject->setEnd_date($end_date);
			$programestimationEntityObject->setAdd_date($add_date);
			$programestimationEntityObject->setProducer_employee_fid($producer_employee_fid);
			$programestimationEntityObject->setExecutor_employee_fid($executor_employee_fid);
			$programestimationEntityObject->setPaycenter_fid($paycenter_fid);
			$programestimationEntityObject->setMakergroup_paycenter_fid($makergroup_paycenter_fid);
			$programestimationEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('programestimation_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>