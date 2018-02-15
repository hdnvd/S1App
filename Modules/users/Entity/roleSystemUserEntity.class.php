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
    public function __construct(dbaccess $DBAccessor)
    {
        $this->setDatabase(new dbquery($DBAccessor));
        $this->setTableName("role_systemuser");
    }

    /**
     * @param string $Username
     * @param string $Password
     * @return int|null
     * @throws TooSmallPasswordException
     * @throws TooSmallUsernameException
     */
    public function Add($Username, $Password)
	{
	    if(strlen($Username)<roleSystemUserEntity::$MIN_USERNAME_LENGTH)
	        throw new TooSmallUsernameException();

        if(strlen($Password)<roleSystemUserEntity::$MIN_PASSWORD_LENGTH)
            throw new TooSmallPasswordException();
        $Username=strtolower(trim($Username));
        $Password=roleSystemUserEntity::hashPassword($Password);
		$Database=new dbquery();
		$Query=$Database->InsertInto("role_systemuser")
		->Set("username", $Username)
		->Set("password", $Password)
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

        $Password=roleSystemUserEntity::hashPassword($Password);
		$Database=new dbquery();
		$Query=$Database->Update("role_systemuser")
		->NotNullSet("username", $Username)
		->NotNullSet("password", $Password)
		->NotNullSet("isdeleted", $IsDeleted);
		if($IsDeleted==1)
            $Query=$Query->NotNullSet("deletetime", time());

		$Query=$Query->Where()->Equal("id", $ID);

		$Query->Execute();
	}
	public static function hashPassword($Password)
    {
        $Password=password_hash($Password,PASSWORD_DEFAULT);
        return $Password;
    }
	public static function checkUserPass($username,$password)
	{
		$Database=new dbquery();
		$result=$Database->Select("*")->From("role_systemuser")->Where()->Equal("username", $username)->ExecuteAssociated();
		if($result!=null && count($result)>0)
        {
            $CurrentPass=$result[0]['password'];
            return password_verify($password,$CurrentPass);
        }
		return false;
	}
	public static function getUserId($username)
	{
        $username=strtolower($username);
        $username=trim($username);
		$Database=new dbquery();
		$Query=$Database->Select("id")->From("role_systemuser")->Where()->Equal("username", $username);
		$result=$Query->ExecuteAssociated();
		$id=null;
		if($result!=null)
			$id=$result[0]['id'];
		return $id;
	}
    public static function getUserIdFromUserPass($username,$Password)
    {
        $Database=new dbquery();
        $username=strtolower($username);
        $username=trim($username);
        $Password=roleSystemUserEntity::hashPassword($Password);
        $Query=$Database->Select("id")->From("role_systemuser")->Where()->Equal("username", $username);
//        echo $Query->getQueryString();
        $result=$Query->ExecuteAssociated();
        $id=null;
        if($result!=null && count($result)>0)
        if($result!=null && count($result)>0)
        {
            $CurrentPass=$result[0]['password'];
            if(password_verify($Password,$CurrentPass))
                $id=$result[0]['id'];

        }
        if($result!=null)
        return $id;
    }
	
}

?>