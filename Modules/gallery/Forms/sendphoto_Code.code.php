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
class sendphoto_Code extends FormCode {
	
	private $ImagesPath,$ThumbsPath;
	private $Translator;
	public function __construct($namespace=null)
	{
		$this->Translator=new ModuleTranslator("gallery");
		$this->Translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$this->ImagesPath="content/files/gallery/img/";
		$this->ThumbsPath="content/files/gallery/img/thumbnails/";
		parent::__construct($namespace);
		$this->setThemePage("page.php");
	}
public function getTitle()
	{
	    return "ارسال تصویر";
	}
	public function load()
	{
		$addController=new addphotoController();
		$Fields=$addController->load();
		$design=new sendphoto_Design();
		$design->getCmbMotherAlbum()->setDataArray($Fields['albums']);
		$design->getCmbMotherAlbum()->setTextField("title");
		$design->getCmbMotherAlbum()->setIDField("id");
		$design->setLbltitle($this->Translator->getWordTranslation("title"));
		$design->setLbldesc($this->Translator->getWordTranslation("description"));
		$design->setLblphoto($this->Translator->getWordTranslation("photo"));
		return $design->getBodyHTML();
	}
	public function save_Click()
	{
session_id(1147);
session_start();
		$design=new sendphoto_Design();
		
		
		if(!isset($_SESSION['captext']) || $_SESSION['captext']!=$design->getTxtCaptcha()->getValue())
		{
		    return "لطفا حروف تصویر را با دقت و با استفاده از اعداد لاتین وارد نمایید";
		}
		else
		{
		    
    		$photo=$_FILES['filephoto']['name'];
    		$PhotoURL=$this->UploadPhoto($_FILES['filephoto']['tmp_name'], $_FILES['filephoto']['name']);
    		$addController=new addphotoController();
    		$Image=new JpegImage($PhotoURL['path']);
    		$Image->setWidth(250);
    		$Image->Save(DEFAULT_PUBLICPATH . $this->ThumbsPath . $PhotoURL['name']);
    		$ThumbURL=$this->ThumbsPath . rawurlencode($PhotoURL['name']);
    		$PhotoName=$PhotoURL['name'];
    		$PhotoPath=$PhotoURL['path'];
    		$PhotoURL=$PhotoURL['url'];
    
    		$_SESSION['captext']="sdfdgregtsdzvzdcgzfrd";
    		$addController->sendphoto($design->getTxttitle()->getValue(), $design->getTxtdesc()->getValue(), $ThumbURL, $PhotoURL, $design->getCmbMotherAlbum()->getSelectedID(),$PhotoPath,$PhotoName);
    		return "با تشکر از همکاری شما,تصویر ارسال شده به زودی در وب سایت و نرم افزار قرار خواهد گرفت";
		}
		$_SESSION['captext']="";
		
	}
	
	public function UploadPhoto($tmpfile,$fileName)
	{
		return uploadHelper::UploadFile($tmpfile, $fileName, $this->ImagesPath);
	}

}

?>