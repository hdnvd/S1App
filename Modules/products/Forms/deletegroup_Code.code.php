<?php

namespace Modules\products\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Controllers\deletegroupController;
use Modules\languages\PublicClasses\LanguageTranslator;


class deletegroup_Code extends FormCode {
public function load()
	{
		$id=$_GET['id'];
		$deletegroupController=new deletegroupController();
		$translator=new LanguageTranslator();
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$deletegroupController->load($id);
		$design=new message_Design();
		$design->setMessage("گروه محصول با موفقیت حذف شد");
		return $design->getBodyHTML();
	}
}
?>
