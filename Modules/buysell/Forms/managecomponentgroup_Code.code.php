<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\managecomponentgroupController;
use Modules\files\PublicClasses\uploadHelper;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-26 - 2017-02-14 08:32
*@lastUpdate 1395-11-26 - 2017-02-14 08:32
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponentgroup_Code extends FormCode {
	public function load()
	{
		$managecomponentController=new managecomponentgroupController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$managecomponentController->load($this->getID());
		$design=new managecomponentgroup_Design();
		$design->setData($Result);
		$design->setMessage("");
		return $design->getBodyHTML();
	}
	public function getID()
	{
		$id=-1;
		if(isset($_GET['id']))
			$id=$_GET['id'];
		return $id;
	}
	public function btnSave_Click()
	{
		$managecomponentController=new managecomponentgroupController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new managecomponentgroup_Design();
		$txtLatinTitle=$design->getTxtLatinTitle()->getValue();
		$txtTitle=$design->getTxtTitle()->getValue();
		$cmbMotherGroup_ID=$design->getCmbMotherGroup()->getSelectedID();
		$Result=$managecomponentController->BtnSave($this->getID(),$txtLatinTitle,$txtTitle,$cmbMotherGroup_ID);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد");
		return $design->getBodyHTML();
	}
}
?>