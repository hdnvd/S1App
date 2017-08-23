<?php

namespace Modules\users\Entity;

use core\CoreClasses\services\EntityClass;

/**
 *
 * @author nahavandi
 *        
 */
class baseUserEntity extends EntityClass {
	public static function getUserId($username)
	{
		
		$sysuser=new roleSystemUserEntity();
		return $sysuser->getUserId($username);
	}
	public static function getUserInfo($userId,$fieldName)
	{
		$Database=new dbquery();
		$Query=$Database->Select("*")->From("user")->Where()->Equal("role_systemuser_fid", $userId);
		$result=$Query->ExecuteAssociated();
		if($result!=null)
			$info=$result[0][$fieldName];
		return $info;
		
	}
	public static function checkUserPass($username,$password)
	{

		$sysuser=new roleSystemUserEntity();
		return $sysuser->checkUserPass($username, $password);
	}
	
}

?>