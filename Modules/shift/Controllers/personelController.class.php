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
use Modules\shift\Entity\shift_personelEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-27 - 2018-01-17 15:25
*@lastUpdate 1396-10-27 - 2018-01-17 15:25
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class personelController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$personelEntityObject=new shift_personelEntity($DBAccessor);
		$result['personel']=$personelEntityObject;
		if($ID!=-1){
			$personelEntityObject->setId($ID);
			if($personelEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['personel']=$personelEntityObject;
			$bakhshEntityObject=new shift_bakhshEntity($DBAccessor);
			$bakhshEntityObject->SetId($result['personel']->getBakhsh_fid());
			if($bakhshEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['bakhsh_fid']=$bakhshEntityObject;
			$madrakEntityObject=new shift_madrakEntity($DBAccessor);
			$madrakEntityObject->SetId($result['personel']->getMadrak_fid());
			if($madrakEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['madrak_fid']=$madrakEntityObject;
			$eshteghalEntityObject=new shift_eshteghalEntity($DBAccessor);
			$eshteghalEntityObject->SetId($result['personel']->getEshteghal_fid());
			if($eshteghalEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['eshteghal_fid']=$eshteghalEntityObject;
			$sematEntityObject=new shift_sematEntity($DBAccessor);
			$sematEntityObject->SetId($result['personel']->getSemat_fid());
			if($sematEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['semat_fid']=$sematEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>