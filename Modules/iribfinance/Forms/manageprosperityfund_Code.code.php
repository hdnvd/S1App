<?php
namespace Modules\iribfinance\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\iribfinance\Controllers\manageprosperityfundController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 19:04
*@lastUpdate 1396-11-05 - 2018-01-25 19:04
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageprosperityfund_Code extends FormCode {    
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
		$manageprosperityfundController=new manageprosperityfundController();
		$manageprosperityfundController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("iribfinance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$manageprosperityfundController->load($this->getID());
			$design=new manageprosperityfund_Design();
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
		$this->setTitle("Manage Prosperityfund");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$manageprosperityfundController=new manageprosperityfundController();
		$manageprosperityfundController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("iribfinance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new manageprosperityfund_Design();
		$employee_fid_ID=$design->getEmployee_fid()->getSelectedID();
		$totalamount=$design->getTotalamount()->getValue();
		$add_date=$design->getAdd_date()->getTime();
		$monthcount=$design->getMonthcount()->getValue();
		$amountpermonth=$design->getAmountpermonth()->getValue();
		$isactive_ID=$design->getIsactive()->getSelectedID();
		$Result=$manageprosperityfundController->BtnSave($this->getID(),$employee_fid_ID,$totalamount,$add_date,$monthcount,$amountpermonth,$isactive_ID);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("iribfinance","manageprosperityfunds");
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