<?php

namespace Modules\gallery\Controllers;
use core\CoreClasses\services\Controller;
use Modules\gallery\Entity\gallery_albumEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2014/12/20 21:57:52
 *@lastupdate 2014/12/20 21:57:52
*/


class managealbumController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$Ent=new gallery_albumEntity();
		$res['albums']=$Ent->Select(null, null, null, null, $Language_fid, array(), array(), "0,100");
		if($ID!==null)
			$res['album']=$Ent->Select($ID, null, null, null, $Language_fid, array(), array(), "0,100");
		return $res;
	}
	public function Add($Latintitle,$Title,$Mother_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$Ent=new gallery_albumEntity();
		$Ent->Insert($Latintitle, $Title, $Mother_fid, $Language_fid);
	}
	public function Edit($ID,$Latintitle,$Title,$Mother_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$Ent=new gallery_albumEntity();
		$Ent->Update($ID,$Latintitle, $Title, $Mother_fid, $Language_fid);
	}
	public function Delete($ID)
	{
		$Ent=new gallery_albumEntity();
		$Ent->Delete($ID);
	}
}
?>
