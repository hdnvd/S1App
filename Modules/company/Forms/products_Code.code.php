<?php

namespace Modules\company\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\company\Controllers\productsController;
use Modules\common\PublicClasses\AppRooter;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/02/19 12:34:08
 *@lastUpdate 2015/03/11 18:28:08
*/


class products_Code extends FormCode {

    public function getTitle()
    {
        return "نمونه کارها";
    }

    public function getCanonicalURL()
    {
        $link=new AppRooter(null, "products");
        $this->setCanonicalURL($link->getAbsoluteURL());
        return parent::getCanonicalURL();
    }
	public function load()
	{
		$productsController=new productsController();
		$translator=new ModuleTranslator("company");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$productsController->load();
		$design=new products_Design();
		$design->setProducts($Fields['products']);
		return $design->getBodyHTML();
	}
}
?>
