<?php
namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-19 - 2018-02-08 15:47
*@lastUpdate 1396-11-19 - 2018-02-08 15:47
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class users_systemroletaskEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("users_systemroletask");
		$this->setTableTitle("users_systemroletask");
		$this->setTitleFieldName("id");

		/******** systemrole_fid ********/
		$Systemrole_fidInfo=new FieldInfo();
		$Systemrole_fidInfo->setTitle("systemrole_fid");
		$this->setFieldInfo(users_systemroletaskEntity::$SYSTEMROLE_FID,$Systemrole_fidInfo);
		$this->addTableField('1',users_systemroletaskEntity::$SYSTEMROLE_FID);

		/******** systemtask_fid ********/
		$Systemtask_fidInfo=new FieldInfo();
		$Systemtask_fidInfo->setTitle("systemtask_fid");
		$this->setFieldInfo(users_systemroletaskEntity::$SYSTEMTASK_FID,$Systemtask_fidInfo);
		$this->addTableField('2',users_systemroletaskEntity::$SYSTEMTASK_FID);
	}
	public static $SYSTEMROLE_FID="systemrole_fid";
	/**
	 * @return mixed
	 */
	public function getSystemrole_fid(){
		return $this->getField(users_systemroletaskEntity::$SYSTEMROLE_FID);
	}
	/**
	 * @param mixed $Systemrole_fid
	 */
	public function setSystemrole_fid($Systemrole_fid){
		$this->setField(users_systemroletaskEntity::$SYSTEMROLE_FID,$Systemrole_fid);
	}
	public static $SYSTEMTASK_FID="systemtask_fid";
	/**
	 * @return mixed
	 */
	public function getSystemtask_fid(){
		return $this->getField(users_systemroletaskEntity::$SYSTEMTASK_FID);
	}
	/**
	 * @param mixed $Systemtask_fid
	 */
	public function setSystemtask_fid($Systemtask_fid){
		$this->setField(users_systemroletaskEntity::$SYSTEMTASK_FID,$Systemtask_fid);
	}
}
?>