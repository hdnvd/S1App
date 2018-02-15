<?php

namespace Modules\users\Forms;

use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\services\FormCode;
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
		$user=$SUser->getUser();
		$design->setTXTName($user->getName());
		$design->setTXTFamily($user->getFamily());
		$design->setTXTTel($user->getAdditionalfield1());
		$design->setTXTFather($user->getAdditionalfield2());
		$design->setTXTZip($user->getAdditionalfield3());
		$design->setTXTMob($user->getMobile());
		$design->setTXTMail($user->getMail());
		$design->setIMGProfilePicture($user->getProfilepicture());
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