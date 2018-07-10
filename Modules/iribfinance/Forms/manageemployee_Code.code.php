<?php
namespace Modules\iribfinance\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\iribfinance\Controllers\manageemployeeController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageemployee_Code extends FormCode {    
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
		$manageemployeeController=new manageemployeeController();
		$manageemployeeController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("iribfinance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$manageemployeeController->load($this->getID());
			$design=new manageemployee_Design();
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
		$this->setTitle("Manage Employee");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$manageemployeeController=new manageemployeeController();
		$manageemployeeController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("iribfinance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new manageemployee_Design();
		$name=$design->getName()->getValue();
		$family=$design->getFamily()->getValue();
		$fathername=$design->getFathername()->getValue();
		$ismale_ID=$design->getIsmale()->getSelectedID();
		$mellicode=$design->getMellicode()->getValue();
		$shsh=$design->getShsh()->getValue();
		$shshserial=$design->getShshserial()->getValue();
		$personelcode=$design->getPersonelcode()->getValue();
		$employmentcode=$design->getEmploymentcode()->getValue();
		$role_fid_ID=$design->getRole_fid()->getSelectedID();
		$nationality_fid_ID=$design->getNationality_fid()->getSelectedID();
		$paycenter_fid_ID=$design->getPaycenter_fid()->getSelectedID();
		$employmenttype_fid_ID=$design->getEmploymenttype_fid()->getSelectedID();
		$born_date=$design->getBorn_date()->getTime();
		$childcount=$design->getChildcount()->getValue();
		$ismarried_ID=$design->getIsmarried()->getSelectedID();
		$mobile=$design->getMobile()->getValue();
		$tel=$design->getTel()->getValue();
		$address=$design->getAddress()->getValue();
		$zipcode=$design->getZipcode()->getValue();
		$common_city_fid_ID=$design->getCommon_city_fid()->getSelectedID();
		$accountnumber=$design->getAccountnumber()->getValue();
		$cardnumber=$design->getCardnumber()->getValue();
		$bank_fid_ID=$design->getBank_fid()->getSelectedID();
		$is_neededinsurance_ID=$design->getIs_neededinsurance()->getSelectedID();
		$is_payabale_ID=$design->getIs_payabale()->getSelectedID();
		$passportnumber=$design->getPassportnumber()->getValue();
		$passportserial=$design->getPassportserial()->getValue();
		$education=$design->getEducation()->getValue();
		$entrance_date=$design->getEntrance_date()->getTime();
		$visatype_fid_ID=$design->getVisatype_fid()->getSelectedID();
		$visaexpire_date=$design->getVisaexpire_date()->getTime();
		$Result=$manageemployeeController->BtnSave($this->getID(),$name,$family,$fathername,$ismale_ID,$mellicode,$shsh,$shshserial,$personelcode,$employmentcode,$role_fid_ID,$nationality_fid_ID,$paycenter_fid_ID,$employmenttype_fid_ID,$born_date,$childcount,$ismarried_ID,$mobile,$tel,$address,$zipcode,$common_city_fid_ID,$accountnumber,$cardnumber,$bank_fid_ID,$is_neededinsurance_ID,$is_payabale_ID,$passportnumber,$passportserial,$education,$entrance_date,$visatype_fid_ID,$visaexpire_date);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("iribfinance","manageemployees");
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