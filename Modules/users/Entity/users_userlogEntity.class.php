<?php
namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-20 - 2018-02-09 00:56
*@lastUpdate 1396-11-20 - 2018-02-09 00:56
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class users_userlogEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("users_userlog");
		$this->setTableTitle("users_userlog");
		$this->setTitleFieldName("id");

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("role_systemuser_fid");
		$this->setFieldInfo(users_userlogEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('1',users_userlogEntity::$ROLE_SYSTEMUSER_FID);

		/******** module ********/
		$ModuleInfo=new FieldInfo();
		$ModuleInfo->setTitle("module");
		$this->setFieldInfo(users_userlogEntity::$MODULE,$ModuleInfo);
		$this->addTableField('2',users_userlogEntity::$MODULE);

		/******** time ********/
		$TimeInfo=new FieldInfo();
		$TimeInfo->setTitle("time");
		$this->setFieldInfo(users_userlogEntity::$TIME,$TimeInfo);
		$this->addTableField('3',users_userlogEntity::$TIME);

		/******** page ********/
		$PageInfo=new FieldInfo();
		$PageInfo->setTitle("page");
		$this->setFieldInfo(users_userlogEntity::$PAGE,$PageInfo);
		$this->addTableField('4',users_userlogEntity::$PAGE);

		/******** action ********/
		$ActionInfo=new FieldInfo();
		$ActionInfo->setTitle("action");
		$this->setFieldInfo(users_userlogEntity::$ACTION,$ActionInfo);
		$this->addTableField('5',users_userlogEntity::$ACTION);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(users_userlogEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(users_userlogEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
	public static $MODULE="module";
	/**
	 * @return mixed
	 */
	public function getModule(){
		return $this->getField(users_userlogEntity::$MODULE);
	}
	/**
	 * @param mixed $Module
	 */
	public function setModule($Module){
		$this->setField(users_userlogEntity::$MODULE,$Module);
	}
	public static $TIME="time";
	/**
	 * @return mixed
	 */
	public function getTime(){
		return $this->getField(users_userlogEntity::$TIME);
	}
	/**
	 * @param mixed $Time
	 */
	public function setTime($Time){
		$this->setField(users_userlogEntity::$TIME,$Time);
	}
	public static $PAGE="page";
	/**
	 * @return mixed
	 */
	public function getPage(){
		return $this->getField(users_userlogEntity::$PAGE);
	}
	/**
	 * @param mixed $Page
	 */
	public function setPage($Page){
		$this->setField(users_userlogEntity::$PAGE,$Page);
	}
	public static $ACTION="action";
	/**
	 * @return mixed
	 */
	public function getAction(){
		return $this->getField(users_userlogEntity::$ACTION);
	}
	/**
	 * @param mixed $Action
	 */
	public function setAction($Action){
		$this->setField(users_userlogEntity::$ACTION,$Action);
	}
}
?>