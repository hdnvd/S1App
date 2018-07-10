<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\GRecaptchaValidationStatus;
use core\CoreClasses\services\FormCode;
use Modules\buysell\Exceptions\nosamepassException;
use Modules\common\Forms\message_Design;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\fastsignupController;
use Modules\users\Exceptions\TooSmallPasswordException;
use Modules\users\Exceptions\TooSmallUsernameException;
use Modules\users\Exceptions\UsernameExistsException;

/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-20 - 2017-02-08 16:00
*@lastUpdate 1395-11-20 - 2017-02-08 16:00
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class fastsignup_Code extends FormCode {
    
	public function load()
	{
		$fastsignupController=new fastsignupController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$fastsignupController->load();
		$design=new fastsignup_Design();
		$design->setData($Result);
		return $design->getBodyHTML();
	}

    /**
     * @return string
     */
    public function btnSignup_Click()
    {
        $fastsignupController = new fastsignupController();
        $translator = new ModuleTranslator("buysell");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        $design = new fastsignup_Design();
        $txtName = $design->getTxtName()->getValue();
        $txtEmail = $design->getTxtEmail()->getValue();
        $txtMobile = $design->getTxtMobile()->getValue();
        $cmbCity_ID = $design->getCmbCity()->getSelectedID();
        $txtpassword = $design->getTxtpassword()->getValue();
        $txtpassword2 = $design->getTxtpassword2()->getValue();
        $recaptchaStatus=$design->getRecaptcha()->getValidationStatus();
        if ($recaptchaStatus == GRecaptchaValidationStatus::$VALID) {
            try {
                $Result = $fastsignupController->BtnSignup($txtName, $txtEmail, $txtMobile, $cmbCity_ID, $txtpassword, $txtpassword2);
            } catch (nosamepassException $ex) {
                return "رمز عبور و تکرار آن یکی نیست";
            } catch (UsernameExistsException $ex2) {
                return " کاربری با این شماره موبایل قبلا ثبت نام کرده است";
            } catch (TooSmallUsernameException $ex3) {
                return " لطفا شماره موبایل صحیح را وارد کنید ";
            } catch (TooSmallPasswordException $ex3) {
                return "کلمه عبور باید بیشتر از 8 حرف باشد";
            }
            $design->setData($Result);
		    return "ثبت نام با موفقیت انجام شد";
        }
        else if($recaptchaStatus == GRecaptchaValidationStatus::$NOTCLICKED)
        {
            $design = new message_Design();
            $design->setMessageType("error");
            $design->setMessage("سوال امنیتی پاسخ داده نشده");
            return $design->getBodyHTML();
        }
        else
        {
            $design = new message_Design();
            $design->setMessageType("error");
            $design->setMessage("پاسخ سوال امنیتی صحیح نبود،لطفا دوباره تلاش کنید");
            return $design->getBodyHTML();
        }
	}
}
?>