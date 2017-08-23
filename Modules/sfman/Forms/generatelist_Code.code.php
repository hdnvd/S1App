<?php

namespace Modules\sfman\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Controllers\manageformController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 1395/10/9 - 2016/12/29 19:36:38
 *@lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 *@SweetFrameworkHelperVersion 1.112
*/


class generatelist_code extends FormCode {

	/**
	 * @return array
	 */
	public function getElementTypes()
	{
		return $this->elementTypes;
	}
	public function load()
	{
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$id=$_GET['id'];
		$elementID=-1;
		$action=0;
		if($_GET['elementid']!=null) {
			$elementID = $_GET['elementid'];
		}
		if($_GET['act']!=null) {
			$action = $_GET['act'];
		}

		$manageformController=new manageformController($this->getModuleName());
		$theElement=null;
		if($elementID>-1)
		{
			if($action==manageform_Design::$ACTION_EDIT)
				$theElement=$manageformController->loadElement($elementID)['element'][0];
			else if($action==manageform_Design::$ACTION_DELETEELEMENT)
				$manageformController->deleteElement($elementID);
			else if($action==manageform_Design::$ACTION_MOVEUP)
				$manageformController->moveUp($elementID);
			else if($action==manageform_Design::$ACTION_MOVEDOWN)
				$manageformController->moveDown($elementID);
		}
		$Result=$manageformController->load($id);
		$Result['element']=$theElement;
		$design=new manageform_Design();

		$design=$this->loadElementTypes($design,$Result['elementtypes']);
		$design=$this->loadData($design,$Result);
		return $design->getBodyHTML();
	}

	private function loadData(manageform_Design $design,$Result)
	{
		$design->getTxtModule()->setValue($Result['module']['caption']);
		$design->getTxtForm()->setValue($Result['form']['caption']);
		$design->setData($Result);
		return $design;
	}
	private function loadElementTypes(manageform_Design $design,array $elementtypes)
	{
		$element=$design->getCmbElementType();
		for ($i=0;$i<count($elementtypes);$i++)
			$element->addOption($elementtypes[$i]['id'],$elementtypes[$i]['title']);
		return $design;

	}
	public function BtnAddElement_Click()
	{
		$manageformController=new manageformController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$id=$_GET['id'];
		$design=new manageform_Design();
		$manageformController->addElement($id,$design->getCmbElementType()->getSelectedID(),$design->getTxtElementName()->getValue(),$design->getTxtElementTitle()->getValue());
		$Result=$manageformController->load($id);
		$design=$this->loadElementTypes($design,$Result['elementtypes']);
		$design=$this->loadData($design,$Result);
		return $design->getBodyHTML();
	}
	public function BtnUpdateElement_Click()
	{
		$manageformController=new manageformController();
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$id=$_GET['id'];
		$elementID=-1;
		if($_GET['elementid']!=null) {
			$elementID = $_GET['elementid'];
		}
		$design=new manageform_Design();
		$manageformController->editElement($elementID,$id,$design->getCmbElementType()->getSelectedID(),$design->getTxtElementName()->getValue(),$design->getTxtElementTitle()->getValue());
		$Result=$manageformController->load($id);
		$Result['element']=$manageformController->loadElement($elementID)['element'][0];
		$design=$this->loadElementTypes($design,$Result['elementtypes']);
		$design=$this->loadData($design,$Result);
		return $design->getBodyHTML();
	}
	public function BtnSave_Click()
	{
		$manageformController=new manageformController($this->getModuleName());
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$id=$_GET['id'];
		$Result=$manageformController->generateCode($id);
		$design=new manageform_Design();
		return $design->getBodyHTML();
	}
    public function BtnGenerateList_Click()
    {
        $manageformController=new manageformController($this->getModuleName());
        $translator=new ModuleTranslator("sfman");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        $id=$_GET['id'];
        $Result=$manageformController->generateCode($id);
        $design=new manageform_Design();
        return $design->getBodyHTML();
    }
}
?>
