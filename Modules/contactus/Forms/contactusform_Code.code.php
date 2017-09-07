<?php

namespace Modules\contactus\Forms;

use core\CoreClasses\html\GRecaptchaValidationStatus;
use core\CoreClasses\services\FormCode;
use Modules\contactus\Exceptions\EmptyMessageException;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\languages\PublicClasses\LanguageTranslator;
use Modules\contactus\Controllers\contactusController;
use Modules\languages\PublicClasses\ModuleTranslator;

/**
 *
 * @author nahavandi
 *        
 */
class contactusform_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
        $LangName=CurrentLanguageManager::getCurrentLanguageName();
        $translator=new ModuleTranslator("contactus");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$this->setTitle($translator->getWordTranslation("contactus"));
	}
	public function load()
	{
		$LangName=CurrentLanguageManager::getCurrentLanguageName();
		$translator=new LanguageTranslator();
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$controller=new contactusController();
		$result=$controller->load();
		$design=new contactusform_Design();
		$design->setBtnSave($translator->getWordTranslation("send"));
		$design->setLBLFamily($translator->getWordTranslation("family"));
		$design->setLBLMail($translator->getWordTranslation("email"));
		$design->setLBLName($translator->getWordTranslation("name"));
		$design->setLBLTel($translator->getWordTranslation("tel"));
		$design->setLBLMob($translator->getWordTranslation("mobile"));
		$design->setLBLText($translator->getWordTranslation("message"));
		$design->setContactInfos($result['infos']);
		return $design->getBodyHTML();
	}
	public function send_Click()
	{
		$LangName=CurrentLanguageManager::getCurrentLanguageName();
		$translator=new LanguageTranslator();
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        $design=new contactusform_Design();
        $recaptchaStatus=$design->getRecaptcha()->getValidationStatus();
        if ($recaptchaStatus == GRecaptchaValidationStatus::$VALID) {
            try
            {
                $controller = new contactusController();
                $IP = $_SERVER['REMOTE_ADDR'];
                $userinfo = "IP:" . $_SERVER['REMOTE_ADDR'] . "\nPORT:" . $_SERVER['REMOTE_PORT'] . "\nUser Agent:" . $_SERVER['HTTP_USER_AGENT'] . "\nTime:" . date('Y-m-d G:i:s');
                $controller->send($_POST['txtname'], $_POST['txtfamily'], $_POST['txttel'], $_POST['txtmob'], $_POST['txtmail'], $_POST['txttext'], $IP, $userinfo);
                $messagetouser = $translator->getWordTranslation("messagesent");
                return $messagetouser;
            }
            catch (EmptyMessageException $Ex1)
            {
                return "متن پیام نباید خالی باشد";
            }
            catch (\Exception $Ex)
            {
                return "با عرض پوزش،خطایی در ارسال پیام بوجود آمد";
            }
        }
        else if($recaptchaStatus == GRecaptchaValidationStatus::$NOTCLICKED)
        {
            $design = new \Modules\common\Forms\message_Design();
            $design->setMessageType("error");
            $design->setMessage("سوال امنیتی پاسخ داده نشده");
            return $design->getBodyHTML();
        }
        else
        {
            $design = new \Modules\common\Forms\message_Design();
            $design->setMessageType("error");
            $design->setMessage("پاسخ سوال امنیتی صحیح نبود،لطفا دوباره تلاش کنید");
            return $design->getBodyHTML();
        }

	}
}

?>