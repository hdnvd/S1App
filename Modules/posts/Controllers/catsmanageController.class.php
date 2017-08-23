<?php

namespace Modules\posts\Controllers;
use core\CoreClasses\services\Controller;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Entity\posts_languagecategoryEntity;


class catsmanageController extends Controller {
	public function load()
	{
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$CE=new posts_languagecategoryEntity();
		$result['cats']=$CE->Select(array("*"), null, $LanguageID, null, null,null);
		return $result;
	}
}
?>
