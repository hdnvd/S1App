<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
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
*@creationDate 1396-11-05 - 2018-01-25 18:01
*@lastUpdate 1396-11-05 - 2018-01-25 18:01
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class programestimationemployeeController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$programestimationemployeeEntityObject=new iribfinance_programestimationemployeeEntity($DBAccessor);
		$result['programestimationemployee']=$programestimationemployeeEntityObject;
		if($ID!=-1){
			$programestimationemployeeEntityObject->setId($ID);
			if($programestimationemployeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['programestimationemployee']=$programestimationemployeeEntityObject;
			$employeeEntityObject=new iribfinance_employeeEntity($DBAccessor);
			$employeeEntityObject->SetId($result['programestimationemployee']->getEmployee_fid());
			if($employeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['employee_fid']=$employeeEntityObject;
			$programestimationEntityObject=new iribfinance_programestimationEntity($DBAccessor);
			$programestimationEntityObject->SetId($result['programestimationemployee']->getProgramestimation_fid());
			if($programestimationEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['programestimation_fid']=$programestimationEntityObject;
			$employmenttypeEntityObject=new iribfinance_employmenttypeEntity($DBAccessor);
			$employmenttypeEntityObject->SetId($result['programestimationemployee']->getEmploymenttype_fid());
			if($employmenttypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['employmenttype_fid']=$employmenttypeEntityObject;
			$workunitEntityObject=new iribfinance_workunitEntity($DBAccessor);
			$workunitEntityObject->SetId($result['programestimationemployee']->getWorkunit_fid());
			if($workunitEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['workunit_fid']=$workunitEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>