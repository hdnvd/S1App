<?php
namespace Modules\ocms\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\finance\Exceptions\LowBalanceException;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\ocms\Controllers\doctorplanlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class doctorplanlist_Code extends FormCode {
	private $searchForm='doctorplanlist';
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
		$doctorplanlistController=new doctorplanlistController();
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new doctorplanlist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			elseif(isset($_GET['service']) && $_GET['service']=="getdoctorfreeplans")
            {
                $Result=$doctorplanlistController->getDayPlans($this->getHttpGETparameter('doctorid',-1),$this->getHttpGETparameter('y',-1),$this->getHttpGETparameter('m',-1),$this->getHttpGETparameter('d',-1));
                $design->setService($_GET['service']);
                $design->setData($Result);
                $design->setMessage("");
            }
            elseif(isset($_GET['service']) && $_GET['service']=="reserve")
            {
                $Result=$doctorplanlistController->reserve($this->getHttpGETparameter('doctorplanid',-1),$this->getHttpGETparameter('username',-1),$this->getHttpGETparameter('password',-1),$this->getHttpGETparameter('presencetypeid',-1));
                $design->setService($_GET['service']);
                $design->setData($Result);
                $design->setMessage("رزرو وقت با موفقیت انجام شد.");
            }
			else
			{
				$Result=$doctorplanlistController->load($this->getHttpGETparameter('pn',-1),$this->getHttpGETparameter('username',-1),$this->getHttpGETparameter('password',-1));
			if(isset($_GET['search']))
					$design=new doctorplanlistsearch_Design();
				$design->setData($Result);
				$design->setMessage("");
			}
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
		catch (LowBalanceException $Lbex)
        {
            $design=new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("موجودی کافی نیست");
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
		$this->setTitle("Doctorplan List");
	}
	public function search_Click()
	{
		$doctorplanlistController=new doctorplanlistController();
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$doctorplanlistController->setAdminMode($this->getAdminMode());
		$start_time_from=DatePicker::getTimeFromText($this->getHttpGETparameter('start_time_from',''));
		$start_time_to=DatePicker::getTimeFromText($this->getHttpGETparameter('start_time_to',''));
		$end_time_from=DatePicker::getTimeFromText($this->getHttpGETparameter('end_time_from',''));
		$end_time_to=DatePicker::getTimeFromText($this->getHttpGETparameter('end_time_to',''));
		$doctor_fid_ID=$this->getHttpGETparameter('doctor_fid','');
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$doctorplanlistController->Search($this->getHttpGETparameter('pn',-1),$start_time_from,$start_time_to,$end_time_from,$end_time_to,$doctor_fid_ID,$sortby_ID,$isdesc_ID);
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