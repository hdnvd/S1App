<?php

namespace Modules\mail\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\mail\Controllers\sendmailController;
use Modules\files\PublicClasses\uploadHelper;
use core\CoreClasses\Sweet2DArray;
use Modules\users\PublicClasses\User;


class sendmail_Code extends FormCode {
	public function load()
	{
		$sendmailController=new sendmailController();
		$translator=new ModuleTranslator("mail");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$sendmailController->load();
		$Fields=Sweet2DArray::array_filp($Fields);
		$uids=$Fields['value'];
		$names=array();
		$sysUIds=array();
		for($i=0;$i<count($uids);$i++)
		{
			
			$sysUIds[$i]=User::FindSystemUserFromUserID($uids[$i]);
			$user=new User($sysUIds[$i]);
			$names[$i]=$user->getUserInfo('name'). " " . $user->getUserInfo('family');
		}
		
		$design=new sendmail_Design();
		$design->setRecieverIDs($sysUIds);
		$design->setRecieverNames($names);
		$design->setLblReciever($translator->getWordTranslation("lblreciever"));
		$design->setLblSubject($translator->getWordTranslation("lblsubject"));
		$design->setTxtSubject("");
		$design->setLblMailText($translator->getWordTranslation("lblmailtext"));
		$design->setTxtMailText("");
		$design->setLblMailFile1($translator->getWordTranslation("lblMailFile1"));
		$design->setLblMailFile2($translator->getWordTranslation("lblMailFile2"));
		$design->setLblMailFile3($translator->getWordTranslation("lblMailFile3"));
		$design->setBtnSend($translator->getWordTranslation("btnSend"));
		$design->setBtnSendAction("send");
		
		return $design->getBodyHTML();
	}
	public function send_Click()
	{
		$translator=new ModuleTranslator("mail");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		
		$recieverID=$_POST['recieverID'];
		$txtSubject=$_POST['txtSubject'];
		$txtMailText=$_POST['txtMailText'];
		$files[0]=$this->UploadFile("file1");
		$files[1]=$this->UploadFile("file2");
		$files[2]=$this->UploadFile("file3");
		$Ctl=new sendmailController();
		$Ctl->send($txtSubject, $txtMailText, $recieverID,$files);
		echo $translator->getWordTranslation("mailsent");
	}
	private function UploadFile($InputName)
	{
		return uploadHelper::UploadFileInput($InputName, "content/files/mail/attached/");
	}
}
?>
