<?php
namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-21 - 2018-02-10 14:31
*@lastUpdate 1396-11-21 - 2018-02-10 14:31
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class users_systemuserEntity extends roleSystemUserEntity {
	public function __construct(dbaccess $DBAccessor)
	{
	    parent::__construct($DBAccessor);
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("role_systemuser");
		$this->setTableTitle("users_systemuser");
		$this->setTitleFieldName("id");

		/******** username ********/
		$UsernameInfo=new FieldInfo();
		$UsernameInfo->setTitle("username");
		$this->setFieldInfo(users_systemuserEntity::$USERNAME,$UsernameInfo);
		$this->addTableField('1',users_systemuserEntity::$USERNAME);

		/******** password ********/
		$PasswordInfo=new FieldInfo();
		$PasswordInfo->setTitle("password");
		$this->setFieldInfo(users_systemuserEntity::$PASSWORD,$PasswordInfo);
		$this->addTableField('2',users_systemuserEntity::$PASSWORD);

	}
	public function isPasswordTrue($Password)
    {
        return password_verify($Password,$this->getPassword());
    }
	public static $USERNAME="username";
	/**
	 * @return mixed
	 */
	public function getUsername(){
		return $this->getField(users_systemuserEntity::$USERNAME);
	}
	/**
	 * @param mixed $Username
	 */
	public function setUsername($Username){
		$this->setField(users_systemuserEntity::$USERNAME,$Username);
	}
	public static $PASSWORD="password";
	/**
	 * @return mixed
	 */
	public function getPassword(){
		return $this->getField(users_systemuserEntity::$PASSWORD);
	}
	/**
	 * @param mixed $Password
	 */
	public function setPassword($Password){

		$this->setField(users_systemuserEntity::$PASSWORD,parent::hashPassword($Password));
	}
    public function Remove()
    {
        $UpdateQuery=$this->getDatabase()->Update($this->getTableName())
            ->Set("deletetime", time())
            ->Set("isdeleted", 1)
            ->Where()->Smaller("deletetime", "1")->AndLogic()->Equal("id",$this->getId());
        //echo $this->UpdateQuery->getQueryString();
        //die();
        $UpdateQuery->Execute();
    }

}
?>