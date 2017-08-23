<?php

namespace Modules\mail\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\mail\Controllers\showmailController;
use core\CoreClasses\Sweet2DArray;
use Modules\common\PublicClasses\AppRooter;


class showmail_Code extends FormCode {
	public function load()
	{
		$showmailController=new showmailController();
		$translator=new ModuleTranslator("mail");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$showmailController->load($_GET['id']);
		$MFields=$Fields['mail'];
		$MFields=Sweet2DArray::array_filp($MFields);
		$AFields=$Fields['attachment'];
		$AFields=Sweet2DArray::array_filp($AFields);
		$design=new showmail_Design();
		$design->setLblTitle($MFields['subject'][0]);
		$design->setLblFrom($translator->getWordTranslation("lblfrom"));
		$design->setTxtFrom($Fields['from']);
		$design->setLblText($MFields['text'][0]);
		for($i=0;$i<count($AFields['fileurl']);$i++)
		{
			$AFields['fileurl'][$i]=DEFAULT_PUBLICURL . $AFields['fileurl'][$i];
		}
		$design->setLinks($AFields['fileurl']);
		return $design->getBodyHTML();
	}
}
?>
