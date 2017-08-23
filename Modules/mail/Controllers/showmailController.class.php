<?php

namespace Modules\mail\Controllers;
use core\CoreClasses\services\Controller;
use Modules\mail\Entity\mailEntity;
use Modules\mail\Entity\AttachmentEntity;
use Modules\users\PublicClasses\User;


class showmailController extends Controller {
	public function load($MailID)
	{
		$mE=new mailEntity();
		$result['mail']=$mE->Select($MailID,null,null);
		$MailID=$result['mail'][0]['id'];
		$result['attachment']=(new AttachmentEntity())->Find(null, null, $MailID);
		$senderID=$result['mail'][0]['sender_fid'];
		$User=new User($senderID);
		$result['from']=$User->getUserInfo('name') . " " . $User->getUserInfo('family');
		return $result;
	}
}
?>
