<?php
namespace Modules\ocms\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\ocms\Controllers\managedoctorController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedoctor_Code extends FormCode {    
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
		$managedoctorController=new managedoctorController();
		$managedoctorController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$managedoctorController->load($this->getID());
			$design=new managedoctor_Design();
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
		$this->setTitle("Manage Doctor");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$managedoctorController=new managedoctorController();
		$managedoctorController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new managedoctor_Design();
		$name=$design->getName()->getValue();
            $price=$design->getPrice()->getValue();
		$family=$design->getFamily()->getValue();
		$nezam_code=$design->getNezam_code()->getValue();
		$mellicode=$design->getMellicode()->getValue();
		$mobile=$design->getMobile()->getValue();
		$email=$design->getEmail()->getValue();
		$tel=$design->getTel()->getValue();
		$ismale_ID=$design->getIsmale()->getSelectedID();
		$speciality_fid_ID=$design->getSpeciality_fid()->getSelectedID();
		$education=$design->getEducation()->getValue();
		$matabtel=$design->getMatabtel()->getValue();
		$matabaddress=$design->getMatabaddress()->getValue();
		$longitude=$design->getLongitude()->getValue();
		$latitude=$design->getLatitude()->getValue();
		$common_city_fid_ID=$design->getCommon_city_fid()->getSelectedID();
		$isactiveonphone_ID=$design->getIsactiveonphone()->getSelectedID();
		$isactiveonplace_ID=$design->getIsactiveonplace()->getSelectedID();
		$isactiveonhome_ID=$design->getIsactiveonhome()->getSelectedID();
		$photo_fluPaths=$design->getPhoto_flu()->getSelectedFilesTempPath();
		$photo_fluNames=$design->getPhoto_flu()->getSelectedFilesName();
            $user=$design->getUsername()->getValue();
            $pass=$design->getPassword()->getValue();
		$photo_fluURLs=array();
		for($fileIndex=0;$fileIndex<count($photo_fluPaths) && $photo_fluPaths[$fileIndex]!=null;$fileIndex++){
			$photo_fluURLs[$fileIndex]=uploadHelper::UploadFile($photo_fluPaths[$fileIndex], $photo_fluNames[$fileIndex], "content/files/ocms/managedoctor/");
		}
		$Result=$managedoctorController->BtnSave($this->getID(),$name,$family,$nezam_code,$mellicode,$mobile,$email,$tel,$ismale_ID,$speciality_fid_ID,$education,$matabtel,$matabaddress,$longitude,$latitude,$common_city_fid_ID,$isactiveonphone_ID,$isactiveonplace_ID,$isactiveonhome_ID,$photo_fluURLs,$price,$user,$pass);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("ocms","managedoctors");
		}
			AppRooter::redirect($ManageListRooter->getAbsoluteURL(),DEFAULT_PAGESAVEREDIRECTTIME);
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
//		catch(\Exception $uex){
//			$design=$this->getLoadDesign();
//			$design->setMessageType(MessageType::$ERROR);
//			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
//		}
		return $design->getResponse();
	}
}
?>