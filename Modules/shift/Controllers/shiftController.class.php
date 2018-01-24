<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_shiftEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-27 - 2018-01-17 00:25
*@lastUpdate 1396-10-27 - 2018-01-17 00:25
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class shiftController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$shiftEntityObject=new shift_shiftEntity($DBAccessor);
		$result['shift']=$shiftEntityObject;
		if($ID!=-1){
			$shiftEntityObject->setId($ID);
			if($shiftEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['shift']=$shiftEntityObject;
			$personEntityObject=new shift_personEntity($DBAccessor);
			$personEntityObject->SetId($result['shift']->getPerson_fid());
			if($personEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['person_fid']=$personEntityObject;
			$inputfileEntityObject=new shift_inputfileEntity($DBAccessor);
			$inputfileEntityObject->SetId($result['shift']->getInputfile_fid());
			if($inputfileEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['inputfile_fid']=$inputfileEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>