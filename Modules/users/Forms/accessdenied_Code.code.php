<?php

namespace Modules\users\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;


class accessdenied_Code extends FormCode {
	public function load()
	{
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());

		$design=new accessdenied_Design();
		$design->setMessage($translator->getWordTranslation("accessdenied"));
		return $design->getBodyHTML();
	}
}
?>
