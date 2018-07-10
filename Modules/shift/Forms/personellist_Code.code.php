<?php
namespace Modules\shift\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\shift\Controllers\personellistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-28 - 2018-01-18 17:32
*@lastUpdate 1396-10-28 - 2018-01-18 17:32
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class personellist_Code extends FormCode {
	private $searchForm='personellist';
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
		$personellistController=new personellistController();
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new personellist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$personellistController->load($this->getHttpGETparameter('pn',-1));
			if(isset($_GET['search']))
					$design=new personellistsearch_Design();
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
		$this->setTitle("Personel List");
	}
	public function search_Click()
	{
		$personellistController=new personellistController();
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$personellistController->setAdminMode($this->getAdminMode());
		$childcount=$this->getHttpGETparameter('childcount','');
		$address=$this->getHttpGETparameter('address','');
		$fathername=$this->getHttpGETparameter('fathername','');
		$priority=$this->getHttpGETparameter('priority','');
		$employment_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('employment_date_from',''));
		$employment_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('employment_date_to',''));
		$personelcode=$this->getHttpGETparameter('personelcode','');
		$sanavat=$this->getHttpGETparameter('sanavat','');
		$shhesab=$this->getHttpGETparameter('shhesab','');
		$bakhsh_fid_ID=$this->getHttpGETparameter('bakhsh_fid','');
		$madrak_fid_ID=$this->getHttpGETparameter('madrak_fid','');
		$name=$this->getHttpGETparameter('name','');
		$family=$this->getHttpGETparameter('family','');
		$tel=$this->getHttpGETparameter('tel','');
		$born_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('born_date_from',''));
		$born_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('born_date_to',''));
		$is_male_ID=$this->getHttpGETparameter('is_male','');
		$extrasanavat=$this->getHttpGETparameter('extrasanavat','');
		$monthsanavat=$this->getHttpGETparameter('monthsanavat','');
		$eshteghal_fid_ID=$this->getHttpGETparameter('eshteghal_fid','');
		$zarib=$this->getHttpGETparameter('zarib','');
		$role_fid_ID=$this->getHttpGETparameter('role_fid','');
		$shsh=$this->getHttpGETparameter('shsh','');
		$computercode=$this->getHttpGETparameter('computercode','');
		$mellicode=$this->getHttpGETparameter('mellicode','');
		$is_married_ID=$this->getHttpGETparameter('is_married','');
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$personellistController->Search($this->getHttpGETparameter('pn',-1),$childcount,$address,$fathername,$priority,$employment_date_from,$employment_date_to,$personelcode,$sanavat,$shhesab,$bakhsh_fid_ID,$madrak_fid_ID,$name,$family,$tel,$born_date_from,$born_date_to,$is_male_ID,$extrasanavat,$monthsanavat,$eshteghal_fid_ID,$zarib,$role_fid_ID,$shsh,$computercode,$mellicode,$is_married_ID,$sortby_ID,$isdesc_ID);
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