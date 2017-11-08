<?php
namespace Modules\onlineclass\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\onlineclass\Controllers\userlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 22:27
*@lastUpdate 1396-07-25 - 2017-10-17 22:27
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
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
		$translator=new ModuleTranslator("onlineclass");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new userlist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			elseif(isset($_GET['service']) && $_GET['service']=="getuserstatus"){
                $Result=$userlistController->FindUserByMobileAndDevice($this->getHttpGETparameter('mobile',-1),$this->getHttpGETparameter('deviceid',-1));
                $Result['service']="getuserstatus";
                $design->setData($Result);
                $design->setMessage("");
			}

            elseif(isset($_GET['service']) && $_GET['service']=="getusercourses"){
                $Result=$userlistController->getUserCourses($this->getHttpGETparameter('mobile',-1));
                $Result['service']="getusercourses";
                $design->setData($Result);
                $design->setMessage("");
            }

            elseif(isset($_GET['service']) && $_GET['service']=="getnotbuyedcourses"){
                $Result=$userlistController->getUserNotBuyedCourses($this->getHttpGETparameter('mobile',-1));
                $Result['service']="getnotbuyedcourses";
                $design->setData($Result);
                $design->setMessage("");
            }
            elseif(isset($_GET['service']) && $_GET['service']=="getcoursevideos"){
                $Result=$userlistController->getCourseVideos($this->getHttpGETparameter('mobile',-1),$this->getHttpGETparameter('courseid',-1));
                $Result['service']="getcoursevideos";
                $design->setData($Result);
                $design->setMessage("");
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
		$translator=new ModuleTranslator("onlineclass");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$userlistController->setAdminMode($this->getAdminMode());
		$fullname=$this->getHttpGETparameter('fullname','');
		$ismale_ID=$this->getHttpGETparameter('ismale','');
		$email=$this->getHttpGETparameter('email','');
		$mobile=$this->getHttpGETparameter('mobile','');
		$registration_time_from=DatePicker::getTimeFromText($this->getHttpGETparameter('registration_time_from',''));
		$registration_time_to=DatePicker::getTimeFromText($this->getHttpGETparameter('registration_time_to',''));
		$devicecode=$this->getHttpGETparameter('devicecode','');
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$userlistController->Search($this->getHttpGETparameter('pn',-1),$fullname,$ismale_ID,$email,$mobile,$registration_time_from,$registration_time_to,$devicecode,$sortby_ID,$isdesc_ID);
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