<?php
namespace Modules\users\Entity;
use core\CoreClasses\db\DBField;
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
class users_systemroleEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("users_systemrole");
		$this->setTableTitle("users_systemrole");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(users_systemroleEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',users_systemroleEntity::$TITLE);

		/******** defaultmodule ********/
		$DefaultmoduleInfo=new FieldInfo();
		$DefaultmoduleInfo->setTitle("ماژول پیشفرض");
		$this->setFieldInfo(users_systemroleEntity::$DEFAULTMODULE,$DefaultmoduleInfo);
		$this->addTableField('2',users_systemroleEntity::$DEFAULTMODULE);

		/******** defaultpage ********/
		$DefaultpageInfo=new FieldInfo();
		$DefaultpageInfo->setTitle("صفحه پیشفرض");
		$this->setFieldInfo(users_systemroleEntity::$DEFAULTPAGE,$DefaultpageInfo);
		$this->addTableField('3',users_systemroleEntity::$DEFAULTPAGE);

		/******** indexparameters ********/
		$IndexparametersInfo=new FieldInfo();
		$IndexparametersInfo->setTitle("پارامتر های صفحه اول");
		$this->setFieldInfo(users_systemroleEntity::$INDEXPARAMETERS,$IndexparametersInfo);
		$this->addTableField('4',users_systemroleEntity::$INDEXPARAMETERS);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(users_systemroleEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(users_systemroleEntity::$TITLE,$Title);
	}
	public static $DEFAULTMODULE="defaultmodule";
	/**
	 * @return mixed
	 */
	public function getDefaultmodule(){
		return $this->getField(users_systemroleEntity::$DEFAULTMODULE);
	}
	/**
	 * @param mixed $Defaultmodule
	 */
	public function setDefaultmodule($Defaultmodule){
		$this->setField(users_systemroleEntity::$DEFAULTMODULE,$Defaultmodule);
	}
	public static $DEFAULTPAGE="defaultpage";
	/**
	 * @return mixed
	 */
	public function getDefaultpage(){
		return $this->getField(users_systemroleEntity::$DEFAULTPAGE);
	}
	/**
	 * @param mixed $Defaultpage
	 */
	public function setDefaultpage($Defaultpage){
		$this->setField(users_systemroleEntity::$DEFAULTPAGE,$Defaultpage);
	}
	public static $INDEXPARAMETERS="indexparameters";
	/**
	 * @return mixed
	 */
	public function getIndexparameters(){
		return $this->getField(users_systemroleEntity::$INDEXPARAMETERS);
	}
	/**
	 * @param mixed $Indexparameters
	 */
	public function setIndexparameters($Indexparameters){
		$this->setField(users_systemroleEntity::$INDEXPARAMETERS,$Indexparameters);
	}
    public function getRoleAccess($RoleID, $Module, $Page, $Action)
    {

        $DBAccessor=new dbaccess();
        $Database = new dbquery($DBAccessor);
        $Query = $Database->Select("*")->From(["users_systemroletask srt", 'users_systemtask st'])->Where()
            ->Equal('srt.systemtask_fid', new DBField('st.id', false))
            ->AndLogic()->Equal("module", $Module)->AndLogic()->Equal("page", $Page);
        $res = $Query->ExecuteAssociated();

        if (is_array($res) && count($res) > 0)//If A Record For this Module Page Exists
        {
            $Query = $Database->Select(["srt.systemrole_fid as roleid", 'st.module as module', 'st.page as page', 'st.action as action'])->From(["users_systemroletask srt", 'users_systemtask st'])
                ->Where()
                ->Equal('srt.systemtask_fid', new DBField('st.id', false))
                ->AndLogic()->Equal("module", $Module)->AndLogic()->Equal("page", $Page)
                ->AndLogic()->Equal("srt.systemrole_fid", $RoleID)
                ->AndLogic()->Equal("action", $Action);
            $res = $Query->ExecuteAssociated();
            $DBAccessor->close_connection();
            if (is_array($res) && count($res) > 0)
                return true;
            else
                return false;
        } else
            return true;
    }
}
?>