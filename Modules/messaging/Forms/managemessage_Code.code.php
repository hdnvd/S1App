<?php
namespace Modules\messaging\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\messaging\Controllers\managemessageController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-08 - 2017-11-29 15:51
*@lastUpdate 1396-09-08 - 2017-11-29 15:51
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managemessage_Code extends FormCode {    
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
		$managemessageController=new managemessageController();
		$managemessageController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("messaging");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$managemessageController->load($this->getID());
			$design=new managemessage_Design();
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
		$this->setTitle("Manage Message");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$managemessageController=new managemessageController();
		$managemessageController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("messaging");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new managemessage_Design();
		$sender_role_systemuser_fid_ID=$design->getSender_role_systemuser_fid()->getSelectedID();
		$receiver_role_systemuser_fid_ID=$design->getReceiver_role_systemuser_fid()->getSelectedID();
		$send_date=$design->getSend_date()->getTime();
		$title=$design->getTitle()->getValue();
		$messagetext=$design->getMessagetext()->getValue();
		$Result=$managemessageController->BtnSave($this->getID(),$sender_role_systemuser_fid_ID,$receiver_role_systemuser_fid_ID,$send_date,$title,$messagetext);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("messaging","managemessages");
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