<?php

namespace Modules\mail\Controllers;
use core\CoreClasses\services\Controller;
use Modules\mail\Entity\mailEntity;
use Modules\users\PublicClasses\sessionuser;
use Modules\mail\Entity\BoxEntity;
use Modules\mail\Entity\BoxType;
use Modules\mail\Entity\MailBoxEntity;
use Modules\mail\Entity\AttachmentEntity;
use Modules\users\Entity\userEntity;
use Modules\users\PublicClasses\User;
use Modules\users\Entity\roleUserEntity;


class sendmailController extends Controller {
	public function load()
	{
		$userE=new userEntity();
		$Su=new sessionuser();
		$user=new User($Su->getSystemUserID());
		//TEMPORARY CHANGE(All Users Sholud Be Loaded For All But For IELTS It Loads All Only For Admins)
		$Roles=$user->getSystemUserRoles();
		if($Roles[0]==1)
			return $userE->getAll();
		else 
		{
			$RUE=new roleUserEntity();
			return $RUE->SelectRoleUsers(array("user.id as value,CONCAT_WS(name,family) AS text"), 1);
		}
	}
	public function send($Subject,$Text,$RecieverID,array $Files)
	{
		$mE=new mailEntity();
		$su=new sessionuser();
		$SenderID=$su->getSystemUserID();
		$mailID=$mE->InserMail($Subject, $Text, $SenderID);
		$bE=new BoxEntity();
		
		$senderBox=$bE->SelectUserBox($SenderID, BoxType::Sent);
		$SenderBoxID=-1;
		if(is_null($senderBox) || count($senderBox)<=0)
			$SenderBoxID=$bE->Insert($SenderID, BoxType::Sent);
		else 
			$SenderBoxID=$senderBox[0]["id"];
		
		$RecieverBox=$bE->SelectUserBox($RecieverID, BoxType::Inbox);
		$RecieverBoxID=-1;
		if(is_null($RecieverBox) || count($RecieverBox)<=0)
			$RecieverBoxID=$bE->Insert($RecieverID, BoxType::Inbox);
		else
			$RecieverBoxID=$RecieverBox[0]["id"];
		
		$bmE=new MailBoxEntity();
		$bmE->Insert($SenderBoxID, $mailID);
		$bmE->Insert($RecieverBoxID, $mailID);
		
		$maE=new AttachmentEntity();
		for($i=0;!is_null($Files) && !is_null($Files[$i]);$i++)
			$maE->Insert($Files[$i]['url'], $mailID);
		return true;
		
	}
}
?>
