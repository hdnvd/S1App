<?php
namespace Modules\test2\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\test2\Controllers\t2Controller;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-07 - 2017-01-26 19:26
*@lastUpdate 1395-11-07 - 2017-01-26 19:26
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class t2_Code extends FormCode {
	public function load()
	{
		$t2Controller=new t2Controller();
		$translator=new ModuleTranslator("test2");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$t2Controller->load();
		$design=new t2_Design();
		$design->setData($Result);
		return $design->getBodyHTML();
	}
}
?>