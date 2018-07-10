<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Controllers\tagsController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/02/25 12:57:43
 *@lastUpdate 2015/02/25 12:57:43
 *@SweetFrameworkHelperVersion 1.102
*/


class tags_Code extends FormCode {
	public function load()
	{
		$tagsController=new tagsController();
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$tagsController->load();
		$design=new tags_Design();
		$design->setTags($Result['tags']);
		return $design->getBodyHTML();
	}
}
?>
