<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\managecarmakerController;
use Modules\files\PublicClasses\uploadHelper;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-21 - 2017-02-09 02:06
*@lastUpdate 1395-11-21 - 2017-02-09 02:06
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class managecarmaker_Code extends FormCode {
	public function load()
	{
		$managecarmakerController=new managecarmakerController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Result=$managecarmakerController->load($_GET['id']);
		$design=new managecarmaker_Design();
		$design->setData($Result);
		return $design->getBodyHTML();
	}
	public function btnSave_Click()
	{
        $id=-1;
        if(isset($_GET['id']))
            $id=$_GET['id'];

		$managecarmakerController=new managecarmakerController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new managecarmaker_Design();
		$txtLatinTitle=$design->getTxtLatinTitle()->getValue();
		$txtTitle=$design->getTxtTitle()->getValue();
		$flLogoPaths=$design->getFlLogo()->getSelectedFilesTempPath();
		$flLogoNames=$design->getFlLogo()->getSelectedFilesName();
		$flLogoURLs=array();
		for($fileIndex=0;$fileIndex<count($flLogoPaths);$fileIndex++){
			$flLogoURLs[$fileIndex]=uploadHelper::UploadFile($flLogoPaths[$fileIndex], $flLogoNames[$fileIndex], "content/files/buysell/carmakers/");
		}
		$Result=$managecarmakerController->BtnSave($id,$txtLatinTitle,$txtTitle,$flLogoURLs);
		$design->setData($Result);
		return $design->getBodyHTML();
	}
}
?>