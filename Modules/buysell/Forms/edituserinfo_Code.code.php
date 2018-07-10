<?php

namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\edituserinfoController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/10/6 - 2016/12/26 02:02:59
 *@lastUpdate 1395/10/6 - 2016/12/26 02:02:59
 *@SweetFrameworkHelperVersion 1.112
*/


class edituserinfo_Code extends FormCode {
	public function load()
	{
		$edituserinfoController=new edituserinfoController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$edituserinfoController->load();
		$design=new edituserinfo_Design();
		return $design->getBodyHTML();
	}
	public function Btnsave_Click()
	{
		$edituserinfoController=new edituserinfoController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$edituserinfoController->load();
		$design=new edituserinfo_Design();
		return $design->getBodyHTML();
	}
}
?>
