<?php
namespace Modules\iribfinance\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\iribfinance\Controllers\prosperityfundlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 19:04
*@lastUpdate 1396-11-05 - 2018-01-25 19:04
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class prosperityfundlist_Code extends FormCode {
	private $searchForm='prosperityfundlist';
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
		$prosperityfundlistController=new prosperityfundlistController();
		$translator=new ModuleTranslator("iribfinance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new prosperityfundlist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$prosperityfundlistController->load($this->getHttpGETparameter('pn',-1));
			if(isset($_GET['search']))
					$design=new prosperityfundlistsearch_Design();
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
		$this->setTitle("Prosperityfund List");
	}
	public function search_Click()
	{
		$prosperityfundlistController=new prosperityfundlistController();
		$translator=new ModuleTranslator("iribfinance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$prosperityfundlistController->setAdminMode($this->getAdminMode());
		$employee_fid_ID=$this->getHttpGETparameter('employee_fid','');
		$totalamount=$this->getHttpGETparameter('totalamount','');
		$add_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('add_date_from',''));
		$add_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('add_date_to',''));
		$monthcount=$this->getHttpGETparameter('monthcount','');
		$amountpermonth=$this->getHttpGETparameter('amountpermonth','');
		$isactive_ID=$this->getHttpGETparameter('isactive','');
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$prosperityfundlistController->Search($this->getHttpGETparameter('pn',-1),$employee_fid_ID,$totalamount,$add_date_from,$add_date_to,$monthcount,$amountpermonth,$isactive_ID,$sortby_ID,$isdesc_ID);
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