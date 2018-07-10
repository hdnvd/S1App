<?php

namespace Modules\gallery\Forms;

use core\CoreClasses\services\FormCode;
use Modules\gallery\Controllers\addphotoController;
use core\CoreClasses\File\Uploader;
use Modules\pages\Controllers\languageManageController;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\languages\PublicClasses\ModuleTranslator;
use core\CoreClasses\File\JpegImage;
use Modules\files\PublicClasses\uploadHelper;

/**
 *
 * @author Hadi AmirNahavandi
 *        
 */
class addphoto_Code extends FormCode {
	
	private $ImagesPath,$ThumbsPath;
	private $Translator;
	public function __construct($namespace=null)
	{
		$this->Translator=new ModuleTranslator("gallery");
		$this->Translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$this->ImagesPath="content/files/gallery/img/";
		$this->ThumbsPath="content/files/gallery/img/thumbnails/";
		parent::__construct($namespace);
		$this->setThemePage("admin.php");
	}
	public function changepublish()
	{
	    
	}
	public function load()
	{
		$addController=new addphotoController();
		if(!isset($_GET['changepublish']) || $_GET['changepublish']!=1)
		{
    		$Fields=$addController->load();
    		$design=new addphoto_Design();
    		$design->getCmbMotherAlbum()->setDataArray($Fields['albums']);
    		$design->getCmbMotherAlbum()->setTextField("title");
    		$design->getCmbMotherAlbum()->setIDField("id");
    		if(isset($_GET['id']))
    			$this->fillData($design, $_GET['id']);
    		$design->setLbltitle($this->Translator->getWordTranslation("title"));
    		$design->setLbldesc($this->Translator->getWordTranslation("description"));
    		$design->setLblphoto($this->Translator->getWordTranslation("photo"));
    		return $design->getBodyHTML();
		}
		else 
		{
		    $addController->changepublishstate($_GET['id']);
		    return "وضعیت انتشار تصویر مورد نظر با موفقیت تغییر یافت";
		}
	}
	private function fillData(addphoto_Design $design,$ID)
	{
		$addController=new addphotoController();
		$result=$addController->loadPhotoInfo($ID);
		$design->getTxtHidID()->setValue($ID);
		$design->getTxtdesc()->setValue($result['photo']['description']);
		$design->getTxttitle()->setValue($result['photo']['title']);
		$design->getCmbMotherAlbum()->setSelectedID($result['albumid']);
		$design->getBtnSave()->setAction("edit");
		$design->getImg()->setUrl($result['photo']['thumburl']);
	}
	public function save_Click()
	{
		$design=new addphoto_Design();
		$photo=$_FILES['filephoto']['name'];
		$PhotoURL=$this->UploadPhoto($_FILES['filephoto']['tmp_name'], $_FILES['filephoto']['name']);
		$addController=new addphotoController();
		$Image=new JpegImage($PhotoURL['path']);
		$Image->setWidth(250);
		$Image->Save(DEFAULT_PUBLICPATH . $this->ThumbsPath . $PhotoURL['name']);
		$ThumbURL=$this->ThumbsPath . rawurlencode($PhotoURL['name']);
		$PhotoURL=$PhotoURL['url'];
		$addController->addphoto($design->getTxttitle()->getValue(), $design->getTxtdesc()->getValue(), $ThumbURL, $PhotoURL, $design->getCmbMotherAlbum()->getSelectedID());
		return "تصویر مورد نظر با موفقیت به آلبوم اضافه شد";
	}
	public function edit_Click()
	{
		$design=new addphoto_Design();
		$addController=new addphotoController();
		$photo=$_FILES['filephoto']['name'];
		$PhotoURL=null;
		$ThumbURL=null;
		if($photo!="")
		{
			$PhotoURL=$this->UploadPhoto($_FILES['filephoto']['tmp_name'], $_FILES['filephoto']['name']);
			$Image=new JpegImage($PhotoURL['url']);
			$Image->setWidth(250);
			$Image->Save(DEFAULT_PUBLICPATH . $this->ThumbsPath . $PhotoURL['name']);
			$ThumbURL=$this->ThumbsPath . rawurlencode($PhotoURL['name']);
			$PhotoURL=$PhotoURL['url'];
		}
		$addController->editphoto($design->getTxtHidID()->getValue(), $design->getTxttitle()->getValue(), $design->getTxtdesc()->getValue(), $ThumbURL, $PhotoURL, $design->getCmbMotherAlbum()->getSelectedID());
		return "تصویر مورد نظر با موفقیت ویرایش شد";
	}
	public function UploadPhoto($tmpfile,$fileName)
	{
		return uploadHelper::UploadFile($tmpfile, $fileName, $this->ImagesPath);
	}
// 	public function UploadPhoto($tmpfile,$fileName)
// 	{
// 		$uploader=new Uploader();
// 		$newName=$fileName;
	
// 		do
// 		{
// 			$address=DEFAULT_PUBLICPATH . "content/files/gallery/img/" . $newName;
// 			$result=$uploader->uploadFile($tmpfile, $address);
// 			$url['url']="content/files/gallery/img/" . $newName;
// 			$url['path']=DEFAULT_PUBLICPATH . "content/files/gallery/img/" . $newName;
// 			$url['name']=$newName;
// 			$newName="0" . $newName;
// 		}while ($result==2);
// 		if($result==1)
// 			return null;
// 		else
// 			return $url;
// 	}
}

?>