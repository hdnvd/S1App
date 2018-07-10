<?php

namespace Modules\gallery\Controllers;

use core\CoreClasses\services\Controller;
use Modules\gallery\Entity\gallery_photoEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\gallery\Entity\gallery_viewalbumphotoinfoEntity;
use Modules\gallery\Entity\gallery_albumEntity;
/**
 *
 * @author hadi
 *        
 */
class photomanageController extends Controller{
	public function load($Albumid=null)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$FullEnt=new gallery_viewalbumphotoinfoEntity();
		return $FullEnt->Select(null, null, null, null, null, $Language_fid, null, null, null, null,-1,null,null,null, array(), array(), "0,200");
		
	}
	
}

?>