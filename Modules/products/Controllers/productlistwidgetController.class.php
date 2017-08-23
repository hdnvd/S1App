<?php

namespace Modules\products\Controllers;

use core\CoreClasses\services\Controller;
use Modules\products\Entity\ProductGroupEntity;
use Modules\pages\Entity\languageEntity;
use Modules\products\Entity\products_viewgroupproductsinfoEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;

/**
 *
 * @author nahavandi
 * @
 *        
 */
class productlistwidgetController extends Controller {
	public function load($OrderBy,$Count,$IsDescending)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$Ent=new products_viewgroupproductsinfoEntity();
		$result["products"]=$Ent->SelectByFields(null, null, null, null, null, null, null, null, null, null, null, null, null, null, $Language_fid, array("visits"), array(true));
		return $result;
	}
	
	
}

?>