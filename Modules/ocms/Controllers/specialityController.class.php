<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_specialityEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-30 - 2017-12-21 18:36
*@lastUpdate 1396-09-30 - 2017-12-21 18:36
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class specialityController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$specialityEntityObject=new ocms_specialityEntity($DBAccessor);
		$result['speciality']=$specialityEntityObject;
		if($ID!=-1){
			$specialityEntityObject->setId($ID);
			if($specialityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['speciality']=$specialityEntityObject;
			$specialityEntityObject=new ocms_specialityEntity($DBAccessor);
			$specialityEntityObject->SetId($result['speciality']->getSpeciality_fid());
			if($specialityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['speciality_fid']=$specialityEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>