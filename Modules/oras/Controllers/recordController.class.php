<?php
namespace Modules\oras\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\oras\Entity\oras_recordEntity;
use Modules\oras\Entity\oras_shifttypeEntity;
use Modules\oras\Entity\oras_recordtypeEntity;
use Modules\oras\Entity\oras_employeeEntity;
use Modules\oras\Entity\oras_placeEntity;
use Modules\oras\Entity\oras_file1Entity;
use Modules\oras\Entity\oras_file2Entity;
use Modules\oras\Entity\oras_file3Entity;
use Modules\oras\Entity\oras_file4Entity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 03:03
*@lastUpdate 1396-07-12 - 2017-10-04 03:03
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class recordController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$recordEntityObject=new oras_recordEntity($DBAccessor);
		$result['record']=$recordEntityObject;
		if($ID!=-1){
			$recordEntityObject->setId($ID);
			if($recordEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['record']=$recordEntityObject;
			$shifttypeEntityObject=new oras_shifttypeEntity($DBAccessor);
			$shifttypeEntityObject->SetId($result['record']->getShifttype_fid());
			if($shifttypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['shifttype_fid']=$shifttypeEntityObject;
			$recordtypeEntityObject=new oras_recordtypeEntity($DBAccessor);
			$recordtypeEntityObject->SetId($result['record']->getRecordtype_fid());
			if($recordtypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['recordtype_fid']=$recordtypeEntityObject;
			$employeeEntityObject=new oras_employeeEntity($DBAccessor);
			$employeeEntityObject->SetId($result['record']->getEmployee_fid());
			$result['employee_fid']=$employeeEntityObject;
			$placeEntityObject=new oras_placeEntity($DBAccessor);
			$placeEntityObject->SetId($result['record']->getPlace_fid());
			$result['place_fid']=$placeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>