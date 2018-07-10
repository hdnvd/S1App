<?php

namespace Modules\slider\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\slider\Controllers\slidemanagerController;


class slidemanager_Code extends FormCode {
	public function load()
	{
		$slidemanagerController=new slidemanagerController();
		$translator=new ModuleTranslator("slider");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$slidemanagerController->load();
		$design=new slidemanager_Design();
		return $design->getBodyHTML();
	}
}
?>
