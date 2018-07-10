<?php

namespace Modules\gallery\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\gallery\Controllers\managealbumsController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2014/12/21 13:13:37
 *@lastUpdate 2014/12/21 13:13:37
*/


class managealbums_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setThemePage("admin.php");
	}
	public function load()
	{
		$managealbumsController=new managealbumsController();
		$translator=new ModuleTranslator("gallery");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$managealbumsController->load();
		$design=new managealbums_Design();
		$design->setAlbums($Fields['albums']);
		return $design->getBodyHTML();
	}
}
?>
