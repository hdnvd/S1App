<?php
namespace Modules\onlineclass\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-08-02 - 2017-10-24 14:22
*@lastUpdate 1396-08-02 - 2017-10-24 14:22
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class onlineclass_usercourseEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("onlineclass_usercourse");
		$this->setTableTitle("onlineclass_usercourse");
		$this->setTitleFieldName("id");

		/******** user_fid ********/
		$User_fidInfo=new FieldInfo();
		$User_fidInfo->setTitle("user_fid");
		$this->setFieldInfo(onlineclass_usercourseEntity::$USER_FID,$User_fidInfo);
		$this->addTableField('1',onlineclass_usercourseEntity::$USER_FID);

		/******** course_fid ********/
		$Course_fidInfo=new FieldInfo();
		$Course_fidInfo->setTitle("course_fid");
		$this->setFieldInfo(onlineclass_usercourseEntity::$COURSE_FID,$Course_fidInfo);
		$this->addTableField('2',onlineclass_usercourseEntity::$COURSE_FID);

		/******** add_time ********/
		$Add_timeInfo=new FieldInfo();
		$Add_timeInfo->setTitle("add_time");
		$this->setFieldInfo(onlineclass_usercourseEntity::$ADD_TIME,$Add_timeInfo);
		$this->addTableField('3',onlineclass_usercourseEntity::$ADD_TIME);

		/******** finance_transaction_fid ********/
		$Finance_transaction_fidInfo=new FieldInfo();
		$Finance_transaction_fidInfo->setTitle("finance_transaction_fid");
		$this->setFieldInfo(onlineclass_usercourseEntity::$FINANCE_TRANSACTION_FID,$Finance_transaction_fidInfo);
		$this->addTableField('4',onlineclass_usercourseEntity::$FINANCE_TRANSACTION_FID);
	}
	public static $USER_FID="user_fid";
	/**
	 * @return mixed
	 */
	public function getUser_fid(){
		return $this->getField(onlineclass_usercourseEntity::$USER_FID);
	}
	/**
	 * @param mixed $User_fid
	 */
	public function setUser_fid($User_fid){
		$this->setField(onlineclass_usercourseEntity::$USER_FID,$User_fid);
	}
	public static $COURSE_FID="course_fid";
	/**
	 * @return mixed
	 */
	public function getCourse_fid(){
		return $this->getField(onlineclass_usercourseEntity::$COURSE_FID);
	}
	/**
	 * @param mixed $Course_fid
	 */
	public function setCourse_fid($Course_fid){
		$this->setField(onlineclass_usercourseEntity::$COURSE_FID,$Course_fid);
	}
	public static $ADD_TIME="add_time";
	/**
	 * @return mixed
	 */
	public function getAdd_time(){
		return $this->getField(onlineclass_usercourseEntity::$ADD_TIME);
	}
	/**
	 * @param mixed $Add_time
	 */
	public function setAdd_time($Add_time){
		$this->setField(onlineclass_usercourseEntity::$ADD_TIME,$Add_time);
	}
	public static $FINANCE_TRANSACTION_FID="finance_transaction_fid";
	/**
	 * @return mixed
	 */
	public function getFinance_transaction_fid(){
		return $this->getField(onlineclass_usercourseEntity::$FINANCE_TRANSACTION_FID);
	}
	/**
	 * @param mixed $Finance_transaction_fid
	 */
	public function setFinance_transaction_fid($Finance_transaction_fid){
		$this->setField(onlineclass_usercourseEntity::$FINANCE_TRANSACTION_FID,$Finance_transaction_fid);
	}
}
?>