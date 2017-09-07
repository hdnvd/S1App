<?php

namespace Modules\users\Entity;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbaccess;
use Modules\users\Exceptions\TooSmallPasswordException;
use Modules\users\Exceptions\TooSmallUsernameException;

/**
 *
 * @author nahavandi
 *        
 */
class roleSystemUserEntity extends EntityClass
{
    public static $MIN_USERNAME_LENGTH=4;
    public static $MIN_PASSWORD_LENGTH=8;
    public function __construct(dbaccess $DBAccessor=null)
    {
        if($DBAccessor===null)
            $this->setDatabase(new dbquery());
        else 
            $this->setDatabase(new dbquery($DBAccessor));
        $this->setTableName("role_systemuser");
    }
	/**
	 * @param string $Username
	 * @param string $Password
	 * @return number UserID Or -1
	 */
	public function Add($Username,$Password)
	{
	    if(strlen($Username)<roleSystemUserEntity::$MIN_USERNAME_LENGTH)
	        throw new TooSmallUsernameException();

        if(strlen($Password)<roleSystemUserEntity::$MIN_PASSWORD_LENGTH)
            throw new TooSmallPasswordException();
		$Database=new dbquery();
		$Query=$Database->InsertInto("role_systemuser")
		->Set("username", $Username)
		->Set("password", $Password)
		->Set("password2", $Password)
		->Set("isdeleted", 0);
// 		echo $Query->getQueryString();
		$Query->Execute();
		return $Query->getInsertedID();
	}
	public function Update($ID,$Username,$Password,$Password2,$IsDeleted)
	{
        if($Username!=null && strlen($Username)<roleSystemUserEntity::$MIN_USERNAME_LENGTH)
            throw new TooSmallUsernameException();

        if($Password!=null && strlen($Password)<roleSystemUserEntity::$MIN_PASSWORD_LENGTH)
            throw new TooSmallPasswordException();

		$Database=new dbquery();
		$Query=$Database->Update("role_systemuser")
		->NotNullSet("username", $Username)
		->NotNullSet("password", $Password)
		->NotNullSet("password2", $Password2)
		->NotNullSet("isdeleted", $IsDeleted);
		if($IsDeleted==1)
            $Query=$Query->NotNullSet("deletetime", time());

		$Query=$Query->Where()->Equal("id", $ID);

		$Query->Execute();
	}
	public function Select(array $Fields,array $FieldValues,array $Logics=null)
	{
		$theFields=array();
		for($i=0;$i<count($Fields);$i++)
		{
		$theFields[$i]['name']=$Fields[$i];
		if($i<count($FieldValues))
			$theFields[$i]['value']=$FieldValues[$i];
			else
				$theFields[$i]['value']=null;
		}
	
		return $this->getSelect(array("*"), $theFields,$Logics);
	}
	public static function checkUserPass($username,$password)
	{
	
		$Database=new dbquery();
		$result=$Database->Select("*")->From("role_systemuser")->Where()->Equal("username", $username)->AndLogic()->Equal("password", $password)->ExecuteAssociated();
		if($result!=null)
			return true;
		return false;
	}
	public static function checkSecondUserPass($username,$password)
	{
	
		$Database=new dbquery();
		$result=$Database->Select("*")->From("role_systemuser")->Where()->Equal("username", $username)->AndLogic()->Equal("password2", $password)->ExecuteAssociated();
		if($result!=null)
			return true;
		return false;
	}
	public static function getUserId($username)
	{
		$Database=new dbquery();
		$Query=$Database->Select("id")->From("role_systemuser")->Where()->Equal("username", $username);
		$result=$Query->ExecuteAssociated();
		$id=null;
		if($result!=null)
			$id=$result[0]['id'];
		return $id;
	}
	
}

?>