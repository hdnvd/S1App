<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\common\Entity\common_cityEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\ocms\Entity\ocms_specialityEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_doctorEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-08 - 2017-12-29 12:54
*@lastUpdate 1396-10-08 - 2017-12-29 12:54
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class doctorController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$doctorEntityObject=new ocms_doctorEntity($DBAccessor);
		$result['doctor']=$doctorEntityObject;
		if($ID!=-1){
			$doctorEntityObject->setId($ID);
			if($doctorEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['doctor']=$doctorEntityObject;
			$specialityEntityObject=new ocms_specialityEntity($DBAccessor);
			$specialityEntityObject->SetId($result['doctor']->getSpeciality_fid());
			if($specialityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['speciality_fid']=$specialityEntityObject;
			$common_cityEntityObject=new common_cityEntity($DBAccessor);
			$common_cityEntityObject->SetId($result['doctor']->getCommon_city_fid());
			if($common_cityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['common_city_fid']=$common_cityEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>