<?php

namespace Modules\sfman\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Controllers\managecacheController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2016/05/14 16:05:05
 *@lastUpdate 2016/05/14 16:05:05
 *@SweetFrameworkHelperVersion 1.109
*/


class managecache_Code extends FormCode {
	public function load()
	{
		$managecacheController=new managecacheController();
		$translator=new ModuleTranslator("sftools");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$managecacheController->load();
		$design=new managecache_Design();
		return $design->getBodyHTML();
	}
	public function Btnclearall_Click()
	{
		$managecacheController=new managecacheController();
		$translator=new ModuleTranslator("sftools");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$managecacheController->clearcache();
		$design=new managecache_Design();
		$fcount=$Result['deletedfiles'];
		$design->setResultText("cache با موفقیت پاکسازی شد و تعداد $fcount فایل حذف شد");
		return $design->getBodyHTML();
	}
}
?>
