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
class programestimationController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$programestimationEntityObject=new iribfinance_programestimationEntity($DBAccessor);
		$result['programestimation']=$programestimationEntityObject;
		if($ID!=-1){
			$programestimationEntityObject->setId($ID);
			if($programestimationEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['programestimation']=$programestimationEntityObject;
			$departmentEntityObject=new iribfinance_departmentEntity($DBAccessor);
			$departmentEntityObject->SetId($result['programestimation']->getDepartment_fid());
			if($departmentEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['department_fid']=$departmentEntityObject;
			$classEntityObject=new iribfinance_classEntity($DBAccessor);
			$classEntityObject->SetId($result['programestimation']->getClass_fid());
			if($classEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['class_fid']=$classEntityObject;
			$programmaketypeEntityObject=new iribfinance_programmaketypeEntity($DBAccessor);
			$programmaketypeEntityObject->SetId($result['programestimation']->getProgrammaketype_fid());
			if($programmaketypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['programmaketype_fid']=$programmaketypeEntityObject;
			$producer_employeeEntityObject=new iribfinance_employeeEntity($DBAccessor);
			$producer_employeeEntityObject->SetId($result['programestimation']->getProducer_employee_fid());
			if($producer_employeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['producer_employee_fid']=$producer_employeeEntityObject;
			$executor_employeeEntityObject=new iribfinance_employeeEntity($DBAccessor);
			$executor_employeeEntityObject->SetId($result['programestimation']->getExecutor_employee_fid());
			if($executor_employeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['executor_employee_fid']=$executor_employeeEntityObject;
			$paycenterEntityObject=new iribfinance_paycenterEntity($DBAccessor);
			$paycenterEntityObject->SetId($result['programestimation']->getPaycenter_fid());
			if($paycenterEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['paycenter_fid']=$paycenterEntityObject;
			$makergroup_paycenterEntityObject=new iribfinance_paycenterEntity($DBAccessor);
			$makergroup_paycenterEntityObject->SetId($result['programestimation']->getMakergroup_paycenter_fid());
			if($makergroup_paycenterEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['makergroup_paycenter_fid']=$makergroup_paycenterEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>