<?php
namespace Modules\oras\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\oras\Controllers\recordlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 03:03
*@lastUpdate 1396-07-12 - 2017-10-04 03:03
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class recordlist_Code extends FormCode {
	private $searchForm='recordlist';
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
		return $this->getLoadDesign()->getBodyHTML();
	}
	public function getLoadDesign()
	{
		$recordlistController=new recordlistController();
		$translator=new ModuleTranslator("oras");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new recordlist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$recordlistController->load($this->getHttpGETparameter('pn',-1),$this->getHttpGETparameter('employeeid',-1),$this->getHttpGETparameter('placeid',-1));
			if(isset($_GET['search']))
					$design=new recordlistsearch_Design();
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
		$this->setTitle("Record List");
	}
	public function search_Click()
	{
		$recordlistController=new recordlistController();
		$translator=new ModuleTranslator("oras");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$recordlistController->setAdminMode($this->getAdminMode());
		$title=$this->getHttpGETparameter('title','');
		$occurance_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('occurance_date_from',''));
		$occurance_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('occurance_date_to',''));
		$description=$this->getHttpGETparameter('description','');
		$shifttype_fid_ID=$this->getHttpGETparameter('shifttype_fid','');
		$recordtype_fid_ID=$this->getHttpGETparameter('recordtype_fid','');
		if($recordtype_fid_ID==0)
		    $recordtype_fid_ID="";

            $recordtypeisbad=$this->getHttpGETparameter('recordtypeisbad','');
            if($recordtypeisbad==0)
                $recordtypeisbad=null;

		$employeemellicode=$this->getHttpGETparameter('employeemellicode','');
		$role_fid_ID=$this->getHttpGETparameter('role_fid','');
		$place_fid_ID=$this->getHttpGETparameter('place_fid','');
		$registration_time_from=DatePicker::getTimeFromText($this->getHttpGETparameter('registration_time_from',''));
		$registration_time_to=DatePicker::getTimeFromText($this->getHttpGETparameter('registration_time_to',''));
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$ResultType=$this->getHttpGETparameter('resulttype',0);
		$Result=$recordlistController->Search($this->getHttpGETparameter('pn',-1),$title,$occurance_date_from,$occurance_date_to,$description,$shifttype_fid_ID,$recordtype_fid_ID,$employeemellicode,$place_fid_ID,$registration_time_from,$registration_time_to,$sortby_ID,$isdesc_ID,$recordtypeisbad,$ResultType,$role_fid_ID);
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