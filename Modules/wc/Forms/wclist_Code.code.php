<?php
namespace Modules\wc\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\wc\Controllers\wclistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-16 - 2017-10-08 14:43
*@lastUpdate 1396-07-16 - 2017-10-08 14:43
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class wclist_Code extends FormCode {
	private $searchForm='wclist';
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
		$wclistController=new wclistController();
		$translator=new ModuleTranslator("wc");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new wclist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$wclistController->load($this->getHttpGETparameter('pn',-1));
			if(isset($_GET['search']))
					$design=new wclistsearch_Design();
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
		$this->setTitle("Wc List");
	}
	public function search_Click()
	{
		$wclistController=new wclistController();
		$translator=new ModuleTranslator("wc");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$wclistController->setAdminMode($this->getAdminMode());
		$latitude=$this->getHttpGETparameter('latitude','');
		$longitude=$this->getHttpGETparameter('longitude','');
		$common_city_fid_ID=$this->getHttpGETparameter('common_city_fid','');
		$isfarangi_ID=$this->getHttpGETparameter('isfarangi','');
		$isnormal_ID=$this->getHttpGETparameter('isnormal','');
		$register_time_from=DatePicker::getTimeFromText($this->getHttpGETparameter('register_time_from',''));
		$register_time_to=DatePicker::getTimeFromText($this->getHttpGETparameter('register_time_to',''));
		$ispublished_ID=$this->getHttpGETparameter('ispublished','');
		$opentimes=$this->getHttpGETparameter('opentimes','');
		$placetitle=$this->getHttpGETparameter('placetitle','');
		$isfree_ID=$this->getHttpGETparameter('isfree','');
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$wclistController->Search($this->getHttpGETparameter('pn',-1),$latitude,$longitude,$common_city_fid_ID,$isfarangi_ID,$isnormal_ID,$register_time_from,$register_time_to,$ispublished_ID,$opentimes,$placetitle,$isfree_ID,$sortby_ID,$isdesc_ID);
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