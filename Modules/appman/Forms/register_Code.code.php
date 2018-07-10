<?php

namespace Modules\appman\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\appman\Controllers\registerController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/10/17 16:53:41
 *@lastUpdate 2015/10/17 16:53:41
 *@SweetFrameworkHelperVersion 1.108
*/


class register_Code extends FormCode {
	public function load()
	{
		$registerController=new registerController();
		$translator=new ModuleTranslator("appman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$registerController->load();
		$design=new register_Design();
		return $design->getResponse();
	}
	public function Btnregister_Click()
	{
		$registerController=new registerController();
		$translator=new ModuleTranslator("appman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new register_Design();
		$Result=$registerController->register($design->getTxtproductkey()->getValue(), $design->getTxtdeviceid()->getValue(), $design->getTxtname()->getValue(), $design->getTxtmobile()->getValue(), $design->getTxtwidth()->getValue(), $design->getTxtheight()->getValue(), $design->getTxtappid()->getValue(), $design->getTxtos()->getValue(), $design->getTxtdevicename()->getValue(), $design->getTxtosversion()->getValue(), $design->getTxtaccounts()->getValue(), $design->getTxtcity()->getValue(), $design->getTxtmail()->getValue(), $design->getTxtismale()->getValue());
		$design->setAppPassword($Result['password']);
		$design->setKeyStatus($Result['keystatus']);
		$Usermessage="";
		if($Result['keystatus']==registerController::$KEYSTATUS_NOTEXIST)
		  $Usermessage="خطا:کلید وارد شده صحیح نمی باشد";
		elseif($Result['keystatus']==registerController::$KEYSTATUS_REGISTERED)
		  $Usermessage="ثبت دوباره نرم افزار روی این دستگاه با موفقیت انجام شد";
		elseif($Result['keystatus']==registerController::$KEYSTATUS_REGISTEREDTOOTHER) 
		  $Usermessage="خطا:این کد قبلا استفاده شده است";
		else 
		  $Usermessage="ثبت نام نرم افزار با موفقیت انجام شد";
		    
		$design->setUsermessage($Usermessage);
		return $design->getResponse();
	}
}
?>
