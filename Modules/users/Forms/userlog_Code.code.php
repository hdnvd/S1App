<?php

namespace Modules\users\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Controllers\userlogController;


class userlog_Code extends FormCode {
	public function load()
	{
		$userlogController=new userlogController();
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$userlogController->load();
		$design=new userlog_Design();
		return $design->getBodyHTML();
	}
}
?>
