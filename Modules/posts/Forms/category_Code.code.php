<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Controllers\categoryController;
use core\CoreClasses\Sweet2DArray;


class category_Code extends FormCode {
	public function load()
	{
		$categoryController=new categoryController();
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$categoryController->load();
		$design=new category_Design();
		return $design->getBodyHTML();
	}
}
?>
