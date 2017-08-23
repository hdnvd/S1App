<?php

namespace Modules\users\PublicClasses;


use Modules\users\Entity\roleSystemRoleEntity;
use Modules\users\Entity\RoleSystemUserRoleEntity;
use Modules\users\Entity\RoleRoleAccess;
use Modules\users\Entity\RoleRoleAccessEntity;
use Modules\users\Entity\users_userlogEntity;
use Modules\common\PublicClasses\AppDate;
/**
 *
 * @author nahavandi
 *        
 */
class AccessController{
	public function getUserAccess($SystemUserID,$Module,$Page,$Action)
	{
		$roleEnt=new RoleSystemUserRoleEntity();
		if(is_numeric($SystemUserID))
		  $roles=$roleEnt->getUserRole($SystemUserID);
		else 
		    $roles="";
		$accessEnt=new RoleRoleAccessEntity();
		$roleid=-1;
		if(is_array($roles) && count($roles)>0)
		{
			$roleid=$roles[0]['roleid'];
			$access=$accessEnt->getRoleAccess($roleid,$Module,$Page,"*");
			if($access)
			{
				$this->saveLog($SystemUserID, $Module, $Page, $Action);
				return true;
			}
			else 
			{
				$access=$accessEnt->getRoleAccess($roleid,$Module,$Page,$Action);
				if($access)
				{
					$this->saveLog($SystemUserID, $Module, $Page, $Action);
					return true;
				}
			}
			
			
		}
		else
			return $accessEnt->getRoleAccess(-1,$Module,$Page,"*");
		return false;
	}
	
	
	private function saveLog($SystemUserID,$Module, $Page, $Action)
	{
		$Ent=new users_userlogEntity();
		$Time=AppDate::now();
		$Ent->Insert($SystemUserID, $Module, $Page, $Action, $Time);
	}
}

?>