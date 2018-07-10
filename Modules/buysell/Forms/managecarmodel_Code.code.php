<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\managecarmodelController;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-21 - 2017-02-09 01:49
*@lastUpdate 1395-11-21 - 2017-02-09 01:49
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class managecarmodel_Code extends FormCode {
	public function load()
	{
		$managecarmodelController=new managecarmodelController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$managecarmodelController->load($this->getID());
		$design=new managecarmodel_Design();
		$design->setData($Result);
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

		$managecarmodelController=new managecarmodelController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new managecarmodel_Design();
		$txtLatinTitle=$design->getTxtLatinTitle()->getValue();
		$txtTitle=$design->getTxtTitle()->getValue();
		$cmbMaker_ID=$design->getCmbMaker()->getSelectedID();
		$Result=$managecarmodelController->BtnSave($this->getID(),$txtLatinTitle,$txtTitle,$cmbMaker_ID);
		$design->setData($Result);
		return $design->getBodyHTML();
	}
}
?>