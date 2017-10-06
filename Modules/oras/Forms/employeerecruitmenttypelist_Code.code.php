<?php
namespace Modules\oras\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\oras\Controllers\employeerecruitmenttypelistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-10 - 2017-10-02 23:05
*@lastUpdate 1396-07-10 - 2017-10-02 23:05
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class employeerecruitmenttypelist_Code extends FormCode {
	private $searchForm='employeerecruitmenttypelist';
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
		$employeerecruitmenttypelistController=new employeerecruitmenttypelistController();
		$translator=new ModuleTranslator("oras");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new employeerecruitmenttypelist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$employeerecruitmenttypelistController->load($this->getHttpGETparameter('pn',-1));
			if(isset($_GET['search']))
					$design=new employeerecruitmenttypelistsearch_Design();
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
		$this->setTitle("Employeerecruitmenttype List");
	}
	public function search_Click()
	{
		$employeerecruitmenttypelistController=new employeerecruitmenttypelistController();
		$translator=new ModuleTranslator("oras");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$employeerecruitmenttypelistController->setAdminMode($this->getAdminMode());
		$employee_fid_ID=$_GET['employee_fid'];
		$recruitmenttype_fid_ID=$_GET['recruitmenttype_fid'];
		$start_date_from=DatePicker::getTimeFromText($_GET['start_date_from']);
		$start_date_to=DatePicker::getTimeFromText($_GET['start_date_to']);
		$end_date_from=DatePicker::getTimeFromText($_GET['end_date_from']);
		$end_date_to=DatePicker::getTimeFromText($_GET['end_date_to']);
		$sortby_ID=$_GET['sortby'];
		$isdesc_ID=$_GET['isdesc'];
		$Result=$employeerecruitmenttypelistController->Search($this->getHttpGETparameter('pn',-1),$employee_fid_ID,$recruitmenttype_fid_ID,$start_date_from,$start_date_to,$end_date_from,$end_date_to,$sortby_ID,$isdesc_ID);
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
		return $design->getBodyHTML();
	}
}
?>