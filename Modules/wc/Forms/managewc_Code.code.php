<?php
namespace Modules\wc\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\wc\Controllers\managewcController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-16 - 2017-10-08 14:43
*@lastUpdate 1396-07-16 - 2017-10-08 14:43
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managewc_Code extends FormCode {    
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
		$managewcController=new managewcController();
		$managewcController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("wc");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$managewcController->load($this->getID());
			$design=new managewc_Design();
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
		$this->setTitle("Manage Wc");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$managewcController=new managewcController();
		$managewcController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("wc");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new managewc_Design();
		$latitude=$design->getLatitude()->getValue();
		$longitude=$design->getLongitude()->getValue();
		$common_city_fid_ID=$design->getCommon_city_fid()->getSelectedID();
		$isfarangi_ID=$design->getIsfarangi()->getSelectedID();
		$isnormal_ID=$design->getIsnormal()->getSelectedID();
		$register_time=$design->getRegister_time()->getTime();
		$ispublished_ID=$design->getIspublished()->getSelectedID();
		$opentimes=$design->getOpentimes()->getValue();
		$placetitle=$design->getPlacetitle()->getValue();
		$isfree_ID=$design->getIsfree()->getSelectedID();
		$Result=$managewcController->BtnSave($this->getID(),$latitude,$longitude,$common_city_fid_ID,$isfarangi_ID,$isnormal_ID,$register_time,$ispublished_ID,$opentimes,$placetitle,$isfree_ID);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("wc","managewcs");
		}
		else{
			$ManageListRooter=new AppRooter("wc","manageuserwcs");
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
		return $design->getBodyHTML();
	}
}
?>