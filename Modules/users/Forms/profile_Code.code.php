<?php

namespace Modules\users\Forms;

use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\services\FormCode;
use Modules\users\Entity\userEntity;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Controllers\signupController;
use core\CoreClasses\File\Uploader;
/**
 *
 * @author nahavandi
 *        
 */
class profile_Code extends FormCode {
	public function load()
	{

		$design=new profile_Design();
		$SUser=new sessionuser();
		$design->setTXTName($SUser->getUserInfo("name"));
		$design->setTXTFamily($SUser->getUserInfo("family"));
		$design->setTXTTel($SUser->getUserInfo("tel"));
		$design->setTXTFather($SUser->getUserInfo("father"));
		$design->setTXTZip($SUser->getUserInfo("postalcode"));
		$design->setTXTMob($SUser->getUserInfo("mobile"));
		$design->setTXTMail($SUser->getUserInfo("mail"));
		$design->setIMGProfilePicture($SUser->getUserInfo("profilepicture"));
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design->setUserphotoTitle($translator->getWordTranslation("profilepicture"));
		$design->setFemaleTitle($translator->getWordTranslation("female"));
		$design->setMaleTitle($translator->getWordTranslation("male"));
		$design->setFamilyTitle($translator->getWordTranslation("family"));
		$design->setFatherTitle($translator->getWordTranslation("father"));
		$design->setMobTitle($translator->getWordTranslation("mob"));
		$design->setNameTitle($translator->getWordTranslation("name"));
		$design->setPass1Title($translator->getWordTranslation("password"));
		$design->setPass2Title($translator->getWordTranslation("password2"));
		$design->setSexTitle($translator->getWordTranslation("sex"));
		$design->setTelTitle($translator->getWordTranslation("tel"));
		$design->setZipTitle($translator->getWordTranslation("postalcode"));
		$design->setUsernameTitle($translator->getWordTranslation("username"));
		$design->setMailTitle($translator->getWordTranslation("email"));
		
		
		return $design->getBodyHTML();
	}
}

?>