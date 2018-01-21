<?php
namespace Modules\fileshop\Forms;
use core\CoreClasses\Exception\FileSizeError;
use core\CoreClasses\Exception\FileTypeError;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\fileshop\Controllers\managefileController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-09 - 2017-11-30 16:33
*@lastUpdate 1396-09-09 - 2017-11-30 16:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managefile_Code extends FormCode {    
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
		$managefileController=new managefileController();
		$managefileController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("fileshop");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$managefileController->load($this->getID());
			$design=new managefile_Design();
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
		$this->setTitle("Manage File");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
    {
        $managefileController = new managefileController();
        $managefileController->setAdminMode($this->getAdminMode());
        $translator = new ModuleTranslator("fileshop");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        try {
            $design = new managefile_Design();
            $Categorys = $design->getCategorys()->getSelectedValues();
            $file_fluPaths = $design->getFile_flu()->getSelectedFilesTempPath();
            $file_fluNames = $design->getFile_flu()->getSelectedFilesName();
            $file_fluURLs = array();
            for ($fileIndex = 0; $fileIndex < count($file_fluPaths) && $file_fluPaths[$fileIndex] != null; $fileIndex++) {
                $file_fluURLs[$fileIndex] = uploadHelper::UploadFile($file_fluPaths[$fileIndex], $file_fluNames[$fileIndex], "content/files/fileshop/managefile/", null, 150000);
            }
            $title = $design->getTitle()->getValue();
            $thumbnail_fluPaths = $design->getThumbnail_flu()->getSelectedFilesTempPath();
            $thumbnail_fluNames = $design->getThumbnail_flu()->getSelectedFilesName();
            $thumbnail_fluTypes = $design->getThumbnail_flu()->getSelectedFilesType();
            $thumbnail_fluURLs = array();
            for ($fileIndex = 0; $fileIndex < count($thumbnail_fluPaths) && $thumbnail_fluPaths[$fileIndex] != null; $fileIndex++) {
                $thumbnail_fluURLs[$fileIndex] = uploadHelper::UploadFile($thumbnail_fluPaths[$fileIndex], $thumbnail_fluNames[$fileIndex], "content/files/fileshop/managefile/", ['image/jpeg', 'image/png'], 5000,false,$thumbnail_fluTypes[$fileIndex]);
            }
            $add_date = $design->getAdd_date()->getTime();
            $description = $design->getDescription()->getValue();
            $price = $design->getPrice()->getValue();
            $filecount = $design->getFilecount()->getValue();
            $Result = $managefileController->BtnSave($this->getID(), $file_fluURLs, $title, $thumbnail_fluURLs, $add_date, $description, $price, $filecount, $Categorys);
            $design->setData($Result);
            $design->setMessage("اطلاعات با موفقیت ذخیره شد.");
            $design->setMessageType(MessageType::$SUCCESS);
            if ($this->getAdminMode()) {
                $ManageListRooter = new AppRooter("fileshop", "managefiles");
            }
            AppRooter::redirect($ManageListRooter->getAbsoluteURL(), DEFAULT_PAGESAVEREDIRECTTIME);
        } catch (DataNotFoundException $dnfex) {
            $design = new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("آیتم مورد نظر پیدا نشد");
        }
        catch(FileTypeError $ftex){
            $design=new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage($ftex->getMessage() . "نوع فایل ارسال شده مجاز نیست");
        }
        catch(FileSizeError $fsex){
            $design=new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("حجم فایل ارسال شده بیشتر از حد مجاز است");
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