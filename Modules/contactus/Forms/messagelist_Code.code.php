<?php

namespace Modules\contactus\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\contactus\Controllers\messagelistController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/06/04 19:12:41
 *@lastUpdate 2015/06/04 19:12:41
 *@SweetFrameworkHelperVersion 1.102
*/


class messagelist_Code extends FormCode {
    public function __construct($namespace=null)
    {
        parent::__construct($namespace);
        $this->setThemePage("admin.php");
        $this->setTitle("مدیریت پیام های دریافتی");
    }
	public function load()
	{
		$messagelistController=new messagelistController();
		$translator=new ModuleTranslator("contactus");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$messagelistController->load();
		
		$design=new messagelist_Design();
		$design->setMessages($Result['messages']);
		return $design->getBodyHTML();
	}
}
?>
