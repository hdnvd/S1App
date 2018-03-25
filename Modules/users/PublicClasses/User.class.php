<?php

namespace Modules\users\PublicClasses;

use core\CoreClasses\db\dbaccess;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\QueryLogic;
use Modules\users\Entity\roleSystemUserEntity;
use Modules\users\Entity\users_systemuserEntity;
use Modules\users\Entity\users_systemuserroleEntity;
use Modules\users\Entity\users_userEntity;
use Modules\users\Exceptions\UsernameExistsException;
use Modules\users\Exceptions\UserNotFoundException;

/**
 *
 * @author nahavandi
 *        
 */
class User {
	private $SystemUserID=null;
    /**
     * @var users_userEntity
     */
    private $userEntity=null;
	private $userID;
	public static function FindUserIDFromSystemUser($id)
	{
        $dbaccess=new dbaccess();
		$USUE=new users_userEntity($dbaccess);
		$user=$USUE->FindOne(new QueryLogic([new FieldCondition(users_userEntity::$ROLE_SYSTEMUSER_FID,$id)]));
        $dbaccess->close_connection();
        if($user==null || $user->getId()<0)
            return -1;
        return $user->getId();

    }
    public static function addUser($UserName,$Password,dbaccess $DBAccessor=null)
    {
        $AutoCloseDBAccess=true;
        if($DBAccessor==null) {
            $AutoCloseDBAccess = false;
            $DBAccessor = new dbaccess();
        }
        $SystemUserEnt=new users_systemuserEntity($DBAccessor);
        $UserName=strtolower(trim($UserName));
        $OldUser=$SystemUserEnt->FindOne(new QueryLogic([new FieldCondition(users_systemuserEntity::$USERNAME,$UserName)]));
        $SystemUserID=-1;
        if($OldUser!=null && $OldUser->getId()>0)
        {
            if($AutoCloseDBAccess)
                $DBAccessor->close_connection();
            throw new UsernameExistsException();
        }
        else
        {
                $SystemUserEnt=new users_systemuserEntity($DBAccessor);
                $SystemUserEnt->setUsername($UserName);
                $SystemUserEnt->setPassword($Password);
                $SystemUserEnt->Save();
                $SystemUserID=$SystemUserEnt->getId();
        }
        if($AutoCloseDBAccess)
            $DBAccessor->close_connection();
        return $SystemUserID;
    }
    public static function DeleteUser($SystemUserID,dbaccess $DBAccessor)
    {

        $DBAccessor = new dbaccess();
        $SystemUserEnt=new roleSystemUserEntity($DBAccessor);
        $SystemUserEnt->Update($SystemUserID,null,null,null,-1);
        $DBAccessor->close_connection();


    }

    public static function UpdatePassword($SystemUserID,$NewPassword,dbaccess $DBAccessor=null)
    {
        $AutoCloseDBAccess=true;
        if($DBAccessor==null) {
            $AutoCloseDBAccess = false;
            $DBAccessor = new dbaccess();
        }
        $SystemUserEnt=new roleSystemUserEntity($DBAccessor);
        if($SystemUserID>0)
        {
            $SystemUserEnt->Update($SystemUserID,null,$NewPassword,$NewPassword,-1);
        }
        else
        {
            if($AutoCloseDBAccess)
                $DBAccessor->close_connection();
            throw new UserNotFoundException();
        }
        if($AutoCloseDBAccess)
            $DBAccessor->close_connection();
        return $SystemUserID;
    }
	public function __construct($SystemUserID)
	{
		$this->SystemUserID=$SystemUserID;
		$this->userID=User::FindUserIDFromSystemUser($SystemUserID);
	}
	public static function getSystemUserIDFromUserPass($UserName,$Password,dbaccess $DBAccessor=null)
    {
        $AutoCloseDBAccess=true;
        if($DBAccessor==null) {
            $AutoCloseDBAccess = false;
            $DBAccessor = new dbaccess();
        }
        $systemuserEntity=new roleSystemUserEntity($DBAccessor);
        $UserID= $systemuserEntity->getUserIdFromUserPass($UserName,$Password);
        if($AutoCloseDBAccess)
            $DBAccessor->close_connection();
        return $UserID;
    }

    public static function getSystemUserIDFromUser($UserName)
    {

        $dbaccess=new dbaccess();
        $systemuserEntity=new roleSystemUserEntity($dbaccess);
        $res= $systemuserEntity->getUserId($UserName);
        $dbaccess->close_connection();
        return $res;
    }
    /**
     * @return users_userEntity
     */
    public function getUser()
	{
        $dbaccess=new dbaccess();
        if($this->userEntity==null)
        {
            $this->userEntity=new users_userEntity($dbaccess);
            $this->userEntity->setId($this->userID);
        }
        $dbaccess->close_connection();
        return $this->userEntity;
	}
	public function getSystemUserRoles()
	{
	    $dbaccess=new dbaccess();
		$RoleSystemUserRole=new users_systemuserroleEntity($dbaccess);
        $RoleSystemUserRole =$RoleSystemUserRole->FindOne(new QueryLogic([new FieldCondition(users_systemuserroleEntity::$SYSTEMUSER_FID,$this->SystemUserID)]));
		$dbaccess->close_connection();
		if($RoleSystemUserRole!=null && $RoleSystemUserRole->getId()>0)
		{
			return $RoleSystemUserRole->getSystemrole_fid();
		}
		else
			return null;
	}
	public static function setUserRole($userId,$RoleID)
	{
        $dbaccess=new dbaccess();
		$ent=new users_systemuserroleEntity($dbaccess);
		$ent=$ent->FindOne(new QueryLogic([new FieldCondition(users_systemuserroleEntity::$SYSTEMUSER_FID,$userId)]));
		if($ent!=null && $ent->getId()>0)
        {

            $ent->setSystemrole_fid($RoleID);
            $ent->Save();
        }
        $dbaccess->close_connection();
	
	}
}

?>