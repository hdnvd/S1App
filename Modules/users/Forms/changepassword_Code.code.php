<?php

namespace Modules\users\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Controllers\changepasswordController;
use Modules\users\Exceptions\CurrentPasswordNotMatched;


class changepassword_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setThemePage("admin.php");
		$this->setTitle("تغییر رمز");
	}
	public function load()
	{
		$changepasswordController=new changepasswordController();
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$changepasswordController->load();
		$design=new changepassword_Design();
		return $design->getBodyHTML();
	}
	public function change_Click()
	{
		$this->setThemePage("ajax.php");
		try {
			$design=new changepassword_Design();
			$changepasswordController=new changepasswordController();
			$changepasswordController->changepass($design->getCurrentPass(), $design->getNewPass());
			return "رمز با موفقیت تغییر یافت";
		}
		catch (CurrentPasswordNotMatched $E)
		{
			return "رمز عبور فعلی صحیح نیست!";
		}
		
	}
}
?>
