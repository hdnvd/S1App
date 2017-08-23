<?php

namespace Modules\products\Controllers;

use core\CoreClasses\services\Controller;
use Modules\products\BusinessObjects\productGroupBO;
use Modules\products\Entity\ProductGroupEntity;
use Modules\pages\Entity\languageEntity;
use Modules\products\Entity\ProductEntity;
use Modules\products\BusinessObjects\productGroupLangBO;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Entity\products_productgroupEntity;

/**
 *
 * @author nahavandi
 *        
 */
class listgroupsController extends Controller {
	private $GroupInfo;
	public function load()
	{
		$Lang=CurrentLanguageManager::getCurrentLanguageID();
		$entity=new products_productgroupEntity();
		$result['groups']=$entity->Select(null, null, $Lang, null, null,null, "0,100", null, null);
		return $result;
	}
	
}

?>