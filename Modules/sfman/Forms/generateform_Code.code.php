<?php

namespace Modules\sfman\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Controllers\generateformController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/10/9 - 2016/12/29 02:25:33
 *@lastUpdate 1395/10/9 - 2016/12/29 02:25:33
 *@SweetFrameworkHelperVersion 1.112
*/


class generateform_Code extends FormCode {
	public function load()
	{
		$generateformController=new generateformController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$generateformController->load();
		$design=new generateform_Design();
		$design->getCmbModule()->setDataArray($Result['modules']);
		$design->getCmbModule()->setTextField("caption");
		return $design->getBodyHTML();
	}
	public function BtnGenerate_Click()
	{
		$generateformController=new generateformController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new generateform_Design();
		$Result=$generateformController->makeform($design->getCmbModule()->getSelectedID(),$design->getTxtFormName()->getValue(),$design->getTxtFormTitle()->getValue());


		return $design->getBodyHTML();
	}
}
?>
