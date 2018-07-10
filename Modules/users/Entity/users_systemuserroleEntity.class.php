<?php
namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-20 - 2018-02-09 00:38
*@lastUpdate 1396-11-20 - 2018-02-09 00:38
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class users_systemuserroleEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("users_systemuserrole");
		$this->setTableTitle("users_systemuserrole");
		$this->setTitleFieldName("id");

		/******** systemuser_fid ********/
		$Systemuser_fidInfo=new FieldInfo();
		$Systemuser_fidInfo->setTitle("systemuser_fid");
		$this->setFieldInfo(users_systemuserroleEntity::$SYSTEMUSER_FID,$Systemuser_fidInfo);
		$this->addTableField('1',users_systemuserroleEntity::$SYSTEMUSER_FID);

		/******** systemrole_fid ********/
		$Systemrole_fidInfo=new FieldInfo();
		$Systemrole_fidInfo->setTitle("systemrole_fid");
		$this->setFieldInfo(users_systemuserroleEntity::$SYSTEMROLE_FID,$Systemrole_fidInfo);
		$this->addTableField('2',users_systemuserroleEntity::$SYSTEMROLE_FID);
	}
	public static $SYSTEMUSER_FID="systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getSystemuser_fid(){
		return $this->getField(users_systemuserroleEntity::$SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Systemuser_fid
	 */
	public function setSystemuser_fid($Systemuser_fid){
		$this->setField(users_systemuserroleEntity::$SYSTEMUSER_FID,$Systemuser_fid);
	}
	public static $SYSTEMROLE_FID="systemrole_fid";
	/**
	 * @return mixed
	 */
	public function getSystemrole_fid(){
		return $this->getField(users_systemuserroleEntity::$SYSTEMROLE_FID);
	}
	/**
	 * @param mixed $Systemrole_fid
	 */
	public function setSystemrole_fid($Systemrole_fid){
		$this->setField(users_systemuserroleEntity::$SYSTEMROLE_FID,$Systemrole_fid);
	}
}
?>