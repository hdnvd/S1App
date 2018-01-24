<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\common\Entity\common_cityEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\ocms\Entity\ocms_specialityEntity;
use Modules\users\Entity\roleSystemRoleEntity;
use Modules\users\Entity\roleSystemUserEntity;
use Modules\users\Entity\RoleSystemUserRoleEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_doctorEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedoctorController extends Controller {
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
		$doctorEntityObject=new ocms_doctorEntity($DBAccessor);
		$specialityEntityObject=new ocms_specialityEntity($DBAccessor);
		$result['speciality_fid']=$specialityEntityObject->FindAll(new QueryLogic());
		$common_cityEntityObject=new common_cityEntity($DBAccessor);
		$result['common_city_fid']=$common_cityEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('doctor_fid',$ID));
		$result['doctor']=$doctorEntityObject;
		if($ID!=-1){
			$doctorEntityObject->setId($ID);
			if($doctorEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $doctorEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['doctor']=$doctorEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$name,$family,$nezam_code,$mellicode,$mobile,$email,$tel,$ismale,$speciality_fid,$education,$matabtel,$matabaddress,$longitude,$latitude,$common_city_fid,$isactiveonphone,$isactiveonplace,$isactiveonhome,$photo_flu,$price,$user,$pass)
	{
//	    echo "Price;" . $price;
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$doctorEntityObject=new ocms_doctorEntity($DBAccessor);
		$photo_fluURL='';
		if($photo_flu!=null && count($photo_flu)>0)
			$photo_fluURL=$photo_flu[0]['url'];
		$this->ValidateFieldArray([$name,$family,$nezam_code,$mellicode,$mobile,$email,$tel,$ismale,$speciality_fid,$education,$matabtel,$matabaddress,$longitude,$latitude,$common_city_fid,$isactiveonphone,$isactiveonplace,$isactiveonhome,$photo_fluURL],[$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$NAME),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$FAMILY),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$NEZAM_CODE),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$MELLICODE),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$MOBILE),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$EMAIL),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$TEL),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$ISMALE),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$SPECIALITY_FID),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$EDUCATION),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$MATABTEL),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$MATABADDRESS),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$LONGITUDE),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$LATITUDE),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$COMMON_CITY_FID),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$ISACTIVEONPHONE),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$ISACTIVEONPLACE),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$ISACTIVEONHOME),$doctorEntityObject->getFieldInfo(ocms_doctorEntity::$PHOTO_FLU)]);
		if($ID==-1){
			$doctorEntityObject->setName($name);
			$doctorEntityObject->setFamily($family);
			$doctorEntityObject->setNezam_code($nezam_code);
			$doctorEntityObject->setMellicode($mellicode);
			$doctorEntityObject->setMobile($mobile);
			$doctorEntityObject->setEmail($email);
			$doctorEntityObject->setTel($tel);
			$doctorEntityObject->setIsmale($ismale);
			$doctorEntityObject->setSpeciality_fid($speciality_fid);
			$doctorEntityObject->setEducation($education);
			$doctorEntityObject->setMatabtel($matabtel);
			$doctorEntityObject->setMatabaddress($matabaddress);
			$doctorEntityObject->setLongitude($longitude);
			$doctorEntityObject->setLatitude($latitude);
			$doctorEntityObject->setCommon_city_fid($common_city_fid);
			$doctorEntityObject->setIsactiveonphone($isactiveonphone);
            $doctorEntityObject->setIsactiveonplace($isactiveonplace);
			$doctorEntityObject->setIsactiveonhome($isactiveonhome);
            $doctorEntityObject->setPrice($price);

			$uEnt=new roleSystemUserEntity($DBAccessor);
			$userid=$uEnt->Add($user,$pass);
			$role=new RoleSystemUserRoleEntity();
			$role->addUserRole($userid,3);
            $doctorEntityObject->setRole_systemuser_fid($userid);
			if($photo_fluURL!='')
			$doctorEntityObject->setPhoto_flu($photo_fluURL);
			$doctorEntityObject->Save();
			$ID=$doctorEntityObject->getId();

		}
		else{
			$doctorEntityObject->setId($ID);
			if($doctorEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if(strlen(trim($pass))>1)
            {
                $userid=$doctorEntityObject->getRole_systemuser_fid();
                $uEnt=new roleSystemUserEntity($DBAccessor);
                $uEnt->Update($userid,null,$pass,$pass,-1);
            }

			$doctorEntityObject->setName($name);
			$doctorEntityObject->setFamily($family);
			$doctorEntityObject->setNezam_code($nezam_code);
			$doctorEntityObject->setMellicode($mellicode);
			$doctorEntityObject->setMobile($mobile);
			$doctorEntityObject->setEmail($email);
			$doctorEntityObject->setTel($tel);
			$doctorEntityObject->setIsmale($ismale);
			$doctorEntityObject->setSpeciality_fid($speciality_fid);
			$doctorEntityObject->setEducation($education);
			$doctorEntityObject->setMatabtel($matabtel);
			$doctorEntityObject->setMatabaddress($matabaddress);
			$doctorEntityObject->setLongitude($longitude);
			$doctorEntityObject->setLatitude($latitude);
			$doctorEntityObject->setCommon_city_fid($common_city_fid);
			$doctorEntityObject->setIsactiveonphone($isactiveonphone);
			$doctorEntityObject->setIsactiveonplace($isactiveonplace);
			$doctorEntityObject->setIsactiveonhome($isactiveonhome);
            $doctorEntityObject->setPrice($price);
			if($photo_fluURL!='')
			$doctorEntityObject->setPhoto_flu($photo_fluURL);
			$doctorEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('doctor_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>