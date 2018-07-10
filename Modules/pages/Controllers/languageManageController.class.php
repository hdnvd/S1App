<?php

namespace Modules\pages\Controllers;

use core\CoreClasses\services\Controller;
use services\pages\EntityObjects\pageEntityObject;
use Modules\pages\Entity\pageEntity;
use Modules\pages\Entity\languageEntity;

/**
 *
 * @author Hadi Nahavandi
 * @version 0.1
 * @last Edit 2014 May 13 22:49
 *        
 */
class languageManageController extends Controller {
	public function loadAll()
	{
		$e=new languageEntity();
		return $e->getLanguages();
	}
}

?>