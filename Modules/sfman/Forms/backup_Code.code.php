<?php

namespace Modules\sfman\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Controllers\backupController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2016/05/18 19:52:46
 *@lastUpdate 2016/05/18 19:52:46
 *@SweetFrameworkHelperVersion 1.110
*/


class backup_Code extends FormCode {
	public function load()
	{
		$backupController=new backupController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$backupController->load();
		$design=new backup_Design();
		return $design->getBodyHTML();
	}
	public function Btnappbackup_Click()
	{
		$backupController=new backupController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$backupController->GenerateAppBackup();
		$design=new backup_Design();
		$design->setLink($Result['fileurl']);
		return $design->getBodyHTML();
	}
	public function Btnframeworkbackup_Click()
	{
		$backupController=new backupController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$backupController->GenerateFrameworkBackup();
		$design=new backup_Design();
		$design->setLink($Result['fileurl']);
		return $design->getBodyHTML();
	}
	public function Btndbbackup_Click()
	{
		$backupController=new backupController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$backupController->GenerateDBBackup();
		$design=new backup_Design();
		$design->setLink($Result['fileurl']);
		return $design->getBodyHTML();
	}
	public function Btnfilesbackup_Click()
	{
		$backupController=new backupController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$backupController->GenerateFilesBackup();
		$design=new backup_Design();
		$design->setLink($Result['fileurl']);
		return $design->getBodyHTML();
	}
	public function Btnthemebackup_Click()
	{
		$backupController=new backupController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$backupController->GenerateThemeBackup();
		$design=new backup_Design();
		$design->setLink($Result['fileurl']);
		return $design->getBodyHTML();
	}

}
?>
