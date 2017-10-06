<?php
namespace Modules\sfman\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Controllers\makeEntityController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\sfman\Controllers\manageDBformController;
use Modules\sfman\Controllers\manageDBUserFormController;
use Modules\sfman\Controllers\manageformController;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-17 - 2017-06-07 18:07
*@lastUpdate 1396-03-17 - 2017-06-07 18:07
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class makeEntity_Code extends FormCode {
    public function __construct($namespace)
    {
        parent::__construct($namespace);
        $this->setThemePage('admin.php');
        $this->setTitle('Make Entity Class And Forms');
    }

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
		$cmbModule=$design->getCmbModule()->getSelectedID();
		$txtEntity=$design->getTxtEntity()->getValue();
        $Entities=$this->getArrayFromString($txtEntity);
        for ($i=0;$i<count($Entities);$i++)
		    $makeEntityController->BtnGenerate($this->getID(),$cmbModule,$Entities[$i]);
        $makeEntityController=new makeEntityController();
        $Result=$makeEntityController->load($this->getID());
        $Result['module']=$cmbModule;
        $Result['entity']=$txtEntity;
        $design->setData($Result);
		$design->setMessage("کلاس های Entity با موفقیت ساخته شدند.");
		return $design->getBodyHTML();
	}
    public function btnGenerateForms_Click()
    {
        $manageformController=new manageDBUserFormController($this->getModuleName());
        $translator=new ModuleTranslator("sfman");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        $design=new makeEntity_Design();
        $cmbModule=$design->getCmbModule()->getSelectedID();
        $txtEntity=$design->getTxtEntity()->getValue();
        $Entities=$this->getArrayFromString($txtEntity);
        $chkItemsToGenerate=$design->getChkItemsToGenerate();
        for ($i=0;$i<count($Entities);$i++)
            $manageformController->generateManageForms($chkItemsToGenerate->getSelectedValues(),$cmbModule,$Entities[$i]);
        $makeEntityController=new makeEntityController();
        $Result=$makeEntityController->load($this->getID());
        $Result['module']=$cmbModule;
        $Result['entity']=$txtEntity;
        $design->setData($Result);
        $design->setMessage("فرمها با موفقیت ساخته شدند");
        return $design->getBodyHTML();
    }
    private function getArrayFromString($String)
    {
        $Array=explode(',',$String);
        return $Array;
    }
    public function btnRemoveForms_Click()
    {
        $manageformController=new manageDBUserFormController($this->getModuleName());
        $translator=new ModuleTranslator("sfman");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        $design=new makeEntity_Design();
        $cmbModule=$design->getCmbModule()->getSelectedID();
        $txtEntity=$design->getTxtEntity()->getValue();
        $Entities=$this->getArrayFromString($txtEntity);
        $chkItemsToGenerate=$design->getChkItemsToGenerate();
        for ($i=0;$i<count($Entities);$i++)
            $manageformController->DeleteManageCodes($chkItemsToGenerate->getSelectedValues(),$cmbModule,$Entities[$i]);

        $makeEntityController=new makeEntityController();
        $Result=$makeEntityController->load($this->getID());
        $Result['module']=$cmbModule;
        $Result['entity']=$txtEntity;
        $design->setData($Result);
        $design->setMessage("فرمها با موفقیت حذف شدند");
        return $design->getBodyHTML();
    }
}
?>