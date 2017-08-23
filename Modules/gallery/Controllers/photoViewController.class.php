<?php

namespace Modules\gallery\Controllers;

use core\CoreClasses\services\Controller;
use Modules\gallery\Entity\gallery_photoEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\parameters\Entity\ParameterEntity;

/**
 *
 * @author nahavandi
 *        
 */
class photoViewController extends Controller {
	public function getProduct($ID)
	{
		$languageID=CurrentLanguageManager::getCurrentLanguageID();
		$ent=new gallery_photoEntity();
		$result['photo']=$ent->Select($ID, null, null, null, null,999,time(),null, array(), array(), "0,1");
	    $param=new ParameterEntity();
	    $param=$param->getParameter("gallery_showphototitle");
	    $param=$param[0]['value'];
	    $result['showtitle']=$param;
		return $result;
	}
}

?>