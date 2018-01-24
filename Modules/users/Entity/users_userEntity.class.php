<?php
namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-03 - 2018-01-23 18:29
*@lastUpdate 1396-11-03 - 2018-01-23 18:29
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class users_userEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("users_user");
		$this->setTableTitle("users_user");
		$this->setTitleFieldName("family");

		/******** name ********/
		$NameInfo=new FieldInfo();
		$NameInfo->setTitle("name");
		$this->setFieldInfo(users_userEntity::$NAME,$NameInfo);
		$this->addTableField('1',users_userEntity::$NAME);

		/******** family ********/
		$FamilyInfo=new FieldInfo();
		$FamilyInfo->setTitle("family");
		$this->setFieldInfo(users_userEntity::$FAMILY,$FamilyInfo);
		$this->addTableField('2',users_userEntity::$FAMILY);

		/******** mail ********/
		$MailInfo=new FieldInfo();
		$MailInfo->setTitle("mail");
		$this->setFieldInfo(users_userEntity::$MAIL,$MailInfo);
		$this->addTableField('3',users_userEntity::$MAIL);

		/******** mobile ********/
		$MobileInfo=new FieldInfo();
		$MobileInfo->setTitle("mobile");
		$this->setFieldInfo(users_userEntity::$MOBILE,$MobileInfo);
		$this->addTableField('4',users_userEntity::$MOBILE);

		/******** ismale ********/
		$IsmaleInfo=new FieldInfo();
		$IsmaleInfo->setTitle("ismale");
		$this->setFieldInfo(users_userEntity::$ISMALE,$IsmaleInfo);
		$this->addTableField('5',users_userEntity::$ISMALE);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("role_systemuser_fid");
		$this->setFieldInfo(users_userEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('6',users_userEntity::$ROLE_SYSTEMUSER_FID);

		/******** profilepicture ********/
		$ProfilepictureInfo=new FieldInfo();
		$ProfilepictureInfo->setTitle("profilepicture");
		$this->setFieldInfo(users_userEntity::$PROFILEPICTURE,$ProfilepictureInfo);
		$this->addTableField('7',users_userEntity::$PROFILEPICTURE);

		/******** additionalfield1 ********/
		$Additionalfield1Info=new FieldInfo();
		$Additionalfield1Info->setTitle("additionalfield1");
		$this->setFieldInfo(users_userEntity::$ADDITIONALFIELD1,$Additionalfield1Info);
		$this->addTableField('8',users_userEntity::$ADDITIONALFIELD1);

		/******** additionalfield2 ********/
		$Additionalfield2Info=new FieldInfo();
		$Additionalfield2Info->setTitle("additionalfield2");
		$this->setFieldInfo(users_userEntity::$ADDITIONALFIELD2,$Additionalfield2Info);
		$this->addTableField('9',users_userEntity::$ADDITIONALFIELD2);

		/******** additionalfield3 ********/
		$Additionalfield3Info=new FieldInfo();
		$Additionalfield3Info->setTitle("additionalfield3");
		$this->setFieldInfo(users_userEntity::$ADDITIONALFIELD3,$Additionalfield3Info);
		$this->addTableField('10',users_userEntity::$ADDITIONALFIELD3);

		/******** additionalfield4 ********/
		$Additionalfield4Info=new FieldInfo();
		$Additionalfield4Info->setTitle("additionalfield4");
		$this->setFieldInfo(users_userEntity::$ADDITIONALFIELD4,$Additionalfield4Info);
		$this->addTableField('11',users_userEntity::$ADDITIONALFIELD4);

		/******** additionalfield5 ********/
		$Additionalfield5Info=new FieldInfo();
		$Additionalfield5Info->setTitle("additionalfield5");
		$this->setFieldInfo(users_userEntity::$ADDITIONALFIELD5,$Additionalfield5Info);
		$this->addTableField('12',users_userEntity::$ADDITIONALFIELD5);

		/******** additionalfield6 ********/
		$Additionalfield6Info=new FieldInfo();
		$Additionalfield6Info->setTitle("additionalfield6");
		$this->setFieldInfo(users_userEntity::$ADDITIONALFIELD6,$Additionalfield6Info);
		$this->addTableField('13',users_userEntity::$ADDITIONALFIELD6);

		/******** additionalfield7 ********/
		$Additionalfield7Info=new FieldInfo();
		$Additionalfield7Info->setTitle("additionalfield7");
		$this->setFieldInfo(users_userEntity::$ADDITIONALFIELD7,$Additionalfield7Info);
		$this->addTableField('14',users_userEntity::$ADDITIONALFIELD7);

		/******** additionalfield8 ********/
		$Additionalfield8Info=new FieldInfo();
		$Additionalfield8Info->setTitle("additionalfield8");
		$this->setFieldInfo(users_userEntity::$ADDITIONALFIELD8,$Additionalfield8Info);
		$this->addTableField('15',users_userEntity::$ADDITIONALFIELD8);

		/******** additionalfield9 ********/
		$Additionalfield9Info=new FieldInfo();
		$Additionalfield9Info->setTitle("additionalfield9");
		$this->setFieldInfo(users_userEntity::$ADDITIONALFIELD9,$Additionalfield9Info);
		$this->addTableField('16',users_userEntity::$ADDITIONALFIELD9);

		/******** signup_time ********/
		$Signup_timeInfo=new FieldInfo();
		$Signup_timeInfo->setTitle("signup_time");
		$this->setFieldInfo(users_userEntity::$SIGNUP_TIME,$Signup_timeInfo);
		$this->addTableField('17',users_userEntity::$SIGNUP_TIME);
	}
	public static $NAME="name";
	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->getField(users_userEntity::$NAME);
	}
	/**
	 * @param mixed $Name
	 */
	public function setName($Name){
		$this->setField(users_userEntity::$NAME,$Name);
	}
	public static $FAMILY="family";
	/**
	 * @return mixed
	 */
	public function getFamily(){
		return $this->getField(users_userEntity::$FAMILY);
	}
	/**
	 * @param mixed $Family
	 */
	public function setFamily($Family){
		$this->setField(users_userEntity::$FAMILY,$Family);
	}
	public static $MAIL="mail";
	/**
	 * @return mixed
	 */
	public function getMail(){
		return $this->getField(users_userEntity::$MAIL);
	}
	/**
	 * @param mixed $Mail
	 */
	public function setMail($Mail){
		$this->setField(users_userEntity::$MAIL,$Mail);
	}
	public static $MOBILE="mobile";
	/**
	 * @return mixed
	 */
	public function getMobile(){
		return $this->getField(users_userEntity::$MOBILE);
	}
	/**
	 * @param mixed $Mobile
	 */
	public function setMobile($Mobile){
		$this->setField(users_userEntity::$MOBILE,$Mobile);
	}
	public static $ISMALE="ismale";
	/**
	 * @return mixed
	 */
	public function getIsmale(){
		return $this->getField(users_userEntity::$ISMALE);
	}
	/**
	 * @param mixed $Ismale
	 */
	public function setIsmale($Ismale){
		$this->setField(users_userEntity::$ISMALE,$Ismale);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(users_userEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(users_userEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
	public static $PROFILEPICTURE="profilepicture";
	/**
	 * @return mixed
	 */
	public function getProfilepicture(){
		return $this->getField(users_userEntity::$PROFILEPICTURE);
	}
	/**
	 * @param mixed $Profilepicture
	 */
	public function setProfilepicture($Profilepicture){
		$this->setField(users_userEntity::$PROFILEPICTURE,$Profilepicture);
	}
	public static $ADDITIONALFIELD1="additionalfield1";
	/**
	 * @return mixed
	 */
	public function getAdditionalfield1(){
		return $this->getField(users_userEntity::$ADDITIONALFIELD1);
	}
	/**
	 * @param mixed $Additionalfield1
	 */
	public function setAdditionalfield1($Additionalfield1){
		$this->setField(users_userEntity::$ADDITIONALFIELD1,$Additionalfield1);
	}
	public static $ADDITIONALFIELD2="additionalfield2";
	/**
	 * @return mixed
	 */
	public function getAdditionalfield2(){
		return $this->getField(users_userEntity::$ADDITIONALFIELD2);
	}
	/**
	 * @param mixed $Additionalfield2
	 */
	public function setAdditionalfield2($Additionalfield2){
		$this->setField(users_userEntity::$ADDITIONALFIELD2,$Additionalfield2);
	}
	public static $ADDITIONALFIELD3="additionalfield3";
	/**
	 * @return mixed
	 */
	public function getAdditionalfield3(){
		return $this->getField(users_userEntity::$ADDITIONALFIELD3);
	}
	/**
	 * @param mixed $Additionalfield3
	 */
	public function setAdditionalfield3($Additionalfield3){
		$this->setField(users_userEntity::$ADDITIONALFIELD3,$Additionalfield3);
	}
	public static $ADDITIONALFIELD4="additionalfield4";
	/**
	 * @return mixed
	 */
	public function getAdditionalfield4(){
		return $this->getField(users_userEntity::$ADDITIONALFIELD4);
	}
	/**
	 * @param mixed $Additionalfield4
	 */
	public function setAdditionalfield4($Additionalfield4){
		$this->setField(users_userEntity::$ADDITIONALFIELD4,$Additionalfield4);
	}
	public static $ADDITIONALFIELD5="additionalfield5";
	/**
	 * @return mixed
	 */
	public function getAdditionalfield5(){
		return $this->getField(users_userEntity::$ADDITIONALFIELD5);
	}
	/**
	 * @param mixed $Additionalfield5
	 */
	public function setAdditionalfield5($Additionalfield5){
		$this->setField(users_userEntity::$ADDITIONALFIELD5,$Additionalfield5);
	}
	public static $ADDITIONALFIELD6="additionalfield6";
	/**
	 * @return mixed
	 */
	public function getAdditionalfield6(){
		return $this->getField(users_userEntity::$ADDITIONALFIELD6);
	}
	/**
	 * @param mixed $Additionalfield6
	 */
	public function setAdditionalfield6($Additionalfield6){
		$this->setField(users_userEntity::$ADDITIONALFIELD6,$Additionalfield6);
	}
	public static $ADDITIONALFIELD7="additionalfield7";
	/**
	 * @return mixed
	 */
	public function getAdditionalfield7(){
		return $this->getField(users_userEntity::$ADDITIONALFIELD7);
	}
	/**
	 * @param mixed $Additionalfield7
	 */
	public function setAdditionalfield7($Additionalfield7){
		$this->setField(users_userEntity::$ADDITIONALFIELD7,$Additionalfield7);
	}
	public static $ADDITIONALFIELD8="additionalfield8";
	/**
	 * @return mixed
	 */
	public function getAdditionalfield8(){
		return $this->getField(users_userEntity::$ADDITIONALFIELD8);
	}
	/**
	 * @param mixed $Additionalfield8
	 */
	public function setAdditionalfield8($Additionalfield8){
		$this->setField(users_userEntity::$ADDITIONALFIELD8,$Additionalfield8);
	}
	public static $ADDITIONALFIELD9="additionalfield9";
	/**
	 * @return mixed
	 */
	public function getAdditionalfield9(){
		return $this->getField(users_userEntity::$ADDITIONALFIELD9);
	}
	/**
	 * @param mixed $Additionalfield9
	 */
	public function setAdditionalfield9($Additionalfield9){
		$this->setField(users_userEntity::$ADDITIONALFIELD9,$Additionalfield9);
	}
	public static $SIGNUP_TIME="signup_time";
	/**
	 * @return mixed
	 */
	public function getSignup_time(){
		return $this->getField(users_userEntity::$SIGNUP_TIME);
	}
	/**
	 * @param mixed $Signup_time
	 */
	public function setSignup_time($Signup_time){
		$this->setField(users_userEntity::$SIGNUP_TIME,$Signup_time);
	}
}
?>