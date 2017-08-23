<?php

namespace Modules\common\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\common\Controllers\formnotfoundController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2016/05/15 22:53:17
 *@lastUpdate 2016/05/15 22:53:17
 *@SweetFrameworkHelperVersion 1.109
*/


class formnotfound_Code extends FormCode {
	public function load()
	{
		$formnotfoundController=new formnotfoundController();
		$translator=new ModuleTranslator("common");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$formnotfoundController->load();
		$design=new formnotfound_Design();
		return $design->getBodyHTML();
	}
}
?>
