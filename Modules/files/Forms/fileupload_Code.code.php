<?php

namespace Modules\files\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\files\Controllers\fileuploadController;
use core\CoreClasses\File\Uploader;
use Modules\files\PublicClasses\uploadHelper;


class fileupload_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setThemePage("admin.php");
	}
	public function load()
	{
		$fileuploadController=new fileuploadController();
		$translator=new ModuleTranslator("files");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$fileuploadController->load();
		
		$design=new fileupload_Design();
		$design->setLblFileTitle($translator->getWordTranslation("lblfiletitle"));
		$design->setLblFile($translator->getWordTranslation("lblfile"));
		$design->setTxtFileTitle("");
		$design->setSend($translator->getWordTranslation("send"));
		return $design->getBodyHTML();
	}
	public function upload_Click()
	{
		$FileName=null;
		if(isset($_GET['filename']))
			$FileName=$_GET['filename'];
		$fileuploadController=new fileuploadController();
		$translator=new ModuleTranslator("files");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$url=$this->Upload('file',$FileName);
		$url=$url['url'];
		if($FileName===null)
		{
			$fileuploadController->upload($url, $_POST['txtFileTitle']);
		}
		return $translator->getWordTranslation("uploaded");
	}
	public function Upload($InputName,$FileName)
	{
		
		return uploadHelper::UploadFileInput($InputName, "content/files/files/",null,2000,$FileName);
	}
}
?>
