<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\managecarcolorsController;
use Modules\files\PublicClasses\uploadHelper;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-25 - 2017-06-15 02:06
*@lastUpdate 1396-03-25 - 2017-06-15 02:06
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecarcolors_Code extends FormCode {
	public function load()
	{
		$managecarcolorsController=new managecarcolorsController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		if(isset($_GET['delete']))
			$Result=$managecarcolorsController->DeleteItem($this->getID());
		else{
			$Result=$managecarcolorsController->load($this->getID());
		}
		$design=new managecarcolors_Design();
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
		$managecarcolorsController=new managecarcolorsController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new managecarcolors_Design();
		$latintitle=$design->getLatintitle()->getValue();
		$title=$design->getTitle()->getValue();
		$Result=$managecarcolorsController->BtnSave($this->getID(),$latintitle,$title);
		$design->setData($Result);
		$design->setMessage("btnSave is done!");
		return $design->getBodyHTML();
	}
}
?>