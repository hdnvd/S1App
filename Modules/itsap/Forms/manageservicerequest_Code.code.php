<?php
namespace Modules\itsap\Forms;
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
*@creationDate 1397-01-15 - 2018-04-04 01:34
*@lastUpdate 1397-01-15 - 2018-04-04 01:34
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
		$unit_fid_ID=$design->getUnit_fid()->getSelectedID();
		$servicetype_fid_ID=$design->getServicetype_fid()->getSelectedID();
		$description=$design->getDescription()->getValue();
//		$priority=$design->getPriority()->getValue();
		$file1_fluPaths=$design->getFile1_flu()->getSelectedFilesTempPath();
		$file1_fluNames=$design->getFile1_flu()->getSelectedFilesName();
		$file1_fluURLs=array();
		for($fileIndex=0;$fileIndex<count($file1_fluPaths) && $file1_fluPaths[$fileIndex]!=null;$fileIndex++){
			$file1_fluURLs[$fileIndex]=uploadHelper::UploadFile($file1_fluPaths[$fileIndex], $file1_fluNames[$fileIndex], "content/files/itsap/manageservicerequest/");
		}
		$request_date=time();
		$devicetype_fid_ID=$design->getDevicetype_fid()->getSelectedID();
		$letterfile_fluPaths=$design->getLetterfile_flu()->getSelectedFilesTempPath();
		$letterfile_fluNames=$design->getLetterfile_flu()->getSelectedFilesName();
		$letterfile_fluURLs=array();
		for($fileIndex=0;$fileIndex<count($letterfile_fluPaths) && $letterfile_fluPaths[$fileIndex]!=null;$fileIndex++){
			$letterfile_fluURLs[$fileIndex]=uploadHelper::UploadFile($letterfile_fluPaths[$fileIndex], $letterfile_fluNames[$fileIndex], "content/files/itsap/manageservicerequest/");
		}
		$securityacceptor_role_systemuser_fid_ID=-1;
		$letternumber=$design->getLetternumber()->getValue();
		$letter_date=$design->getLetter_date()->getTime();
            $priority=1;
		$Result=$manageservicerequestController->BtnSave($this->getID(),$title,$unit_fid_ID,$servicetype_fid_ID,$description,$priority,$file1_fluURLs,$request_date,$devicetype_fid_ID,$letterfile_fluURLs,$securityacceptor_role_systemuser_fid_ID,$letternumber,$letter_date);
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