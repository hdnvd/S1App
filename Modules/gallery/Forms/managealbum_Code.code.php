<?php

namespace Modules\gallery\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\gallery\Controllers\managealbumController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2014/12/20 21:57:52
 *@lastupdate 2014/12/20 21:57:52
*/


class managealbum_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setThemePage("admin.php");
	}
	public function load()
	{
		$managealbumController=new managealbumController();
		$translator=new ModuleTranslator("gallery");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$ID=null;
		if(isset($_GET['id']))
			$ID=$_GET['id'];
		if(isset($_GET['delete']) && $_GET['delete']=="1")
			return $this->Delete($ID);
		$Fields=$managealbumController->load($ID);
		$design=new managealbum_Design();
		$this->setFormCaptions($Fields, $design);
		if(key_exists('album', $Fields) && count($Fields['album'])>0)
			$this->fillData($Fields, $design);
		else 
			$design->getBtnSave()->setAction("add");
			
		return $design->getBodyHTML();
	}
	private function fillData($Fields,managealbum_Design $design)
	{
		$design->getTxtLatinTitle()->setValue($Fields['album'][0]['latintitle']);
		$design->getTxtTitle()->setValue($Fields['album'][0]['title']);
		$design->getCmbMotherAlbum()->setSelectedID($Fields['album'][0]['mother_fid']);
		$design->getTxtHidID()->setValue($Fields['album'][0]['id']);
		$design->getBtnSave()->setAction("edit");
	}
	private function setFormCaptions($Fields,managealbum_Design $design)
	{
		if($Fields['albums']===null)
			$Fields['albums']=array();
		array_push($Fields['albums'], array("id"=>'-1',"title"=>"بدون مادر","latintitle"=>"noparent"));
		$design->getCmbMotherAlbum()->setDataArray($Fields['albums']);
		$design->getCmbMotherAlbum()->setIDField("id");
		$design->getCmbMotherAlbum()->setTextField("title");
		$design->getBtnSave()->SetAttribute("value", "ذخیره");
	}
	public function add_Click()
	{
		$design=new managealbum_Design();
		$managealbumController=new managealbumController();
		$managealbumController->Add($design->getTxtLatinTitle()->getValue(), $design->getTxtTitle()->getValue(), $design->getCmbMotherAlbum()->getSelectedID());
		return "آلبوم مورد نظر با موفقیت به سیستم اضافه شد";
	}
	public function edit_Click()
	{
		$design=new managealbum_Design();
		$managealbumController=new managealbumController();
		$managealbumController->Edit($design->getTxtHidID()->getValue(),$design->getTxtLatinTitle()->getValue(), $design->getTxtTitle()->getValue(), $design->getCmbMotherAlbum()->getSelectedID());
		return "آلبوم مورد نظر با موفقیت ویرایش شد";
	}
	public function Delete($ID)
	{
		$design=new managealbum_Design();
		$managealbumController=new managealbumController();
		$managealbumController->Delete($ID);
		return "آلبوم مورد نظر با موفقیت حذف شد";
	}
}
?>
