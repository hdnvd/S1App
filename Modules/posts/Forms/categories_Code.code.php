<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Controllers\categoriesController;


class categories_Code extends FormCode {
	public function load()
	{
		$categoriesController=new categoriesController();
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$categoriesController->load();
		$design=new categories_Design();
		return $design->getBodyHTML();
	}
}
?>
