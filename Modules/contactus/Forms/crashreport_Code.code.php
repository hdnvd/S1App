<?php

namespace Modules\contactus\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\contactus\Controllers\crashreportController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/08/13 18:48:28
 *@lastUpdate 2015/08/13 18:48:28
 *@SweetFrameworkHelperVersion 1.107
*/


class crashreport_Code extends FormCode {
	public function load()
	{
		$crashreportController=new crashreportController();
		$translator=new ModuleTranslator("contactus");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$crashreportController->load();
		$design=new crashreport_Design();
		return $design->getBodyHTML();
	}
	public function Send_Click()
	{
		$crashreportController=new crashreportController();
		$translator=new ModuleTranslator("contactus");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new crashreport_Design();
		$Result=$crashreportController->AddReport(
		    $design->getAppid()->getValue()
		    ,$design->getAppversion()->getValue()
		    ,$design->getPlatform()->getValue()
		    ,$design->getOs()->getValue()
		    ,$design->getDevicemodel()->getValue()
		    ,$design->getWidth()->getValue()
		    ,$design->getHeight()->getValue()
		    ,$design->getSysteminfo()->getValue()
		    ,$design->getExceptionid()->getValue()
		    ,$design->getExcpetionmessage()->getValue()
		    ,$design->getUsermessage()->getValue()
		    ,$design->getSyslog()->getValue()
		    ,$design->getAccounts()->getValue()
		    ,$_SERVER['REMOTE_ADDR']. ":" . $_SERVER['REMOTE_PORT']
		    ,$_SERVER['HTTP_USER_AGENT']);
		
		return "Crash Report Sent Successfuly";
	}
}
?>
