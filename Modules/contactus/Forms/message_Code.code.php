<?php

namespace Modules\contactus\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\contactus\Controllers\messageController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/06/04 19:13:00
 *@lastUpdate 2015/06/04 19:13:00
 *@SweetFrameworkHelperVersion 1.102
*/


class message_Code extends FormCode {
    public function __construct($namespace=null)
    {
        parent::__construct($namespace);
        $this->setThemePage("admin.php");
        $this->setTitle("مدیریت پیام های دریافتی");
    }
	public function load()
	{
		$messageController=new messageController();
		$translator=new ModuleTranslator("contactus");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$messageController->load($_GET['id']);
		$design=new message_Design();
		$design->setMessage($Result['message']);
		return $design->getBodyHTML();
	}
}
?>
