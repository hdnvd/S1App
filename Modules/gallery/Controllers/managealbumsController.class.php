<?php

namespace Modules\gallery\Controllers;
use core\CoreClasses\services\Controller;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\gallery\Entity\gallery_albumEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2014/12/21 13:13:37
 *@lastUpdate 2014/12/21 13:13:37
*/


class managealbumsController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$Ent=new gallery_albumEntity();
		$result=array();
		$result['albums']=$Ent->Select(null, null, null, null, $Language_fid, array("id"), array(true), "0,100");
		return $result;
	}
}
?>
