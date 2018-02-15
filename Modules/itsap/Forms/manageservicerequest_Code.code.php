<?php
namespace Modules\itsap\Forms;
use core\CoreClasses\Exception\FileSizeError;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\itsap\Controllers\manageservicerequestController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-29 - 2017-12-20 15:49
*@lastUpdate 1396-09-29 - 2017-12-20 15:49
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicerequest_Code extends FormCode {    
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
		return $this->getLoadDesign()->getResponse();
	}
	public function getLoadDesign()
	{
		$manageservicerequestController=new manageservicerequestController();
		$manageservicerequestController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("itsap");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$manageservicerequestController->load($this->getID());
			$design=new manageservicerequest_Design();
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
		$this->setTitle("Manage Servicerequest");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$manageservicerequestController=new manageservicerequestController();
		$manageservicerequestController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("itsap");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new manageservicerequest_Design();
		$title=$design->getTitle()->getValue();
		$servicetype_fid_ID=$design->getServicetype_fid()->getSelectedID();
		$description=$design->getDescription()->getValue();
		$file1_fluPaths=$design->getFile1_flu()->getSelectedFilesTempPath();
		$file1_fluNames=$design->getFile1_flu()->getSelectedFilesName();
		$file1_fluURLs=array();
		for($fileIndex=0;$fileIndex<count($file1_fluPaths) && $file1_fluPaths[$fileIndex]!=null;$fileIndex++){
			$file1_fluURLs[$fileIndex]=uploadHelper::UploadFile($file1_fluPaths[$fileIndex], $file1_fluNames[$fileIndex], "content/files/itsap/manageservicerequest/");
		}
		$request_date=time();
		$Result=$manageservicerequestController->BtnSave($this->getID(),$title,$servicetype_fid_ID,$description,$file1_fluURLs,$request_date);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("itsap","outbox");
		}
		else{
			$ManageListRooter=new AppRooter("itsap","outbox");
		}
			AppRooter::redirect($ManageListRooter->getAbsoluteURL(),DEFAULT_PAGESAVEREDIRECTTIME);
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
        catch(FileSizeError $fsex){
            $design=new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("حجم فایل آپلود شده بیشتر از حد تعیین شده است.");
        }
		catch(\Exception $uex){
			$design=$this->getLoadDesign();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
		}
		return $design->getResponse();
	}
}
?>