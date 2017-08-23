<?php

namespace Modules\users\Controllers;
use core\CoreClasses\services\Controller;
use Modules\users\PublicClasses\sessionuser;
use Modules\users\Entity\roleSystemUserEntity;
use Modules\users\Exceptions\CurrentPasswordNotMatched;


class changepasswordController extends Controller {
	public function load()
	{
		return null;
	}
	public function changepass($OldPass,$NewPass)
	{
		$su=new sessionuser();
		$SysUserE=new roleSystemUserEntity();
		$user=$SysUserE->Select(array("id","password"), array($su->getSystemUserID(),$OldPass));
		if(count($user)>0)
		{
			$SysUserE->Update($user[0]['id'], null, $NewPass,$NewPass, null);
		}
		else 
			throw new CurrentPasswordNotMatched();
	}
}
?>
