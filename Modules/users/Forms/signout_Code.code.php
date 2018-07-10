<?php

namespace Modules\users\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Controllers\signoutController;


class signout_Code extends FormCode {
	public function load()
	{
		$signoutController=new signoutController();
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$signoutController->load();
		$_SESSION['username']="";
		$_SESSION['password']="";
		$_SESSION['userid']="";
		$design=new showlogin_Design();
		$message=$translator->getWordTranslation("loggedout");
		$design->setMessage($message);
		$design->setMessageType("normal");
		return $design->getBodyHTML();
	}
}
?>
