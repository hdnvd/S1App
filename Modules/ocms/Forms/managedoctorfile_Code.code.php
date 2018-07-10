<?php
namespace Modules\ocms\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\ocms\Controllers\managedoctorfileController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-06 - 2018-03-26 16:43
*@lastUpdate 1397-01-06 - 2018-03-26 16:43
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedoctorfile_Code extends FormCode {    
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
		$managedoctorfileController=new managedoctorfileController();
		$managedoctorfileController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$managedoctorfileController->load($this->getID());
			$design=new managedoctorfile_Design();
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
		$this->setTitle("Manage Doctorfile");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$managedoctorfileController=new managedoctorfileController();
		$managedoctorfileController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new managedoctorfile_Design();
		$file_fluPaths=$design->getFile_flu()->getSelectedFilesTempPath();
		$file_fluNames=$design->getFile_flu()->getSelectedFilesName();
		$file_fluURLs=array();
		for($fileIndex=0;$fileIndex<count($file_fluPaths) && $file_fluPaths[$fileIndex]!=null;$fileIndex++){
			$file_fluURLs[$fileIndex]=uploadHelper::UploadFile($file_fluPaths[$fileIndex], $file_fluNames[$fileIndex], "content/files/ocms/managedoctorfile/",null,150000);
		}
		$description=$design->getDescription()->getValue();
		$doctor_fid_ID=$design->getDoctor_fid()->getSelectedID();
		$Result=$managedoctorfileController->BtnSave($this->getID(),$file_fluURLs,$description,$doctor_fid_ID);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("ocms","managedoctorfiles");
		}
			AppRooter::redirect($ManageListRooter->getAbsoluteURL(),DEFAULT_PAGESAVEREDIRECTTIME);
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
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