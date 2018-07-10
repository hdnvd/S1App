<?php

namespace Modules\products\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Controllers\deleteproductController;
use Modules\languages\PublicClasses\LanguageTranslator;


class deleteproduct_Code extends FormCode {
	public function load()
	{
		$id=$_GET['productid'];
		$deleteproductController=new deleteproductController();
		$translator=new LanguageTranslator();
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$deleteproductController->load($id);
		$design=new message_Design();
		$design->setMessage("محصول با موفقیت حذف شد");
		return $design->getBodyHTML();
	}
}
?>
