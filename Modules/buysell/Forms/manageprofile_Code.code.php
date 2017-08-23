<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\manageprofileController;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-21 - 2017-02-09 01:49
*@lastUpdate 1395-11-21 - 2017-02-09 01:49
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class manageprofile_Code extends FormCode {
	public function load()
	{
		$manageprofileController=new manageprofileController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$manageprofileController->load();
		$design=new manageprofile_Design();
		$design->setData($Result);
		return $design->getBodyHTML();
	}
	public function btnSave_Click()
	{
		$manageprofileController=new manageprofileController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new manageprofile_Design();
		$txtName=$design->getTxtName()->getValue();
		$txtFamily=$design->getTxtFamily()->getValue();
		$txtEmail=$design->getTxtEmail()->getValue();
		$txtMobile=$design->getTxtMobile()->getValue();
		$txtTel=$design->getTxtTel()->getValue();
		$cmbIsmale_ID=$design->getCmbIsmale()->getSelectedID();
		$cmbCity_ID=$design->getCmbCity()->getSelectedID();
		$txtAddress=$design->getTxtAddress()->getValue();
		$txtPostalCode=$design->getTxtPostalCode()->getValue();
		$chkShowcontactInfo=$design->getChkShowcontactInfo()->getSelectedValues();
		$txtCardNumber=$design->getTxtCardNumber()->getValue();
		$txtCardOwner=$design->getTxtCardOwner()->getValue();
		$cmbBank=$design->getCmbBank()->getValue();
		$cmbCarMaker_ID=$design->getCmbCarMaker()->getSelectedID();
		$cmbCarModel_ID=$design->getCmbCarModel()->getSelectedID();
		$Result=$manageprofileController->BtnSave($txtName,$txtFamily,$txtEmail,$txtMobile,$txtTel,$cmbIsmale_ID,$cmbCity_ID,$txtAddress,$txtPostalCode,$chkShowcontactInfo,$txtCardNumber,$txtCardOwner,$cmbBank,$cmbCarMaker_ID,$cmbCarModel_ID);
		$design->setData($Result);
		return $design->getBodyHTML();
	}
}
?>