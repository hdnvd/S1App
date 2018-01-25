<?php
namespace Modules\iribfinance\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\iribfinance\Controllers\programestimationlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:27
*@lastUpdate 1396-11-05 - 2018-01-25 18:27
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class programestimationlist_Code extends FormCode {
	private $searchForm='programestimationlist';
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
		$programestimationlistController=new programestimationlistController();
		$translator=new ModuleTranslator("iribfinance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new programestimationlist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$programestimationlistController->load($this->getHttpGETparameter('pn',-1));
			if(isset($_GET['search']))
					$design=new programestimationlistsearch_Design();
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
		$this->setTitle("Programestimation List");
	}
	public function search_Click()
	{
		$programestimationlistController=new programestimationlistController();
		$translator=new ModuleTranslator("iribfinance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$programestimationlistController->setAdminMode($this->getAdminMode());
		$title=$this->getHttpGETparameter('title','');
		$department_fid_ID=$this->getHttpGETparameter('department_fid','');
		$class_fid_ID=$this->getHttpGETparameter('class_fid','');
		$programmaketype_fid_ID=$this->getHttpGETparameter('programmaketype_fid','');
		$totalprogramcount=$this->getHttpGETparameter('totalprogramcount','');
		$timeperprogram=$this->getHttpGETparameter('timeperprogram','');
		$is_haslegalproblem_ID=$this->getHttpGETparameter('is_haslegalproblem','');
		$approval_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('approval_date_from',''));
		$approval_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('approval_date_to',''));
		$end_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('end_date_from',''));
		$end_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('end_date_to',''));
		$add_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('add_date_from',''));
		$add_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('add_date_to',''));
		$producer_employee_fid_ID=$this->getHttpGETparameter('producer_employee_fid','');
		$executor_employee_fid_ID=$this->getHttpGETparameter('executor_employee_fid','');
		$paycenter_fid_ID=$this->getHttpGETparameter('paycenter_fid','');
		$makergroup_paycenter_fid_ID=$this->getHttpGETparameter('makergroup_paycenter_fid','');
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$programestimationlistController->Search($this->getHttpGETparameter('pn',-1),$title,$department_fid_ID,$class_fid_ID,$programmaketype_fid_ID,$totalprogramcount,$timeperprogram,$is_haslegalproblem_ID,$approval_date_from,$approval_date_to,$end_date_from,$end_date_to,$add_date_from,$add_date_to,$producer_employee_fid_ID,$executor_employee_fid_ID,$paycenter_fid_ID,$makergroup_paycenter_fid_ID,$sortby_ID,$isdesc_ID);
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