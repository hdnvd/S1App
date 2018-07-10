<?php

namespace Modules\employment\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\employment\Controllers\registeremployeeController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/06/28 11:26:00
 *@lastUpdate 2015/06/28 11:26:00
 *@SweetFrameworkHelperVersion 1.105
*/


class registeremployee_Code extends FormCode {
	public function load()
	{
		$registeremployeeController=new registeremployeeController();
		$translator=new ModuleTranslator("employment");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$registeremployeeController->load();
		$design=new registeremployee_Design();
		$design->setProvinces($Result['provinces']);
		return $design->getBodyHTML();
	}
	public function Register_Click()
	{
		$registeremployeeController=new registeremployeeController();
		$translator=new ModuleTranslator("employment");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$registeremployeeController->load();
		$design=new registeremployee_Design();
		return $design->getBodyHTML();
	}
}
?>
