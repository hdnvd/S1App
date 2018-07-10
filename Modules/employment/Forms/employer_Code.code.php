<?php

namespace Modules\employment\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\employment\Controllers\employerController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/06/26 18:03:08
 *@lastUpdate 2015/06/26 18:03:08
 *@SweetFrameworkHelperVersion 1.104
*/


class employer_Code extends FormCode {
	public function load()
	{
		$employerController=new employerController();
		$translator=new ModuleTranslator("employment");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$employerController->load();
		$design=new employer_Design();
		$design->setProvinces($Result['provinces']);
		return $design->getBodyHTML();
	}
	public function Register_Click()
	{
	    $employerController=new employerController();
		$translator=new ModuleTranslator("employment");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new employer_Design();
		$Result=$employerController->Register($design->getCity()->getSelectedID(),$design->getFinance_type()->getSelectedID(),$design->getTitle()->getValue(),$design->getMob()->getValue(),$design->getDistance()->getValue(),$design->getMail()->getValue(),$design->getPass()->getValue());
		$design->setProvinces($Result['provinces']);
		
		return $design->getBodyHTML();
	}
}
?>
