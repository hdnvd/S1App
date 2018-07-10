<?php

namespace Modules\company\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\company\Controllers\lastcustomersController;
use Modules\common\PublicClasses\AppRooter;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/02/19 15:54:05
 *@lastUpdate 2015/03/11 18:28:08
 *@SweetFrameworkHelperVersion 1.102
*/


class lastcustomers_Code extends FormCode {
    public function getTitle()
    {
        return "آخرین مشتریان";
    }
    public function getCanonicalURL()
    {
        $link=new AppRooter(null, "customers");
        $this->setCanonicalURL($link->getAbsoluteURL());
        return parent::getCanonicalURL();
    }
	public function load()
	{
		$lastcustomersController=new lastcustomersController();
		$translator=new ModuleTranslator("company");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$lastcustomersController->load();
		$design=new lastcustomers_Design();
		$design->setCustomers($Result['customers']);
		return $design->getBodyHTML();
	}
}
?>
