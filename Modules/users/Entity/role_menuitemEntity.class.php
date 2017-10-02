<?php
namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-09 - 2017-10-01 01:05
*@lastUpdate 1396-07-09 - 2017-10-01 01:05
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 1.018
*/
class role_menuitemEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("role_menuitem");
		$this->setTableTitle("منو");

		/******** latintitle ********/
		$LatintitleInfo=new FieldInfo();
		$LatintitleInfo->setTitle("عنوان منو");
		$LatintitleInfo->setRequired(true);
		$LatintitleInfo->setMinLength(3);
		$this->setFieldInfo(role_menuitemEntity::$LATINTITLE,$LatintitleInfo);

		/******** module ********/
		$ModuleInfo=new FieldInfo();
		$ModuleInfo->setTitle("نام ماژول(لاتین)");
        $ModuleInfo->setRequired(true);
        $ModuleInfo->setMinLength(3);
		$this->setFieldInfo(role_menuitemEntity::$MODULE,$ModuleInfo);

		/******** page ********/
		$PageInfo=new FieldInfo();
		$PageInfo->setTitle("نام صفحه");
        $PageInfo->setRequired(true);
        $PageInfo->setMinLength(3);
		$this->setFieldInfo(role_menuitemEntity::$PAGE,$PageInfo);

		/******** parameters ********/
		$ParametersInfo=new FieldInfo();
		$ParametersInfo->setTitle("پارامترها");
		$this->setFieldInfo(role_menuitemEntity::$PARAMETERS,$ParametersInfo);
	}
	public static $LATINTITLE="latintitle";
	/**
	 * @return mixed
	 */
	public function getLatintitle(){
		return $this->getField(role_menuitemEntity::$LATINTITLE);
	}
	/**
	 * @param mixed $Latintitle
	 */
	public function setLatintitle($Latintitle){
		$this->setField(role_menuitemEntity::$LATINTITLE,$Latintitle);
	}
	public static $MODULE="module";
	/**
	 * @return mixed
	 */
	public function getModule(){
		return $this->getField(role_menuitemEntity::$MODULE);
	}
	/**
	 * @param mixed $Module
	 */
	public function setModule($Module){
		$this->setField(role_menuitemEntity::$MODULE,$Module);
	}
	public static $PAGE="page";
	/**
	 * @return mixed
	 */
	public function getPage(){
		return $this->getField(role_menuitemEntity::$PAGE);
	}
	/**
	 * @param mixed $Page
	 */
	public function setPage($Page){
		$this->setField(role_menuitemEntity::$PAGE,$Page);
	}
	public static $PARAMETERS="parameters";
	/**
	 * @return mixed
	 */
	public function getParameters(){
		return $this->getField(role_menuitemEntity::$PARAMETERS);
	}
	/**
	 * @param mixed $Parameters
	 */
	public function setParameters($Parameters){
		$this->setField(role_menuitemEntity::$PARAMETERS,$Parameters);
	}
}
?>