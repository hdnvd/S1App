<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\iribfinance\Entity\iribfinance_activityEntity;
use Modules\iribfinance\Entity\iribfinance_employeeEntity;
use Modules\iribfinance\Entity\iribfinance_employmenttypeEntity;
use Modules\iribfinance\Entity\iribfinance_programestimationEntity;
use Modules\iribfinance\Entity\iribfinance_workunitEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_programestimationemployeeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 20:01
*@lastUpdate 1396-11-05 - 2018-01-25 20:01
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageprogramestimationemployeeController extends Controller {
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
		$programestimationemployeeEntityObject=new iribfinance_programestimationemployeeEntity($DBAccessor);
		$employeeEntityObject=new iribfinance_employeeEntity($DBAccessor);
		$result['employee_fid']=$employeeEntityObject->FindAll(new QueryLogic());
		$activityEntityObject=new iribfinance_activityEntity($DBAccessor);
		$result['activity_fid']=$activityEntityObject->FindAll(new QueryLogic());
		$programestimationEntityObject=new iribfinance_programestimationEntity($DBAccessor);
		$result['programestimation_fid']=$programestimationEntityObject->FindAll(new QueryLogic());
		$employmenttypeEntityObject=new iribfinance_employmenttypeEntity($DBAccessor);
		$result['employmenttype_fid']=$employmenttypeEntityObject->FindAll(new QueryLogic());
		$workunitEntityObject=new iribfinance_workunitEntity($DBAccessor);
		$result['workunit_fid']=$workunitEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('programestimationemployee_fid',$ID));
		$result['programestimationemployee']=$programestimationemployeeEntityObject;
		if($ID!=-1){
			$programestimationemployeeEntityObject->setId($ID);
			if($programestimationemployeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $programestimationemployeeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['programestimationemployee']=$programestimationemployeeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$employee_fid,$activity_fid,$programestimation_fid,$employmenttype_fid,$totalwork,$workunit_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$programestimationemployeeEntityObject=new iribfinance_programestimationemployeeEntity($DBAccessor);
		$this->ValidateFieldArray([$employee_fid,$activity_fid,$programestimation_fid,$employmenttype_fid,$totalwork,$workunit_fid],[$programestimationemployeeEntityObject->getFieldInfo(iribfinance_programestimationemployeeEntity::$EMPLOYEE_FID),$programestimationemployeeEntityObject->getFieldInfo(iribfinance_programestimationemployeeEntity::$ACTIVITY_FID),$programestimationemployeeEntityObject->getFieldInfo(iribfinance_programestimationemployeeEntity::$PROGRAMESTIMATION_FID),$programestimationemployeeEntityObject->getFieldInfo(iribfinance_programestimationemployeeEntity::$EMPLOYMENTTYPE_FID),$programestimationemployeeEntityObject->getFieldInfo(iribfinance_programestimationemployeeEntity::$TOTALWORK),$programestimationemployeeEntityObject->getFieldInfo(iribfinance_programestimationemployeeEntity::$WORKUNIT_FID)]);
		if($ID==-1){
			$programestimationemployeeEntityObject->setEmployee_fid($employee_fid);
			$programestimationemployeeEntityObject->setActivity_fid($activity_fid);
			$programestimationemployeeEntityObject->setProgramestimation_fid($programestimation_fid);
			$programestimationemployeeEntityObject->setEmploymenttype_fid($employmenttype_fid);
			$programestimationemployeeEntityObject->setTotalwork($totalwork);
			$programestimationemployeeEntityObject->setWorkunit_fid($workunit_fid);
			$programestimationemployeeEntityObject->Save();
			$ID=$programestimationemployeeEntityObject->getId();
		}
		else{
			$programestimationemployeeEntityObject->setId($ID);
			if($programestimationemployeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $programestimationemployeeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$programestimationemployeeEntityObject->setEmployee_fid($employee_fid);
			$programestimationemployeeEntityObject->setActivity_fid($activity_fid);
			$programestimationemployeeEntityObject->setProgramestimation_fid($programestimation_fid);
			$programestimationemployeeEntityObject->setEmploymenttype_fid($employmenttype_fid);
			$programestimationemployeeEntityObject->setTotalwork($totalwork);
			$programestimationemployeeEntityObject->setWorkunit_fid($workunit_fid);
			$programestimationemployeeEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('programestimationemployee_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>