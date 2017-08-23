<?php

namespace Modules\users\Controllers;
use core\CoreClasses\services\Controller;
use Modules\users\Entity\roleSystemRoleEntity;
use Modules\users\Entity\role_systemtaskEntity;
use Modules\users\Entity\role_systemroletaskEntity;


class managerolesController extends Controller {
	public function load()
	{
		$RoleEnt=new roleSystemRoleEntity();
		$TaskEnt=new role_systemtaskEntity();
		$r['roles']=$RoleEnt->Select(array(), array());
		$r['tasks']=$TaskEnt->Select(array(), array());
		return $r;
	}
	public function addrole($Title, $DefaultModule, $DefaultPage)
	{
		$RoleEnt=new roleSystemRoleEntity();
		$TaskEnt=new role_systemtaskEntity();
		
		$RoleEnt->insert($Title, $DefaultModule, $DefaultPage);
		$r['roles']=$RoleEnt->Select(array(), array());
		$r['tasks']=$TaskEnt->Select(array(), array());
		return $r;
	}
	public function setPrevilages($RoleID,$Previlages)
	{
		$RoleTaskE=new role_systemroletaskEntity();
		$RoleTaskE->DeleteRoleTasks($RoleID);
		
		//print_r($Previlages);
		for($i=1;$i<count($Previlages);$i++)
		{
			$RoleTaskE->insert($RoleID, $Previlages[$i]);
		}
				
		return $this->load();
	}
	public function getRoleTasks($RoleID)
	{
		$RoleTaskE=new role_systemroletaskEntity();
		return $RoleTaskE->Select(array("systemrole_fid"), array($RoleID));
	}
	
}
?>
