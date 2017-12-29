<?php
namespace Modules\ocms\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\ocms\Controllers\doctorlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class doctorlist_Code extends FormCode {
	private $searchForm='doctorlist';
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
		$doctorlistController=new doctorlistController();
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new doctorlist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$doctorlistController->load($this->getHttpGETparameter('pn',-1));
			if(isset($_GET['search']))
					$design=new doctorlistsearch_Design();
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
		$this->setTitle("Doctor List");
	}
	public function search_Click()
	{
		$doctorlistController=new doctorlistController();
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$doctorlistController->setAdminMode($this->getAdminMode());
		$name=$this->getHttpGETparameter('name','');
		$family=$this->getHttpGETparameter('family','');
		$nezam_code=$this->getHttpGETparameter('nezam_code','');
		$mellicode=$this->getHttpGETparameter('mellicode','');
		$mobile=$this->getHttpGETparameter('mobile','');
		$email=$this->getHttpGETparameter('email','');
		$tel=$this->getHttpGETparameter('tel','');
		$ismale_ID=$this->getHttpGETparameter('ismale','');
		$speciality_fid_ID=$this->getHttpGETparameter('speciality_fid','');
		$education=$this->getHttpGETparameter('education','');
		$matabtel=$this->getHttpGETparameter('matabtel','');
		$matabaddress=$this->getHttpGETparameter('matabaddress','');
		$longitude=$this->getHttpGETparameter('longitude','');
		$latitude=$this->getHttpGETparameter('latitude','');
		$common_city_fid_ID=$this->getHttpGETparameter('common_city_fid','');
		$isactiveonphone_ID=$this->getHttpGETparameter('isactiveonphone','');
		$isactiveonplace_ID=$this->getHttpGETparameter('isactiveonplace','');
		$isactiveonhome_ID=$this->getHttpGETparameter('isactiveonhome','');
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$doctorlistController->Search($this->getHttpGETparameter('pn',-1),$name,$family,$nezam_code,$mellicode,$mobile,$email,$tel,$ismale_ID,$speciality_fid_ID,$education,$matabtel,$matabaddress,$longitude,$latitude,$common_city_fid_ID,$isactiveonphone_ID,$isactiveonplace_ID,$isactiveonhome_ID,$sortby_ID,$isdesc_ID);
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