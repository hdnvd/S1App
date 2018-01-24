<?php
namespace Modules\shift\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\shift\Controllers\morakhasilistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-26 - 2018-01-16 20:22
*@lastUpdate 1396-10-26 - 2018-01-16 20:22
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class morakhasilist_Code extends FormCode {
	private $searchForm='morakhasilist';
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
		$morakhasilistController=new morakhasilistController();
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new morakhasilist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$morakhasilistController->load($this->getHttpGETparameter('pn',-1));
			if(isset($_GET['search']))
					$design=new morakhasilistsearch_Design();
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
		$this->setTitle("Morakhasi List");
	}
	public function search_Click()
	{
		$morakhasilistController=new morakhasilistController();
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$morakhasilistController->setAdminMode($this->getAdminMode());
		$elat=$this->getHttpGETparameter('elat','');
		$doctor=$this->getHttpGETparameter('doctor','');
		$start_time_from=DatePicker::getTimeFromText($this->getHttpGETparameter('start_time_from',''));
		$start_time_to=DatePicker::getTimeFromText($this->getHttpGETparameter('start_time_to',''));
		$end_time_from=DatePicker::getTimeFromText($this->getHttpGETparameter('end_time_from',''));
		$end_time_to=DatePicker::getTimeFromText($this->getHttpGETparameter('end_time_to',''));
		$add_time_from=DatePicker::getTimeFromText($this->getHttpGETparameter('add_time_from',''));
		$add_time_to=DatePicker::getTimeFromText($this->getHttpGETparameter('add_time_to',''));
		$morakhasi_type=$this->getHttpGETparameter('morakhasi_type','');
		$personel_fid_ID=$this->getHttpGETparameter('personel_fid','');
		$mahal=$this->getHttpGETparameter('mahal','');
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$morakhasilistController->Search($this->getHttpGETparameter('pn',-1),$elat,$doctor,$start_time_from,$start_time_to,$end_time_from,$end_time_to,$add_time_from,$add_time_to,$morakhasi_type,$personel_fid_ID,$mahal,$sortby_ID,$isdesc_ID);
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