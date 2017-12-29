<?php
namespace Modules\eshop\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\eshop\Controllers\manageproductController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-08-28 - 2017-11-19 00:39
*@lastUpdate 1396-08-28 - 2017-11-19 00:39
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageproduct_Code extends FormCode {    
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
		$manageproductController=new manageproductController();
		$manageproductController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("eshop");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$manageproductController->load($this->getID());
			$design=new manageproduct_Design();
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
		$this->setTitle("Manage Product");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$manageproductController=new manageproductController();
		$manageproductController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("eshop");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new manageproduct_Design();
		$Colors=$design->getColors()->getSelectedValues();
		$title=$design->getTitle()->getValue();
		$latintitle=$design->getLatintitle()->getValue();
		$description=$design->getDescription()->getValue();
		$pic1_fluPaths=$design->getPic1_flu()->getSelectedFilesTempPath();
		$pic1_fluNames=$design->getPic1_flu()->getSelectedFilesName();
		$pic1_fluURLs=array();
		for($fileIndex=0;$fileIndex<count($pic1_fluPaths) && $pic1_fluPaths[$fileIndex]!=null;$fileIndex++){
			$pic1_fluURLs[$fileIndex]=uploadHelper::UploadFile($pic1_fluPaths[$fileIndex], $pic1_fluNames[$fileIndex], "content/files/eshop/manageproduct/");
		}
		$pic2_fluPaths=$design->getPic2_flu()->getSelectedFilesTempPath();
		$pic2_fluNames=$design->getPic2_flu()->getSelectedFilesName();
		$pic2_fluURLs=array();
		for($fileIndex=0;$fileIndex<count($pic2_fluPaths) && $pic2_fluPaths[$fileIndex]!=null;$fileIndex++){
			$pic2_fluURLs[$fileIndex]=uploadHelper::UploadFile($pic2_fluPaths[$fileIndex], $pic2_fluNames[$fileIndex], "content/files/eshop/manageproduct/");
		}
		$pic3_fluPaths=$design->getPic3_flu()->getSelectedFilesTempPath();
		$pic3_fluNames=$design->getPic3_flu()->getSelectedFilesName();
		$pic3_fluURLs=array();
		for($fileIndex=0;$fileIndex<count($pic3_fluPaths) && $pic3_fluPaths[$fileIndex]!=null;$fileIndex++){
			$pic3_fluURLs[$fileIndex]=uploadHelper::UploadFile($pic3_fluPaths[$fileIndex], $pic3_fluNames[$fileIndex], "content/files/eshop/manageproduct/");
		}
		$pic4_fluPaths=$design->getPic4_flu()->getSelectedFilesTempPath();
		$pic4_fluNames=$design->getPic4_flu()->getSelectedFilesName();
		$pic4_fluURLs=array();
		for($fileIndex=0;$fileIndex<count($pic4_fluPaths) && $pic4_fluPaths[$fileIndex]!=null;$fileIndex++){
			$pic4_fluURLs[$fileIndex]=uploadHelper::UploadFile($pic4_fluPaths[$fileIndex], $pic4_fluNames[$fileIndex], "content/files/eshop/manageproduct/");
		}
		$price=$design->getPrice()->getValue();
		$code=$design->getCode()->getValue();
		$adddate=$design->getAdddate()->getValue();
		$visitcount=$design->getVisitcount()->getValue();
		$is_exists_ID=$design->getIs_exists()->getSelectedID();
		$Result=$manageproductController->BtnSave($this->getID(),$title,$latintitle,$description,$pic1_fluURLs,$pic2_fluURLs,$pic3_fluURLs,$pic4_fluURLs,$price,$code,$adddate,$visitcount,$is_exists_ID,$Colors);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("eshop","manageproducts");
		}
		else{
			$ManageListRooter=new AppRooter("eshop","manageuserproducts");
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