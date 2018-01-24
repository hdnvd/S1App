<?php
namespace Modules\ocms\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\ocms\Controllers\doctorreservelistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-03 - 2018-01-23 00:07
*@lastUpdate 1396-11-03 - 2018-01-23 00:07
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class doctorreservelist_Code extends FormCode {
	private $searchForm='doctorreservelist';
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
		$doctorreservelistController=new doctorreservelistController();
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new doctorreservelist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$doctorreservelistController->load($this->getHttpGETparameter('pn',-1),$this->getHttpGETparameter('username',-1),$this->getHttpGETparameter('password',-1));
			if(isset($_GET['search']))
					$design=new doctorreservelistsearch_Design();
				$design->setData($Result);
				$design->setMessage("");
			}
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
//		catch(\Exception $uex){
//			$design=new message_Design();
//			$design->setMessageType(MessageType::$ERROR);
//			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
//		}
		return $design;
	}
	public function __construct($namespace)
	{
		parent::__construct($namespace);
		$this->setTitle("Doctorreserve List");
	}
	public function search_Click()
	{
		$doctorreservelistController=new doctorreservelistController();
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$doctorreservelistController->setAdminMode($this->getAdminMode());
		$doctorplan_fid_ID=$this->getHttpGETparameter('doctorplan_fid','');
		$financial_transaction_fid_ID=$this->getHttpGETparameter('financial_transaction_fid','');
		$financial_canceltransaction_fid_ID=$this->getHttpGETparameter('financial_canceltransaction_fid','');
		$presencetype_fid_ID=$this->getHttpGETparameter('presencetype_fid','');
		$reserve_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('reserve_date_from',''));
		$reserve_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('reserve_date_to',''));
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$doctorreservelistController->Search($this->getHttpGETparameter('pn',-1),$doctorplan_fid_ID,$financial_transaction_fid_ID,$financial_canceltransaction_fid_ID,$presencetype_fid_ID,$reserve_date_from,$reserve_date_to,$sortby_ID,$isdesc_ID);
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