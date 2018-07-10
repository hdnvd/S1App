<?php
namespace Modules\iribfinance\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\iribfinance\Controllers\manageprogramestimationController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:27
*@lastUpdate 1396-11-05 - 2018-01-25 18:27
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageprogramestimation_Code extends FormCode {    
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
		$manageprogramestimationController=new manageprogramestimationController();
		$manageprogramestimationController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("iribfinance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$manageprogramestimationController->load($this->getID());
			$design=new manageprogramestimation_Design();
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
		$this->setTitle("Manage Programestimation");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$manageprogramestimationController=new manageprogramestimationController();
		$manageprogramestimationController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("iribfinance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new manageprogramestimation_Design();
		$title=$design->getTitle()->getValue();
		$department_fid_ID=$design->getDepartment_fid()->getSelectedID();
		$class_fid_ID=$design->getClass_fid()->getSelectedID();
		$programmaketype_fid_ID=$design->getProgrammaketype_fid()->getSelectedID();
		$totalprogramcount=$design->getTotalprogramcount()->getValue();
		$timeperprogram=$design->getTimeperprogram()->getValue();
		$is_haslegalproblem_ID=$design->getIs_haslegalproblem()->getSelectedID();
		$approval_date=$design->getApproval_date()->getTime();
		$end_date=$design->getEnd_date()->getTime();
		$add_date=$design->getAdd_date()->getTime();
		$producer_employee_fid_ID=$design->getProducer_employee_fid()->getSelectedID();
		$executor_employee_fid_ID=$design->getExecutor_employee_fid()->getSelectedID();
		$paycenter_fid_ID=$design->getPaycenter_fid()->getSelectedID();
		$makergroup_paycenter_fid_ID=$design->getMakergroup_paycenter_fid()->getSelectedID();
		$Result=$manageprogramestimationController->BtnSave($this->getID(),$title,$department_fid_ID,$class_fid_ID,$programmaketype_fid_ID,$totalprogramcount,$timeperprogram,$is_haslegalproblem_ID,$approval_date,$end_date,$add_date,$producer_employee_fid_ID,$executor_employee_fid_ID,$paycenter_fid_ID,$makergroup_paycenter_fid_ID);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("iribfinance","manageprogramestimations");
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
		return $design->getResponse();
	}
}
?>