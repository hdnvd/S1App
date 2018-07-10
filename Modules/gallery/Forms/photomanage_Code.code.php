<?php

namespace Modules\gallery\Forms;

use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\gallery\Controllers\photoListController;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\gallery\Controllers\photomanageController;

/**
 *
 * @author nahavandi
 *        
 */
class photomanage_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setThemePage("admin.php");
	}
	public function load()
	{
		$langID=CurrentLanguageManager::getCurrentLanguageID();
		$controller=new photomanageController();
		$photo=$controller->load();
		$design=new photomanage_Design();
		$design->setPhotos($photo);
		return $design->getBodyHTML();
		
	}
}

?>