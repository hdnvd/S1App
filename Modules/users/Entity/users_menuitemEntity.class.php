<?php
namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-20 - 2018-02-09 00:16
*@lastUpdate 1396-11-20 - 2018-02-09 00:16
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class users_menuitemEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("users_menuitem");
		$this->setTableTitle("users_menuitem");
		$this->setTitleFieldName("id");

		/******** latintitle ********/
		$LatintitleInfo=new FieldInfo();
		$LatintitleInfo->setTitle("latintitle");
		$this->setFieldInfo(users_menuitemEntity::$LATINTITLE,$LatintitleInfo);
		$this->addTableField('1',users_menuitemEntity::$LATINTITLE);

		/******** module ********/
		$ModuleInfo=new FieldInfo();
		$ModuleInfo->setTitle("module");
		$this->setFieldInfo(users_menuitemEntity::$MODULE,$ModuleInfo);
		$this->addTableField('2',users_menuitemEntity::$MODULE);

		/******** page ********/
		$PageInfo=new FieldInfo();
		$PageInfo->setTitle("page");
		$this->setFieldInfo(users_menuitemEntity::$PAGE,$PageInfo);
		$this->addTableField('3',users_menuitemEntity::$PAGE);

		/******** parameters ********/
		$ParametersInfo=new FieldInfo();
		$ParametersInfo->setTitle("parameters");
		$this->setFieldInfo(users_menuitemEntity::$PARAMETERS,$ParametersInfo);
		$this->addTableField('4',users_menuitemEntity::$PARAMETERS);
	}
	public static $LATINTITLE="latintitle";
	/**
	 * @return mixed
	 */
	public function getLatintitle(){
		return $this->getField(users_menuitemEntity::$LATINTITLE);
	}
	/**
	 * @param mixed $Latintitle
	 */
	public function setLatintitle($Latintitle){
		$this->setField(users_menuitemEntity::$LATINTITLE,$Latintitle);
	}
	public static $MODULE="module";
	/**
	 * @return mixed
	 */
	public function getModule(){
		return $this->getField(users_menuitemEntity::$MODULE);
	}
	/**
	 * @param mixed $Module
	 */
	public function setModule($Module){
		$this->setField(users_menuitemEntity::$MODULE,$Module);
	}
	public static $PAGE="page";
	/**
	 * @return mixed
	 */
	public function getPage(){
		return $this->getField(users_menuitemEntity::$PAGE);
	}
	/**
	 * @param mixed $Page
	 */
	public function setPage($Page){
		$this->setField(users_menuitemEntity::$PAGE,$Page);
	}
	public static $PARAMETERS="parameters";
	/**
	 * @return mixed
	 */
	public function getParameters(){
		return $this->getField(users_menuitemEntity::$PARAMETERS);
	}
	/**
	 * @param mixed $Parameters
	 */
	public function setParameters($Parameters){
		$this->setField(users_menuitemEntity::$PARAMETERS,$Parameters);
	}
}
?>