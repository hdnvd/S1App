<?php

namespace Modules\sfman\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Controllers\restoreController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/3/1 - 2016/05/21 21:19:45
 *@lastUpdate 1395/3/1 - 2016/05/21 21:19:45
 *@SweetFrameworkHelperVersion 1.112
*/


class restore_Code extends FormCode {
	public function load()
	{
		$restoreController=new restoreController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$restoreController->load();
		$design=new restore_Design();
		return $design->getBodyHTML();
	}
	public function Btnrestoreapp_Click()
	{
		$restoreController=new restoreController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new restore_Design();
		$Result=$restoreController->restoreApp($design->getFlbackup()->getSelectedFilesName()[0],$design->getFlbackup()->getSelectedFilesTempPath()[0]);
		$design->setMessage("فایل پشتیبانی نرم افزار با موفقیت بازنشانی شد.");
		return $design->getBodyHTML();
	}
	public function Btnrestoreframework_Click()
	{
		$restoreController=new restoreController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new restore_Design();
		$Result=$restoreController->restoreFramework($design->getFlbackup()->getSelectedFilesName()[0],$design->getFlbackup()->getSelectedFilesTempPath()[0]);
		$design->setMessage("فایل پشتیبانی فریمورک با موفقیت بازنشانی شد.");
		return $design->getBodyHTML();
	}
	public function Btnrestoretheme_Click()
	{
		$restoreController=new restoreController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$restoreController->load();
		$design=new restore_Design();
		return $design->getBodyHTML();
	}
	public function Btnrestorefiles_Click()
	{
		$restoreController=new restoreController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$restoreController->load();
		$design=new restore_Design();
		return $design->getBodyHTML();
	}
	public function Btnrestoredb_Click()
	{
		$restoreController=new restoreController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$restoreController->load();
		$design=new restore_Design();
		return $design->getBodyHTML();
	}
}
?>
