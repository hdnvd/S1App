<?php
namespace Modules\shift\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\shift\Controllers\shiftlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 00:33
*@lastUpdate 1396-11-05 - 2018-01-25 00:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class shiftlist_Code extends FormCode {

    public function __construct($namespace)
    {
        parent::__construct($namespace);
        $this->setThemePage("page.php");
        if(isset($_GET['action']) && $_GET['action']=="search_Click")
            $this->setThemePage('print.php');
        $this->setTitle("Shift List");
    }
	private $searchForm='shiftlist';
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
		$shiftlistController=new shiftlistController();
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new shiftlist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$shiftlistController->load($this->getHttpGETparameter('pn',-1));
			if(isset($_GET['search'])){

                $ReportType=$this->getHttpGETparameter('reporttype','1');
                $design=new shiftlistsearch_Design();
                $design->setReportType($ReportType);
            }
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
	public function search_Click()
	{
		$shiftlistController=new shiftlistController();
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$shiftlistController->setAdminMode($this->getAdminMode());
            $ReportType=$this->getHttpGETparameter('reporttype','1');
            $design=$this->searchForm;
            if($ReportType==2 || $ReportType==4 )
                $design=new twoweeksreport_Design();
            elseif($ReportType==3)
                $design=new dailyreport_Design();
            elseif($ReportType==5)
                $design=new stat_Design();
            $design->setAdminMode($this->getAdminMode());
            $cmbNot=$this->getHttpGETparameter('cmbnot','0');
		$shifttype_fid_ID=$this->getHttpGETparameter('shifttype_fid','');
		$due_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('due_date_from',''));
		$due_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('due_date_to',''));
		$register_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('register_date_from',''));
		$register_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('register_date_to',''));
		$personel_fid_ID=$this->getHttpGETparameter('personel_fid','');
		$bakhsh_fid_ID=$this->getHttpGETparameter('bakhsh_fid','');
		$role_fid_ID=$this->getHttpGETparameter('role_fid','');
		$inputfile_fid_ID=$this->getHttpGETparameter('inputfile_fid','');
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$shiftlistController->Search($this->getHttpGETparameter('pn',-1),$shifttype_fid_ID,$due_date_from,$due_date_to,$register_date_from,$register_date_to,$personel_fid_ID,$bakhsh_fid_ID,$role_fid_ID,$inputfile_fid_ID,$sortby_ID,$isdesc_ID,$ReportType,$cmbNot);
		$design->setData($Result);
        if(key_exists('data',$Result) && ($Result['data']==null || count($Result['data'])==0)){
			$design->setMessage("متاسفانه هیچ نتیجه ای برای این جستجو پیدا نشد.");
			$design->setMessageType(MessageType::$ERROR);
		}else{
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