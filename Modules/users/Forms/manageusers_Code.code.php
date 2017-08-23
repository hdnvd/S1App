<?php

namespace Modules\users\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Controllers\manageusersController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/3/1 - 2016/05/21 20:34:37
 *@lastUpdate 1395/3/1 - 2016/05/21 20:34:37
 *@SweetFrameworkHelperVersion 1.112
*/


class manageusers_Code extends FormCode {
	public function load()
	{
		$manageusersController=new manageusersController();
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$manageusersController->load();
		$design=new manageusers_Design();
		$design->setUsers($Result['users']);
		return $design->getBodyHTML();
	}
}
?>
