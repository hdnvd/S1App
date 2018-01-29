<?php
namespace Modules\finance\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\finance\Controllers\transactionlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-09 - 2018-01-29 11:26
*@lastUpdate 1396-11-09 - 2018-01-29 11:26
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class transactionlist_Code extends FormCode {
	private $searchForm='transactionlist';
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
		$transactionlistController=new transactionlistController();
		$translator=new ModuleTranslator("finance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new transactionlist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$transactionlistController->load($this->getHttpGETparameter('pn',-1));
			if(isset($_GET['search']))
					$design=new transactionlistsearch_Design();
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
		$this->setTitle("Transaction List");
	}
	public function search_Click()
	{
		$transactionlistController=new transactionlistController();
		$translator=new ModuleTranslator("finance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$transactionlistController->setAdminMode($this->getAdminMode());
		$amount=$this->getHttpGETparameter('amount','');
		$description=$this->getHttpGETparameter('description','');
		$add_time_from=DatePicker::getTimeFromText($this->getHttpGETparameter('add_time_from',''));
		$add_time_to=DatePicker::getTimeFromText($this->getHttpGETparameter('add_time_to',''));
		$commit_time_from=DatePicker::getTimeFromText($this->getHttpGETparameter('commit_time_from',''));
		$commit_time_to=DatePicker::getTimeFromText($this->getHttpGETparameter('commit_time_to',''));
		$issuccessful_ID=$this->getHttpGETparameter('issuccessful','');
		$chapter_fid_ID=$this->getHttpGETparameter('chapter_fid','');
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$transactionlistController->Search($this->getHttpGETparameter('pn',-1),$amount,$description,$add_time_from,$add_time_to,$commit_time_from,$commit_time_to,$issuccessful_ID,$chapter_fid_ID,$sortby_ID,$isdesc_ID);
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