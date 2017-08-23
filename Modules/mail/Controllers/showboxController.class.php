<?php

namespace Modules\mail\Controllers;
use core\CoreClasses\services\Controller;
use Modules\mail\Entity\BoxEntity;
use Modules\users\PublicClasses\sessionuser;
use Modules\mail\Entity\MailBoxEntity;
use Modules\mail\Entity\mailEntity;
use Modules\mail\Entity\UserBoxMailsEntity;


class showboxController extends Controller {
	public function load($BoxType)
	{
		$su=new sessionuser();
		$SysUserID=$su->getSystemUserID();
		$ubmE=new UserBoxMailsEntity();
		$result=$ubmE->GetUserBoxMails($SysUserID, $BoxType);
		return $result;
	}
}
?>
