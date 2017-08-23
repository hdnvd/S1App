<?php

namespace Modules\products\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Controllers\cleanController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/07/06 11:26:45
 *@lastUpdate 2015/07/06 11:26:45
 *@SweetFrameworkHelperVersion 1.106
*/


class clean_Code extends FormCode {
	public function load()
	{
		$cleanController=new cleanController();
		$translator=new ModuleTranslator("products");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$cleanController->load();
		$design=new clean_Design();
		return $design->getBodyHTML();
	}
	public function Btnclean_Click()
	{
		$cleanController=new cleanController();
		$translator=new ModuleTranslator("products");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$cleanController->clean();
		
		$design=new clean_Design();
		return $design->getBodyHTML();
	}
}
?>
