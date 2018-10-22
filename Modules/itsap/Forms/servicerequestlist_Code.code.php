<?php
namespace Modules\itsap\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\itsap\Controllers\manageservicerequestsController;
use Modules\itsap\Controllers\servicerequestinboxController;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\itsap\Controllers\servicerequestlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-07-29 - 2018-10-21 15:46
*@lastUpdate 1397-07-29 - 2018-10-21 15:46
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class servicerequestlist_Code extends FormCode {
	private $searchForm='servicerequestlist';
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
		$servicerequestlistController=new manageservicerequestsController();
		$translator=new ModuleTranslator("itsap");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new servicerequestlist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$servicerequestlistController->load($this->getHttpGETparameter('pn',-1));
			if(isset($_GET['search']))
					$design=new servicerequestlistsearch_Design();
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
		$this->setTitle("Servicerequest List");
	}
	public function search_Click()
	{
		$servicerequestlistController=new manageservicerequestsController();
		$translator=new ModuleTranslator("itsap");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$servicerequestlistController->setAdminMode($this->getAdminMode());
		$title=$this->getHttpGETparameter('title','');
		$unit_fid_ID=$this->getHttpGETparameter('unit_fid','');
		$servicetype_fid_ID=$this->getHttpGETparameter('servicetype_fid','');
		$description=$this->getHttpGETparameter('description','');
		$priority=$this->getHttpGETparameter('priority','');
		$request_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('request_date_from',''));
		$request_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('request_date_to',''));
		$securityacceptor_role_systemuser_fid_ID=$this->getHttpGETparameter('securityacceptor_role_systemuser_fid','');
		$is_securityaccepted_ID=$this->getHttpGETparameter('is_securityaccepted','');
		$securityacceptancemessage=$this->getHttpGETparameter('securityacceptancemessage','');
		$securityacceptance_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('securityacceptance_date_from',''));
		$securityacceptance_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('securityacceptance_date_to',''));
		$letternumber=$this->getHttpGETparameter('letternumber','');
		$letter_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('letter_date_from',''));
		$letter_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('letter_date_to',''));
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$servicerequestlistController->Search($this->getHttpGETparameter('pn',-1),$title,$unit_fid_ID,$servicetype_fid_ID,$description,$priority,$request_date_from,$request_date_to,$securityacceptor_role_systemuser_fid_ID,$is_securityaccepted_ID,$securityacceptancemessage,$securityacceptance_date_from,$securityacceptance_date_to,$letternumber,$letter_date_from,$letter_date_to,$sortby_ID,$isdesc_ID);
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