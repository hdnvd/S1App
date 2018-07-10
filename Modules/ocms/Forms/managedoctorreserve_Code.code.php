<?php
namespace Modules\ocms\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\ocms\Controllers\managedoctorreserveController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedoctorreserve_Code extends FormCode {    
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
		$managedoctorreserveController=new managedoctorreserveController();
		$managedoctorreserveController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$managedoctorreserveController->load($this->getID());
			$design=new managedoctorreserve_Design();
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
		$this->setTitle("Manage Doctorreserve");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$managedoctorreserveController=new managedoctorreserveController();
		$managedoctorreserveController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("ocms");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new managedoctorreserve_Design();
		$doctorplan_fid_ID=$design->getDoctorplan_fid()->getSelectedID();
		$financial_transaction_fid_ID=$design->getFinancial_transaction_fid()->getSelectedID();
		$presencetype_fid_ID=$design->getPresencetype_fid()->getSelectedID();
		$reserve_date=$design->getReserve_date()->getTime();
		$Result=$managedoctorreserveController->BtnSave($this->getID(),$doctorplan_fid_ID,$financial_transaction_fid_ID,$presencetype_fid_ID,$reserve_date);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("ocms","managedoctorreserves");
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