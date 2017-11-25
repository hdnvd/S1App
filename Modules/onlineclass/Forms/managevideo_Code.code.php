<?php
namespace Modules\onlineclass\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\onlineclass\Controllers\managevideoController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-08-01 - 2017-10-23 00:42
*@lastUpdate 1396-08-01 - 2017-10-23 00:42
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managevideo_Code extends FormCode {    
	private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
    public function getAdminMode()
    {
        return $this->adminMode;
    }
	public function load()
	{
		return $this->getLoadDesign()->getBodyHTML();
	}
	public function getLoadDesign()
	{
		$managevideoController=new managevideoController();
		$managevideoController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("onlineclass");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$managevideoController->load($this->getID());
			$design=new managevideo_Design();
			$design->setAdminMode($this->adminMode);
			$design->setData($Result);
			$design->setMessage("");
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
		catch(\Exception $uex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
		}
		return $design;
	}
	public function __construct($namespace)
	{
		parent::__construct($namespace);
		$this->setTitle("Manage Video");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$managevideoController=new managevideoController();
		$managevideoController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("onlineclass");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
//		try{
		$design=new managevideo_Design();
		$title=$design->getTitle()->getValue();
		$hold_date=$design->getHold_date()->getTime();
		$course_fid_ID=$design->getCourse_fid()->getSelectedID();
		$hdvideo_fluPaths=$design->getHdvideo_flu()->getSelectedFilesTempPath();
		$hdvideo_fluNames=$design->getHdvideo_flu()->getSelectedFilesName();
		$hdvideo_fluURLs=array();
		for($fileIndex=0;$fileIndex<count($hdvideo_fluPaths) && $hdvideo_fluPaths[$fileIndex]!=null;$fileIndex++){
			$hdvideo_fluURLs[$fileIndex]=uploadHelper::UploadFile($hdvideo_fluPaths[$fileIndex], $hdvideo_fluNames[$fileIndex], "content/files/onlineclass/managevideo/",null,1024000);
		}
//		$sdvideo_fluPaths=$design->getSdvideo_flu()->getSelectedFilesTempPath();
//		$sdvideo_fluNames=$design->getSdvideo_flu()->getSelectedFilesName();
//		$sdvideo_fluURLs=array();
//		for($fileIndex=0;$fileIndex<count($sdvideo_fluPaths) && $sdvideo_fluPaths[$fileIndex]!=null;$fileIndex++){
//			$sdvideo_fluURLs[$fileIndex]=uploadHelper::UploadFile($sdvideo_fluPaths[$fileIndex], $sdvideo_fluNames[$fileIndex], "content/files/onlineclass/managevideo/",null,1024000);
//		}
		$voice_fluPaths=$design->getVoice_flu()->getSelectedFilesTempPath();
		$voice_fluNames=$design->getVoice_flu()->getSelectedFilesName();
		$voice_fluURLs=array();
		for($fileIndex=0;$fileIndex<count($voice_fluPaths) && $voice_fluPaths[$fileIndex]!=null;$fileIndex++){
			$voice_fluURLs[$fileIndex]=uploadHelper::UploadFile($voice_fluPaths[$fileIndex], $voice_fluNames[$fileIndex], "content/files/onlineclass/managevideo/",null,1024000);
		}
		$Result=$managevideoController->BtnSave($this->getID(),$title,$hold_date,$course_fid_ID,$hdvideo_fluURLs,"",$voice_fluURLs);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("onlineclass","managevideos");
		}
			AppRooter::redirect($ManageListRooter->getAbsoluteURL(),DEFAULT_PAGESAVEREDIRECTTIME);
//		}
//		catch(DataNotFoundException $dnfex){
//			$design=new message_Design();
//			$design->setMessageType(MessageType::$ERROR);
//			$design->setMessage("آیتم مورد نظر پیدا نشد");
//		}
//		catch(\Exception $uex){
//			$design=$this->getLoadDesign();
//			$design->setMessageType(MessageType::$ERROR);
//			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
//		}
		return $design->getBodyHTML();
	}
}
?>