<?php
namespace Modules\oras\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\oras\Controllers\manageemployeerecruitmenttypeController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-10 - 2017-10-02 23:05
*@lastUpdate 1396-07-10 - 2017-10-02 23:05
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageemployeerecruitmenttype_Code extends FormCode {    
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
		return $this->getLoadDesign()->getBodyHTML();
	}
	public function getLoadDesign()
	{
		$manageemployeerecruitmenttypeController=new manageemployeerecruitmenttypeController();
		$manageemployeerecruitmenttypeController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("oras");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$manageemployeerecruitmenttypeController->load($this->getID(),$this->getHttpGETparameter('employeeid',-1));
			$design=new manageemployeerecruitmenttype_Design();
			$design->setAdminMode($this->adminMode);
			$design->setData($Result);
			$design->setMessage("");
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
		$this->setTitle("Manage Employeerecruitmenttype");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$manageemployeerecruitmenttypeController=new manageemployeerecruitmenttypeController();
		$manageemployeerecruitmenttypeController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("oras");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new manageemployeerecruitmenttype_Design();
		$employee_fid_ID=$this->getHttpGETparameter('employeeid',-1);
		$recruitmenttype_fid_ID=$design->getRecruitmenttype_fid()->getSelectedID();
		$start_date=$design->getStart_date()->getTime();
		$end_date=$design->getEnd_date()->getTime();
		$Result=$manageemployeerecruitmenttypeController->BtnSave($this->getID(),$employee_fid_ID,$recruitmenttype_fid_ID,$start_date,$end_date);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("oras","manageemployeerecruitmenttypes");
		}
			AppRooter::redirect($ManageListRooter->getAbsoluteURL(),DEFAULT_PAGESAVEREDIRECTTIME);
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
		catch(\Exception $uex){
			$design=$this->getLoadDesign();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
		}
		return $design->getBodyHTML();
	}
}
?>