<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\shift\Entity\shift_bakhshEntity;
use Modules\shift\Entity\shift_inputfileEntity;
use Modules\shift\Entity\shift_personelEntity;
use Modules\shift\Entity\shift_roleEntity;
use Modules\shift\Entity\shift_shifttypeEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_shiftEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 00:33
*@lastUpdate 1396-11-05 - 2018-01-25 00:33
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
			$shifttypeEntityObject=new shift_shifttypeEntity($DBAccessor);
			$shifttypeEntityObject->SetId($result['shift']->getShifttype_fid());
			if($shifttypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['shifttype_fid']=$shifttypeEntityObject;
			$personelEntityObject=new shift_personelEntity($DBAccessor);
			$personelEntityObject->SetId($result['shift']->getPersonel_fid());
			if($personelEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['personel_fid']=$personelEntityObject;
			$bakhshEntityObject=new shift_bakhshEntity($DBAccessor);
			$bakhshEntityObject->SetId($result['shift']->getBakhsh_fid());
			if($bakhshEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['bakhsh_fid']=$bakhshEntityObject;
			$roleEntityObject=new shift_roleEntity($DBAccessor);
			$roleEntityObject->SetId($result['shift']->getRole_fid());
			if($roleEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['role_fid']=$roleEntityObject;
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