<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/08
*/

namespace Modules\users\Forms;

use core\CoreClasses\html\GRecaptchaValidationStatus;
use core\CoreClasses\services\FormCode;
use Modules\common\Forms\message_Design;
use Modules\users\Entity\userEntity;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Controllers\signinController;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;

class asignin_Code extends FormCode
{
    public function __construct($namespace = null)
    {
        parent::__construct($namespace);
        $this->setTitle("ورود به سایت");
    }

    public function load()
    {

        $translator = new ModuleTranslator("users");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());

        $signinController = new signinController();
        $res = $signinController->load();
        $design = new asignin_Design();
        if ($res['showsignup']) {
            $design->setShowSignupLink(true);
            $link = new AppRooter($res['signupmodule'], $res['signuppage']);
            $design->setSignupLink($link->getAbsoluteURL());

        }
        $design->setBtn($translator->getWordTranslation("ورود به سیستم"));
        $design->setLbl1($translator->getWordTranslation("نام کاربری"));
        $design->setLbl2($translator->getWordTranslation("کلمه عبور"));
        return $design->getBodyHTML();
    }

    public function login_Click()
    {
        if (session_id() == '') {
            session_start();
        }
        $translator = new ModuleTranslator("users");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());


        $username = strtolower($_POST['username']);
        $password = $_POST['password'];
        $design = new asignin_Design();
        $recaptchaStatus=$design->getRecaptcha()->getValidationStatus();
        if ($recaptchaStatus == GRecaptchaValidationStatus::$VALID ) {
            $signinController = new signinController();
            $UserID = $signinController->getUserID($username, $password);
            if (!is_null($UserID))//If Username And Password  Is Valid
            {

                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['userid'] = $UserID;
                $msg = $translator->getWordTranslation("logedin");
                $index = $signinController->getUserIndex($UserID);
                $link = new AppRooter($index['module'], $index['page']);
                $params = $index['parameters'];
                $params = explode(";", $params);
                for ($pi = 0; $pi < count($params); $pi++) {
                    $param = explode("=", $params[$pi]);
                    if (count($param) > 1)
                        $link->addParameter(new UrlParameter($param[0], $param[1]));
                }

                $script = "<script lang='javascript'>setTimeout(function(){
			window.location.replace(\"" . $link->getAbsoluteURL() . "\");},2000);
			</script>";
                $design = new showlogin_Design();
                $design->setMessage($msg . $script);
                return $design->getBodyHTML();
            } else {
                $_SESSION['username'] = "";
                $_SESSION['password'] = "";
                $_SESSION['userid'] = "";
                $message = $translator->getWordTranslation("invaliduserpass");
                $design = new showlogin_Design();
                $design->setMessageType("error");
                $design->setMessage($message);
                sleep(5);
                return $design->getBodyHTML();
            }

        }
        else if($recaptchaStatus == GRecaptchaValidationStatus::$NOTCLICKED)
        {
            $design = new showlogin_Design();
            $design->setMessageType("error");
            $design->setMessage("سوال امنیتی پاسخ داده نشده");
            return $design->getBodyHTML();
        }
        else
        {
            $design = new showlogin_Design();
            $design->setMessageType("error");
            $design->setMessage("پاسخ سوال امنیتی صحیح نبود،لطفا دوباره تلاش کنید");
            return $design->getBodyHTML();
        }

    }


}

?>