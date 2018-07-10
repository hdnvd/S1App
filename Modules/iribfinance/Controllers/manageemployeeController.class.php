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
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageemployeeController extends Controller {
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
		$employeeEntityObject=new iribfinance_employeeEntity($DBAccessor);
		$roleEntityObject=new iribfinance_roleEntity($DBAccessor);
		$result['role_fid']=$roleEntityObject->FindAll(new QueryLogic());
		$nationalityEntityObject=new iribfinance_nationalityEntity($DBAccessor);
		$result['nationality_fid']=$nationalityEntityObject->FindAll(new QueryLogic());
		$paycenterEntityObject=new iribfinance_paycenterEntity($DBAccessor);
		$result['paycenter_fid']=$paycenterEntityObject->FindAll(new QueryLogic());
		$employmenttypeEntityObject=new iribfinance_employmenttypeEntity($DBAccessor);
		$result['employmenttype_fid']=$employmenttypeEntityObject->FindAll(new QueryLogic());
		$common_cityEntityObject=new common_cityEntity($DBAccessor);
		$result['common_city_fid']=$common_cityEntityObject->FindAll(new QueryLogic());
		$bankEntityObject=new iribfinance_bankEntity($DBAccessor);
		$result['bank_fid']=$bankEntityObject->FindAll(new QueryLogic());
		$visatypeEntityObject=new iribfinance_visatypeEntity($DBAccessor);
		$result['visatype_fid']=$visatypeEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('employee_fid',$ID));
		$result['employee']=$employeeEntityObject;
		if($ID!=-1){
			$employeeEntityObject->setId($ID);
			if($employeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $employeeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['employee']=$employeeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$name,$family,$fathername,$ismale,$mellicode,$shsh,$shshserial,$personelcode,$employmentcode,$role_fid,$nationality_fid,$paycenter_fid,$employmenttype_fid,$born_date,$childcount,$ismarried,$mobile,$tel,$address,$zipcode,$common_city_fid,$accountnumber,$cardnumber,$bank_fid,$is_neededinsurance,$is_payabale,$passportnumber,$passportserial,$education,$entrance_date,$visatype_fid,$visaexpire_date)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$employeeEntityObject=new iribfinance_employeeEntity($DBAccessor);
		$this->ValidateFieldArray([$name,$family,$fathername,$ismale,$mellicode,$shsh,$shshserial,$personelcode,$employmentcode,$role_fid,$nationality_fid,$paycenter_fid,$employmenttype_fid,$born_date,$childcount,$ismarried,$mobile,$tel,$address,$zipcode,$common_city_fid,$accountnumber,$cardnumber,$bank_fid,$is_neededinsurance,$is_payabale,$passportnumber,$passportserial,$education,$entrance_date,$visatype_fid,$visaexpire_date],[$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$NAME),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$FAMILY),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$FATHERNAME),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$ISMALE),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$MELLICODE),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$SHSH),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$SHSHSERIAL),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$PERSONELCODE),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$EMPLOYMENTCODE),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$ROLE_FID),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$NATIONALITY_FID),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$PAYCENTER_FID),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$EMPLOYMENTTYPE_FID),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$BORN_DATE),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$CHILDCOUNT),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$ISMARRIED),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$MOBILE),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$TEL),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$ADDRESS),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$ZIPCODE),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$COMMON_CITY_FID),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$ACCOUNTNUMBER),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$CARDNUMBER),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$BANK_FID),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$IS_NEEDEDINSURANCE),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$IS_PAYABALE),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$PASSPORTNUMBER),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$PASSPORTSERIAL),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$EDUCATION),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$ENTRANCE_DATE),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$VISATYPE_FID),$employeeEntityObject->getFieldInfo(iribfinance_employeeEntity::$VISAEXPIRE_DATE)]);
		if($ID==-1){
			$employeeEntityObject->setName($name);
			$employeeEntityObject->setFamily($family);
			$employeeEntityObject->setFathername($fathername);
			$employeeEntityObject->setIsmale($ismale);
			$employeeEntityObject->setMellicode($mellicode);
			$employeeEntityObject->setShsh($shsh);
			$employeeEntityObject->setShshserial($shshserial);
			$employeeEntityObject->setPersonelcode($personelcode);
			$employeeEntityObject->setEmploymentcode($employmentcode);
			$employeeEntityObject->setRole_fid($role_fid);
			$employeeEntityObject->setNationality_fid($nationality_fid);
			$employeeEntityObject->setPaycenter_fid($paycenter_fid);
			$employeeEntityObject->setEmploymenttype_fid($employmenttype_fid);
			$employeeEntityObject->setBorn_date($born_date);
			$employeeEntityObject->setChildcount($childcount);
			$employeeEntityObject->setIsmarried($ismarried);
			$employeeEntityObject->setMobile($mobile);
			$employeeEntityObject->setTel($tel);
			$employeeEntityObject->setAddress($address);
			$employeeEntityObject->setZipcode($zipcode);
			$employeeEntityObject->setCommon_city_fid($common_city_fid);
			$employeeEntityObject->setAccountnumber($accountnumber);
			$employeeEntityObject->setCardnumber($cardnumber);
			$employeeEntityObject->setBank_fid($bank_fid);
			$employeeEntityObject->setIs_neededinsurance($is_neededinsurance);
			$employeeEntityObject->setIs_payabale($is_payabale);
			$employeeEntityObject->setPassportnumber($passportnumber);
			$employeeEntityObject->setPassportserial($passportserial);
			$employeeEntityObject->setEducation($education);
			$employeeEntityObject->setEntrance_date($entrance_date);
			$employeeEntityObject->setVisatype_fid($visatype_fid);
			$employeeEntityObject->setVisaexpire_date($visaexpire_date);
			$employeeEntityObject->Save();
			$ID=$employeeEntityObject->getId();
		}
		else{
			$employeeEntityObject->setId($ID);
			if($employeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $employeeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$employeeEntityObject->setName($name);
			$employeeEntityObject->setFamily($family);
			$employeeEntityObject->setFathername($fathername);
			$employeeEntityObject->setIsmale($ismale);
			$employeeEntityObject->setMellicode($mellicode);
			$employeeEntityObject->setShsh($shsh);
			$employeeEntityObject->setShshserial($shshserial);
			$employeeEntityObject->setPersonelcode($personelcode);
			$employeeEntityObject->setEmploymentcode($employmentcode);
			$employeeEntityObject->setRole_fid($role_fid);
			$employeeEntityObject->setNationality_fid($nationality_fid);
			$employeeEntityObject->setPaycenter_fid($paycenter_fid);
			$employeeEntityObject->setEmploymenttype_fid($employmenttype_fid);
			$employeeEntityObject->setBorn_date($born_date);
			$employeeEntityObject->setChildcount($childcount);
			$employeeEntityObject->setIsmarried($ismarried);
			$employeeEntityObject->setMobile($mobile);
			$employeeEntityObject->setTel($tel);
			$employeeEntityObject->setAddress($address);
			$employeeEntityObject->setZipcode($zipcode);
			$employeeEntityObject->setCommon_city_fid($common_city_fid);
			$employeeEntityObject->setAccountnumber($accountnumber);
			$employeeEntityObject->setCardnumber($cardnumber);
			$employeeEntityObject->setBank_fid($bank_fid);
			$employeeEntityObject->setIs_neededinsurance($is_neededinsurance);
			$employeeEntityObject->setIs_payabale($is_payabale);
			$employeeEntityObject->setPassportnumber($passportnumber);
			$employeeEntityObject->setPassportserial($passportserial);
			$employeeEntityObject->setEducation($education);
			$employeeEntityObject->setEntrance_date($entrance_date);
			$employeeEntityObject->setVisatype_fid($visatype_fid);
			$employeeEntityObject->setVisaexpire_date($visaexpire_date);
			$employeeEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('employee_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>