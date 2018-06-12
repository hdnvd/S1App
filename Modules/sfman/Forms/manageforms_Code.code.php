<?php

namespace Modules\sfman\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Controllers\manageformsController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/10/9 - 2016/12/29 02:42:14
 *@lastUpdate 1395/10/9 - 2016/12/29 02:42:14
 *@SweetFrameworkHelperVersion 1.112
*/


class manageforms_Code extends FormCode {
	public function load()
	{
		$manageformsController=new manageformsController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$manageformsController->load();
		$design=new manageforms_Design();
		$design->setData($Result);
		return $design->getBodyHTML();
	}
}
?>
