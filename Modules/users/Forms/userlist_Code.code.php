<?php
namespace Modules\users\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\users\Controllers\userlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-15 - 2018-02-04 12:42
*@lastUpdate 1396-11-15 - 2018-02-04 12:42
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
		$translator=new ModuleTranslator("users");
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
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$userlistController->setAdminMode($this->getAdminMode());
		$name=$this->getHttpGETparameter('name','');
		$family=$this->getHttpGETparameter('family','');
		$mail=$this->getHttpGETparameter('mail','');
		$mobile=$this->getHttpGETparameter('mobile','');
		$ismale_ID=$this->getHttpGETparameter('ismale','');
		$profilepicture=$this->getHttpGETparameter('profilepicture','');
		$additionalfield1=$this->getHttpGETparameter('additionalfield1','');
		$additionalfield2=$this->getHttpGETparameter('additionalfield2','');
		$additionalfield3=$this->getHttpGETparameter('additionalfield3','');
		$additionalfield4=$this->getHttpGETparameter('additionalfield4','');
		$additionalfield5=$this->getHttpGETparameter('additionalfield5','');
		$additionalfield6=$this->getHttpGETparameter('additionalfield6','');
		$additionalfield7=$this->getHttpGETparameter('additionalfield7','');
		$additionalfield8=$this->getHttpGETparameter('additionalfield8','');
		$additionalfield9=$this->getHttpGETparameter('additionalfield9','');
		$signup_time_from=DatePicker::getTimeFromText($this->getHttpGETparameter('signup_time_from',''));
		$signup_time_to=DatePicker::getTimeFromText($this->getHttpGETparameter('signup_time_to',''));
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$userlistController->Search($this->getHttpGETparameter('pn',-1),$name,$family,$mail,$mobile,$ismale_ID,$profilepicture,$additionalfield1,$additionalfield2,$additionalfield3,$additionalfield4,$additionalfield5,$additionalfield6,$additionalfield7,$additionalfield8,$additionalfield9,$signup_time_from,$signup_time_to,$sortby_ID,$isdesc_ID);
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