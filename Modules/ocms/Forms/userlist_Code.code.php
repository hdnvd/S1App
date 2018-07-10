<?php
namespace Modules\ocms\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\ocms\Controllers\userlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class userlist_Code extends FormCode {
	private $searchForm='userlist';
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
		$userlistController=new userlistController();
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new userlist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$userlistController->load($this->getHttpGETparameter('pn',-1));
			if(isset($_GET['search']))
					$design=new userlistsearch_Design();
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
		$this->setTitle("User List");
	}
	public function search_Click()
	{
		$userlistController=new userlistController();
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$userlistController->setAdminMode($this->getAdminMode());
		$name=$this->getHttpGETparameter('name','');
		$family=$this->getHttpGETparameter('family','');
		$born_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('born_date_from',''));
		$born_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('born_date_to',''));
		$mobile=$this->getHttpGETparameter('mobile','');
		$device_id=$this->getHttpGETparameter('device_id','');
		$email=$this->getHttpGETparameter('email','');
		$ismale_ID=$this->getHttpGETparameter('ismale','');
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$userlistController->Search($this->getHttpGETparameter('pn',-1),$name,$family,$born_date_from,$born_date_to,$mobile,$device_id,$email,$ismale_ID,$sortby_ID,$isdesc_ID);
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