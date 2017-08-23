<?php

namespace Modules\posts\Controllers;
use core\CoreClasses\services\Controller;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Entity\posts_postEntity;
use Modules\posts\Entity\posts_view_languagepostEntity;


class postsmanageController extends Controller {
	public function load()
	{
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$CE=new posts_view_languagepostEntity();
		$result['posts']=$CE->Select($LanguageID);
		return $result;
	}
}
?>
