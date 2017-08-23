<?php
namespace Modules\sfman\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Controllers\makeEntityController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\sfman\Controllers\manageDBformController;
use Modules\sfman\Controllers\manageformController;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-17 - 2017-06-07 18:07
*@lastUpdate 1396-03-17 - 2017-06-07 18:07
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class makeEntity_Code extends FormCode {
	public function load()
	{
		$makeEntityController=new makeEntityController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$makeEntityController->load($this->getID());
		$design=new makeEntity_Design();
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
	public function btnGenerate_Click()
	{
		$makeEntityController=new makeEntityController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new makeEntity_Design();
		$txtModule=$design->getTxtModule()->getValue();
		$txtEntity=$design->getTxtEntity()->getValue();
		$Result=$makeEntityController->BtnGenerate($this->getID(),$txtModule,$txtEntity);
		$design->setData($Result);
		$design->setMessage("btnGenerate is done!");
		return $design->getBodyHTML();
	}
    public function btnGenerateForms_Click()
    {
        $manageformController=new manageDBformController($this->getModuleName());
        $translator=new ModuleTranslator("sfman");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        $design=new makeEntity_Design();
        $txtModule=$design->getTxtModule()->getValue();
        $txtEntity=$design->getTxtEntity()->getValue();
        $chkItemsToGenerate=$design->getChkItemsToGenerate();
        $Result=$manageformController->generateManageForms($chkItemsToGenerate->getSelectedValues(),$txtModule,$txtEntity);
        $design->setData($Result);
        $design->setMessage("btnGenerateForms is done!");
        return $design->getBodyHTML();
    }
}
?>