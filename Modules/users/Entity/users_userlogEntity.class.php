<?php
namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-08-03 - 2018-10-25 22:25
*@lastUpdate 1397-08-03 - 2018-10-25 22:25
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class users_userlogEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("users_userlog");
		$this->setTableTitle("لاگ کاربری");
		$this->setTitleFieldName("id");

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("کاربر");
		$this->setFieldInfo(users_userlogEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('1',users_userlogEntity::$ROLE_SYSTEMUSER_FID);

		/******** module ********/
		$ModuleInfo=new FieldInfo();
		$ModuleInfo->setTitle("ماژول");
		$this->setFieldInfo(users_userlogEntity::$MODULE,$ModuleInfo);
		$this->addTableField('2',users_userlogEntity::$MODULE);

		/******** time ********/
		$TimeInfo=new FieldInfo();
		$TimeInfo->setTitle("زمان");
		$this->setFieldInfo(users_userlogEntity::$TIME,$TimeInfo);
		$this->addTableField('3',users_userlogEntity::$TIME);

		/******** page ********/
		$PageInfo=new FieldInfo();
		$PageInfo->setTitle("صفحه");
		$this->setFieldInfo(users_userlogEntity::$PAGE,$PageInfo);
		$this->addTableField('4',users_userlogEntity::$PAGE);

		/******** action ********/
		$ActionInfo=new FieldInfo();
		$ActionInfo->setTitle("فعالیت");
		$this->setFieldInfo(users_userlogEntity::$ACTION,$ActionInfo);
		$this->addTableField('5',users_userlogEntity::$ACTION);

		/******** ip ********/
		$IpInfo=new FieldInfo();
		$IpInfo->setTitle("آدرس IP");
		$this->setFieldInfo(users_userlogEntity::$IP,$IpInfo);
		$this->addTableField('6',users_userlogEntity::$IP);

		/******** browserinfo ********/
		$BrowserinfoInfo=new FieldInfo();
		$BrowserinfoInfo->setTitle("اطلاعات مرورگر");
		$this->setFieldInfo(users_userlogEntity::$BROWSERINFO,$BrowserinfoInfo);
		$this->addTableField('7',users_userlogEntity::$BROWSERINFO);

		/******** created_at ********/
		$Created_atInfo=new FieldInfo();
		$Created_atInfo->setTitle("تاریخ ایجاد");
		$this->setFieldInfo(users_userlogEntity::$CREATED_AT,$Created_atInfo);
		$this->addTableField('8',users_userlogEntity::$CREATED_AT);

		/******** updated_at ********/
		$Updated_atInfo=new FieldInfo();
		$Updated_atInfo->setTitle("تاریخ بروزرسانی");
		$this->setFieldInfo(users_userlogEntity::$UPDATED_AT,$Updated_atInfo);
		$this->addTableField('9',users_userlogEntity::$UPDATED_AT);
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
	public static $IP="ip";
	/**
	 * @return mixed
	 */
	public function getIp(){
		return $this->getField(users_userlogEntity::$IP);
	}
	/**
	 * @param mixed $Ip
	 */
	public function setIp($Ip){
		$this->setField(users_userlogEntity::$IP,$Ip);
	}
	public static $BROWSERINFO="browserinfo";
	/**
	 * @return mixed
	 */
	public function getBrowserinfo(){
		return $this->getField(users_userlogEntity::$BROWSERINFO);
	}
	/**
	 * @param mixed $Browserinfo
	 */
	public function setBrowserinfo($Browserinfo){
		$this->setField(users_userlogEntity::$BROWSERINFO,$Browserinfo);
	}
	public static $CREATED_AT="created_at";
	/**
	 * @return mixed
	 */
	public function getCreated_at(){
		return $this->getField(users_userlogEntity::$CREATED_AT);
	}
	/**
	 * @param mixed $Created_at
	 */
	public function setCreated_at($Created_at){
		$this->setField(users_userlogEntity::$CREATED_AT,$Created_at);
	}
	public static $UPDATED_AT="updated_at";
	/**
	 * @return mixed
	 */
	public function getUpdated_at(){
		return $this->getField(users_userlogEntity::$UPDATED_AT);
	}
	/**
	 * @param mixed $Updated_at
	 */
	public function setUpdated_at($Updated_at){
		$this->setField(users_userlogEntity::$UPDATED_AT,$Updated_at);
	}
}
?>