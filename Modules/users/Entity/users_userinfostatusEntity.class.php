<?php
namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-20 - 2018-02-09 00:22
*@lastUpdate 1396-11-20 - 2018-02-09 00:22
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class users_userinfostatusEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("users_userinfostatus");
		$this->setTableTitle("users_userinfostatus");
		$this->setTitleFieldName("id");

		/******** userinfo_field ********/
		$Userinfo_fieldInfo=new FieldInfo();
		$Userinfo_fieldInfo->setTitle("userinfo_field");
		$this->setFieldInfo(users_userinfostatusEntity::$USERINFO_FIELD,$Userinfo_fieldInfo);
		$this->addTableField('1',users_userinfostatusEntity::$USERINFO_FIELD);

		/******** userinfo_fieldcaption ********/
		$Userinfo_fieldcaptionInfo=new FieldInfo();
		$Userinfo_fieldcaptionInfo->setTitle("userinfo_fieldcaption");
		$this->setFieldInfo(users_userinfostatusEntity::$USERINFO_FIELDCAPTION,$Userinfo_fieldcaptionInfo);
		$this->addTableField('2',users_userinfostatusEntity::$USERINFO_FIELDCAPTION);

		/******** isenabled ********/
		$IsenabledInfo=new FieldInfo();
		$IsenabledInfo->setTitle("isenabled");
		$this->setFieldInfo(users_userinfostatusEntity::$ISENABLED,$IsenabledInfo);
		$this->addTableField('3',users_userinfostatusEntity::$ISENABLED);
	}
	public static $USERINFO_FIELD="userinfo_field";
	/**
	 * @return mixed
	 */
	public function getUserinfo_field(){
		return $this->getField(users_userinfostatusEntity::$USERINFO_FIELD);
	}
	/**
	 * @param mixed $Userinfo_field
	 */
	public function setUserinfo_field($Userinfo_field){
		$this->setField(users_userinfostatusEntity::$USERINFO_FIELD,$Userinfo_field);
	}
	public static $USERINFO_FIELDCAPTION="userinfo_fieldcaption";
	/**
	 * @return mixed
	 */
	public function getUserinfo_fieldcaption(){
		return $this->getField(users_userinfostatusEntity::$USERINFO_FIELDCAPTION);
	}
	/**
	 * @param mixed $Userinfo_fieldcaption
	 */
	public function setUserinfo_fieldcaption($Userinfo_fieldcaption){
		$this->setField(users_userinfostatusEntity::$USERINFO_FIELDCAPTION,$Userinfo_fieldcaption);
	}
	public static $ISENABLED="isenabled";
	/**
	 * @return mixed
	 */
	public function getIsenabled(){
		return $this->getField(users_userinfostatusEntity::$ISENABLED);
	}
	/**
	 * @param mixed $Isenabled
	 */
	public function setIsenabled($Isenabled){
		$this->setField(users_userinfostatusEntity::$ISENABLED,$Isenabled);
	}
}
?>