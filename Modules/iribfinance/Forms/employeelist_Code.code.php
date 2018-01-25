<?php
namespace Modules\iribfinance\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\iribfinance\Controllers\employeelistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class employeelist_Code extends FormCode {
	private $searchForm='employeelist';
	protected function setSearchForm($searchForm){
		$this->searchForm=$searchForm;
	}    
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
		$employeelistController=new employeelistController();
		$translator=new ModuleTranslator("iribfinance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new employeelist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$employeelistController->load($this->getHttpGETparameter('pn',-1));
			if(isset($_GET['search']))
					$design=new employeelistsearch_Design();
				$design->setData($Result);
				$design->setMessage("");
			}
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
		$this->setTitle("Employee List");
	}
	public function search_Click()
	{
		$employeelistController=new employeelistController();
		$translator=new ModuleTranslator("iribfinance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$employeelistController->setAdminMode($this->getAdminMode());
		$name=$this->getHttpGETparameter('name','');
		$family=$this->getHttpGETparameter('family','');
		$fathername=$this->getHttpGETparameter('fathername','');
		$ismale_ID=$this->getHttpGETparameter('ismale','');
		$mellicode=$this->getHttpGETparameter('mellicode','');
		$shsh=$this->getHttpGETparameter('shsh','');
		$shshserial=$this->getHttpGETparameter('shshserial','');
		$personelcode=$this->getHttpGETparameter('personelcode','');
		$employmentcode=$this->getHttpGETparameter('employmentcode','');
		$role_fid_ID=$this->getHttpGETparameter('role_fid','');
		$nationality_fid_ID=$this->getHttpGETparameter('nationality_fid','');
		$paycenter_fid_ID=$this->getHttpGETparameter('paycenter_fid','');
		$employmenttype_fid_ID=$this->getHttpGETparameter('employmenttype_fid','');
		$born_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('born_date_from',''));
		$born_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('born_date_to',''));
		$childcount=$this->getHttpGETparameter('childcount','');
		$ismarried_ID=$this->getHttpGETparameter('ismarried','');
		$mobile=$this->getHttpGETparameter('mobile','');
		$tel=$this->getHttpGETparameter('tel','');
		$address=$this->getHttpGETparameter('address','');
		$zipcode=$this->getHttpGETparameter('zipcode','');
		$common_city_fid_ID=$this->getHttpGETparameter('common_city_fid','');
		$accountnumber=$this->getHttpGETparameter('accountnumber','');
		$cardnumber=$this->getHttpGETparameter('cardnumber','');
		$bank_fid_ID=$this->getHttpGETparameter('bank_fid','');
		$is_neededinsurance_ID=$this->getHttpGETparameter('is_neededinsurance','');
		$is_payabale_ID=$this->getHttpGETparameter('is_payabale','');
		$passportnumber=$this->getHttpGETparameter('passportnumber','');
		$passportserial=$this->getHttpGETparameter('passportserial','');
		$education=$this->getHttpGETparameter('education','');
		$entrance_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('entrance_date_from',''));
		$entrance_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('entrance_date_to',''));
		$visatype_fid_ID=$this->getHttpGETparameter('visatype_fid','');
		$visaexpire_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('visaexpire_date_from',''));
		$visaexpire_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('visaexpire_date_to',''));
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$employeelistController->Search($this->getHttpGETparameter('pn',-1),$name,$family,$fathername,$ismale_ID,$mellicode,$shsh,$shshserial,$personelcode,$employmentcode,$role_fid_ID,$nationality_fid_ID,$paycenter_fid_ID,$employmenttype_fid_ID,$born_date_from,$born_date_to,$childcount,$ismarried_ID,$mobile,$tel,$address,$zipcode,$common_city_fid_ID,$accountnumber,$cardnumber,$bank_fid_ID,$is_neededinsurance_ID,$is_payabale_ID,$passportnumber,$passportserial,$education,$entrance_date_from,$entrance_date_to,$visatype_fid_ID,$visaexpire_date_from,$visaexpire_date_to,$sortby_ID,$isdesc_ID);
		$design->setData($Result);
		if($Result['data']==null || count($Result['data'])==0){
			$design->setMessage("متاسفانه هیچ نتیجه ای برای این جستجو پیدا نشد.");
			$design->setMessageType(MessageType::$ERROR);
		}else{
			$design->setMessage("نتایج جستجو : ");
			$design->setMessageType(MessageType::$INFORMATION);
		}
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
}
?>