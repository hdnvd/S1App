<?php

namespace Modules\users\PublicClasses;

use Modules\users\Entity\roleSystemUserEntity;
use Modules\users\Entity\userEntity;
use Modules\users\Entity\UserSystemUserEntity;
use core\CoreClasses\Sweet2DArray;
use Modules\users\Entity\RoleSystemUserRoleEntity;
/**
 *
 * @author nahavandi
 *        
 */
class User {
	private $SystemUserID=null;
	private $userEntity=null;
	private $systemuserEntity=null;
	private $userID;
	public static function FindUserIDsFromSystemUser($id)
	{
		$USUE=new UserSystemUserEntity();
		return $USUE->getUsersBySystemUser($id);
	}
	public static function FindSystemUserFromUserID($id)
	{
		$USUE=new UserSystemUserEntity();
		return $USUE->getSystemUserByUser($id);
	}
	public function __construct($SystemUserID)
	{
		$this->userEntity=new userEntity();
		$this->SystemUserID=$SystemUserID;
		$this->systemuserEntity=new roleSystemUserEntity();
		$this->userID=User::FindUserIDsFromSystemUser($SystemUserID);
		$this->userID=$this->userID[0];
	}
	public function getSystemUserIDFromUserPass($UserName,$Password)
    {
        $this->systemuserEntity=new roleSystemUserEntity();
        return $this->systemuserEntity->getUserIdFromUserPass($UserName,$Password);
    }
	public function getUserInfo($info)
	{
		return $this->userEntity->getUserInfo($this->userID, $info);
	}
	public function getSystemUserRoles()
	{
		$RoleSystemUserRole=new RoleSystemUserRoleEntity();
		$userTypes =$RoleSystemUserRole->getUserRole($this->SystemUserID);
		if(!is_null($userTypes))
		{
			$userTypes=Sweet2DArray::array_filp($userTypes);
			return $userTypes['roleid'];
		}
		else
			return null;
	}
	public static function setUserRole($userId,$RoleID)
	{
		$ent=new RoleSystemUserRoleEntity();
		$ent->update($RoleID, $userId);
	
	}
}

?>