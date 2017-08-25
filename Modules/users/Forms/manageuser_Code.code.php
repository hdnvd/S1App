<?php

namespace Modules\users\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Controllers\manageuserController;
use core\CoreClasses\SweetDate;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/3/1 - 2016/05/21 20:35:08
 *@lastUpdate 1395/3/1 - 2016/05/21 20:35:08
 *@SweetFrameworkHelperVersion 1.112
*/


class manageuser_Code extends FormCode {

    public function __construct($namespace=null)
    {
        parent::__construct($namespace);
        $this->setThemePage("admin.php");
        $this->setTitle("مدیریت کاربر");
    }
	public function load()
	{
		$manageuserController=new manageuserController();
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$manageuserController->load($_GET['id']);
		$design=new manageuser_Design();
		$UnixTimeStamp=$Result['user'][0]['signuptime'];
		$Time=new SweetDate();
		$Result['user'][0]['signuptime']=$Time->date("l d-m-Y H:i",$UnixTimeStamp,false,true);
		$design->setUser($Result['user'][0]);
		$design->setEnabledFields($Result['enabledfields']);
		return $design->getBodyHTML();
	}
}
?>
