<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\shift\Entity\shift_bakhshEntity;
use Modules\shift\Entity\shift_eshteghalEntity;
use Modules\shift\Entity\shift_madrakEntity;
use Modules\shift\Entity\shift_roleEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_personelEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-28 - 2018-01-18 17:32
*@lastUpdate 1396-10-28 - 2018-01-18 17:32
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managepersonelController extends Controller {
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
		$personelEntityObject=new shift_personelEntity($DBAccessor);
		$bakhshEntityObject=new shift_bakhshEntity($DBAccessor);
		$result['bakhsh_fid']=$bakhshEntityObject->FindAll(new QueryLogic());
		$madrakEntityObject=new shift_madrakEntity($DBAccessor);
		$result['madrak_fid']=$madrakEntityObject->FindAll(new QueryLogic());
		$eshteghalEntityObject=new shift_eshteghalEntity($DBAccessor);
		$result['eshteghal_fid']=$eshteghalEntityObject->FindAll(new QueryLogic());
		$roleEntityObject=new shift_roleEntity($DBAccessor);
		$result['role_fid']=$roleEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('personel_fid',$ID));
		$result['personel']=$personelEntityObject;
		if($ID!=-1){
			$personelEntityObject->setId($ID);
			if($personelEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $personelEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['personel']=$personelEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$childcount,$address,$fathername,$priority,$employment_date,$personelcode,$sanavat,$shhesab,$bakhsh_fid,$madrak_fid,$name,$family,$tel,$born_date,$is_male,$extrasanavat,$monthsanavat,$eshteghal_fid,$zarib,$role_fid,$shsh,$computercode,$mellicode,$is_married)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$personelEntityObject=new shift_personelEntity($DBAccessor);
		$this->ValidateFieldArray([$childcount,$address,$fathername,$priority,$employment_date,$personelcode,$sanavat,$shhesab,$bakhsh_fid,$madrak_fid,$name,$family,$tel,$born_date,$is_male,$extrasanavat,$monthsanavat,$eshteghal_fid,$zarib,$role_fid,$shsh,$computercode,$mellicode,$is_married],[$personelEntityObject->getFieldInfo(shift_personelEntity::$CHILDCOUNT),$personelEntityObject->getFieldInfo(shift_personelEntity::$ADDRESS),$personelEntityObject->getFieldInfo(shift_personelEntity::$FATHERNAME),$personelEntityObject->getFieldInfo(shift_personelEntity::$PRIORITY),$personelEntityObject->getFieldInfo(shift_personelEntity::$EMPLOYMENT_DATE),$personelEntityObject->getFieldInfo(shift_personelEntity::$PERSONELCODE),$personelEntityObject->getFieldInfo(shift_personelEntity::$SANAVAT),$personelEntityObject->getFieldInfo(shift_personelEntity::$SHHESAB),$personelEntityObject->getFieldInfo(shift_personelEntity::$BAKHSH_FID),$personelEntityObject->getFieldInfo(shift_personelEntity::$MADRAK_FID),$personelEntityObject->getFieldInfo(shift_personelEntity::$NAME),$personelEntityObject->getFieldInfo(shift_personelEntity::$FAMILY),$personelEntityObject->getFieldInfo(shift_personelEntity::$TEL),$personelEntityObject->getFieldInfo(shift_personelEntity::$BORN_DATE),$personelEntityObject->getFieldInfo(shift_personelEntity::$IS_MALE),$personelEntityObject->getFieldInfo(shift_personelEntity::$EXTRASANAVAT),$personelEntityObject->getFieldInfo(shift_personelEntity::$MONTHSANAVAT),$personelEntityObject->getFieldInfo(shift_personelEntity::$ESHTEGHAL_FID),$personelEntityObject->getFieldInfo(shift_personelEntity::$ZARIB),$personelEntityObject->getFieldInfo(shift_personelEntity::$ROLE_FID),$personelEntityObject->getFieldInfo(shift_personelEntity::$SHSH),$personelEntityObject->getFieldInfo(shift_personelEntity::$COMPUTERCODE),$personelEntityObject->getFieldInfo(shift_personelEntity::$MELLICODE),$personelEntityObject->getFieldInfo(shift_personelEntity::$IS_MARRIED)]);
		if($ID==-1){
			$personelEntityObject->setChildcount($childcount);
			$personelEntityObject->setAddress($address);
			$personelEntityObject->setFathername($fathername);
			$personelEntityObject->setPriority($priority);
			$personelEntityObject->setEmployment_date($employment_date);
			$personelEntityObject->setPersonelcode($personelcode);
			$personelEntityObject->setSanavat($sanavat);
			$personelEntityObject->setShhesab($shhesab);
			$personelEntityObject->setBakhsh_fid($bakhsh_fid);
			$personelEntityObject->setMadrak_fid($madrak_fid);
			$personelEntityObject->setName($name);
			$personelEntityObject->setFamily($family);
			$personelEntityObject->setTel($tel);
			$personelEntityObject->setBorn_date($born_date);
			$personelEntityObject->setIs_male($is_male);
			$personelEntityObject->setExtrasanavat($extrasanavat);
			$personelEntityObject->setMonthsanavat($monthsanavat);
			$personelEntityObject->setEshteghal_fid($eshteghal_fid);
			$personelEntityObject->setZarib($zarib);
			$personelEntityObject->setRole_fid($role_fid);
			$personelEntityObject->setShsh($shsh);
			$personelEntityObject->setComputercode($computercode);
			$personelEntityObject->setMellicode($mellicode);
			$personelEntityObject->setIs_married($is_married);
			$personelEntityObject->Save();
			$ID=$personelEntityObject->getId();
		}
		else{
			$personelEntityObject->setId($ID);
			if($personelEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $personelEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$personelEntityObject->setChildcount($childcount);
			$personelEntityObject->setAddress($address);
			$personelEntityObject->setFathername($fathername);
			$personelEntityObject->setPriority($priority);
			$personelEntityObject->setEmployment_date($employment_date);
			$personelEntityObject->setPersonelcode($personelcode);
			$personelEntityObject->setSanavat($sanavat);
			$personelEntityObject->setShhesab($shhesab);
			$personelEntityObject->setBakhsh_fid($bakhsh_fid);
			$personelEntityObject->setMadrak_fid($madrak_fid);
			$personelEntityObject->setName($name);
			$personelEntityObject->setFamily($family);
			$personelEntityObject->setTel($tel);
			$personelEntityObject->setBorn_date($born_date);
			$personelEntityObject->setIs_male($is_male);
			$personelEntityObject->setExtrasanavat($extrasanavat);
			$personelEntityObject->setMonthsanavat($monthsanavat);
			$personelEntityObject->setEshteghal_fid($eshteghal_fid);
			$personelEntityObject->setZarib($zarib);
			$personelEntityObject->setRole_fid($role_fid);
			$personelEntityObject->setShsh($shsh);
			$personelEntityObject->setComputercode($computercode);
			$personelEntityObject->setMellicode($mellicode);
			$personelEntityObject->setIs_married($is_married);
			$personelEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('personel_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>