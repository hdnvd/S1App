<?php

namespace Modules\appman\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\appman\Controllers\generatekeyController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/10/16 23:17:12
 *@lastUpdate 2015/10/16 23:17:12
 *@SweetFrameworkHelperVersion 1.107
*/


class generatekey_Code extends FormCode {
	public function load()
	{
		$generatekeyController=new generatekeyController();
		$translator=new ModuleTranslator("appman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$generatekeyController->load();
		$design=new generatekey_Design();
		return $design->getBodyHTML();
	}
	public function Btngenerate_Click()
	{
		$generatekeyController=new generatekeyController();
		$translator=new ModuleTranslator("appman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new generatekey_Design();
		$Result=$generatekeyController->generateKey($design->getTxtkeycount()->getValue(),1);
		$Keys=$Result['keys'];
		$design->setKeys($Keys);
		return $design->getBodyHTML();
	}
}
?>
