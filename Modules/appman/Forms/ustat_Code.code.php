<?php

namespace Modules\appman\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\appman\Controllers\ustatController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/3/29 - 2016/06/18 16:23:34
 *@lastUpdate 1395/3/29 - 2016/06/18 16:23:34
 *@SweetFrameworkHelperVersion 1.112
*/


class ustat_Code extends FormCode {
	public function load()
	{
		$ustatController=new ustatController();
		$translator=new ModuleTranslator("appman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$ustatController->load();
		$design=new ustat_Design();
		return $design->getBodyHTML();
	}
	public function Btnsave_Click()
	{
		$ustatController=new ustatController();
		$translator=new ModuleTranslator("appman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new ustat_Design();
		$Result=$ustatController->Add($design->getTxtf1()->getValue(), $design->getTxtf2()->getValue(), $design->getTxtf3()->getValue(), $design->getTxtf4()->getValue(), $design->getTxtf5()->getValue(), $design->getTxtf6()->getValue(), $design->getTxtf7()->getValue(), $design->getTxtf8()->getValue());
		
		return $design->getBodyHTML();
	}
}
?>
