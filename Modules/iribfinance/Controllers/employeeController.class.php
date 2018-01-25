<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\common\Entity\common_cityEntity;
use Modules\iribfinance\Entity\iribfinance_bankEntity;
use Modules\iribfinance\Entity\iribfinance_employmenttypeEntity;
use Modules\iribfinance\Entity\iribfinance_nationalityEntity;
use Modules\iribfinance\Entity\iribfinance_paycenterEntity;
use Modules\iribfinance\Entity\iribfinance_roleEntity;
use Modules\iribfinance\Entity\iribfinance_visatypeEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_employeeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:01
*@lastUpdate 1396-11-05 - 2018-01-25 18:01
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class employeeController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$employeeEntityObject=new iribfinance_employeeEntity($DBAccessor);
		$result['employee']=$employeeEntityObject;
		if($ID!=-1){
			$employeeEntityObject->setId($ID);
			if($employeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['employee']=$employeeEntityObject;
			$roleEntityObject=new iribfinance_roleEntity($DBAccessor);
			$roleEntityObject->SetId($result['employee']->getRole_fid());
			if($roleEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['role_fid']=$roleEntityObject;
			$nationalityEntityObject=new iribfinance_nationalityEntity($DBAccessor);
			$nationalityEntityObject->SetId($result['employee']->getNationality_fid());
			if($nationalityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['nationality_fid']=$nationalityEntityObject;
			$paycenterEntityObject=new iribfinance_paycenterEntity($DBAccessor);
			$paycenterEntityObject->SetId($result['employee']->getPaycenter_fid());
			if($paycenterEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['paycenter_fid']=$paycenterEntityObject;
			$employmenttypeEntityObject=new iribfinance_employmenttypeEntity($DBAccessor);
			$employmenttypeEntityObject->SetId($result['employee']->getEmploymenttype_fid());
			if($employmenttypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['employmenttype_fid']=$employmenttypeEntityObject;
			$common_cityEntityObject=new common_cityEntity($DBAccessor);
			$common_cityEntityObject->SetId($result['employee']->getCommon_city_fid());
			if($common_cityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['common_city_fid']=$common_cityEntityObject;
			$bankEntityObject=new iribfinance_bankEntity($DBAccessor);
			$bankEntityObject->SetId($result['employee']->getBank_fid());
			if($bankEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['bank_fid']=$bankEntityObject;
			$visatypeEntityObject=new iribfinance_visatypeEntity($DBAccessor);
			$visatypeEntityObject->SetId($result['employee']->getVisatype_fid());
			if($visatypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['visatype_fid']=$visatypeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>