<?php

namespace Modules\posts\Controllers;
use core\CoreClasses\services\Controller;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Entity\posts_languagecategoryEntity;
use Modules\posts\Entity\posts_categoryEntity;


class catmanageController extends Controller {
	public function load($ID=null)
	{
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$result=array();
		$CE=new posts_languagecategoryEntity();
		if(!is_null($ID))
			$result['cat']=$CE->Select(array("*"), $ID, $LanguageID, null, null,null);
		$result['cats']=$CE->Select(array("*"), null, $LanguageID, null, null,null);
		return $result;
	}
	public function add($LatinTitle,$Title,$MotherID)
	{
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$LCE=new posts_languagecategoryEntity();
		$LCE->Insert($LanguageID, $Title, $LatinTitle, $MotherID);
		return true;
	}
	public function edit($ID,$LatinTitle,$Title,$MotherID)
	{
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$LCE=new posts_languagecategoryEntity();
		$LCE->Update($ID, $LanguageID, $Title, $LatinTitle, $MotherID);
		return true;
	}
	public function delete($ID)
	{
		$LanguageID=CurrentLanguageManager::getCurrentLanguageID();
		$LCE=new posts_languagecategoryEntity();
		$LCE->Delete($ID);
		return true;
	}
}
?>
