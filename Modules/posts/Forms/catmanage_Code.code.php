<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Controllers\catmanageController;


class catmanage_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setTitle("مدیریت موضوعات");
		$this->setThemePage("admin.php");
	}
	public function load()
	{
		if(!isset($_GET['delete']))
		{
			$design=new catmanage_Design();
			$this->LoadContent($design);
			$this->initLables($design);
			return $design->getBodyHTML();
		}
		else 
			return $this->delete();
	}
	private function LoadContent(catmanage_Design $design)
	{
		$catmanageController=new catmanageController();
		$Fields=array();
		if(isset($_GET['id']))
			$Fields=$catmanageController->load($_GET['id']);
		else 
			$Fields=$catmanageController->load();
		
		$design->setCmbMotherID($Fields['cats']);
		if(array_key_exists("cat", $Fields))
		{
			$design->setTxtLatinTitle($Fields['cat'][0]['latintitle']);
			$design->setTxtTitle($Fields['cat'][0]['title']);
			$design->setBtnSaveAction("edit");
			$design->setHidID($Fields['cat'][0]['id']);
		}
		else 
			$design->setBtnSaveAction("add");
		
		
	}
	private function delete()
	{
		$catmanageController=new catmanageController();
		$catmanageController->delete($_GET['id']);
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new message_Design();
		$design->setMessage($translator->getWordTranslation("deleted"));
		return $design->getBodyHTML();
	}
	private function initLables(catmanage_Design $design)
	{
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design->setLatinTitle($translator->getWordTranslation("latintitle"));
		$design->setTitle($translator->getWordTranslation("title"));
		$design->setMother($translator->getWordTranslation("mother"));
		$design->setBtnSave($translator->getWordTranslation("btnsave"));
	}
	public function add_Click()
	{
		$catmanageController=new catmanageController();
		$catmanageController->add($_POST['txtLatinTitle'], $_POST['txtTitle'], $_POST['cmbMotherID']);
		
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new message_Design();
		$design->setMessage($translator->getWordTranslation("added"));
		return $design->getBodyHTML();
	}
	public function edit_Click()
	{
		$catmanageController=new catmanageController();
		$catmanageController->edit($_POST['hidid'],$_POST['txtLatinTitle'], $_POST['txtTitle'], $_POST['cmbMotherID']);
		$translator=new ModuleTranslator("posts");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new message_Design();
		$design->setMessage($translator->getWordTranslation("saved"));
		return $design->getBodyHTML();
	}
}
?>
