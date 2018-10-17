<?php
namespace Modules\itsap\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\itsap\Controllers\servicerequestController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-15 - 2018-04-04 20:33
*@lastUpdate 1397-01-15 - 2018-04-04 20:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class servicerequestmanagement_Code extends servicerequest_Code {
	public function load()
	{
		return $this->getLoadDesign()->getResponse();
	}
	public function getLoadDesign()
	{
		$servicerequestController=new servicerequestController();
		$translator=new ModuleTranslator("itsap");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$servicerequestController->load($this->getID());
			$design=new servicerequestmanagement_Design();
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
		$this->setTitle("Servicerequest Information");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
    public function btnChangePriority_Click()
    {
        $design=new servicerequestmanagement_Design();
        $message=$design->getTxtStatusMessage();
        $state=$design->getCMBPriorities();
        $servicerequestController=new servicerequestController();
        try{
            $Result=$servicerequestController->ChangePriority($this->getID(),$state->getSelectedID());
            $design->setData($Result);
            $design->setMessage("اولویت جدید با موفقیت ثبت شد");
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
        return $design->getBodyHTML();
    }
    public function btnChangeState_Click()
    {
        $design=new servicerequestmanagement_Design();
        $message=$design->getTxtStatusMessage();
        $state=$design->getCmbState();
        $servicerequestController=new servicerequestController();
        try{
            $Result=$servicerequestController->ChangeState($this->getID(),$state->getSelectedID(),$message->getValue());
            $design->setData($Result);
            $design->setMessage("وضعیت جدید با موفقیت ثبت شد");
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
        return $design->getBodyHTML();
    }
    public function btnRefer_Click()
    {
        $design=new servicerequestmanagement_Design();
        $TopUnit=$design->getCMBTopUnits();
        $message=$design->getTxtReferMessage();
        $servicerequestController=new servicerequestController();
        try{
            $Result=$servicerequestController->Refer($this->getID(),$TopUnit->getSelectedID(),$message->getValue());
            $design->setData($Result);
            $design->setMessage("درخواست مورد نظر با موفقیت ارجاع داده شد.");
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
        return $design->getBodyHTML();
    }

    public function btnAssign_Click()
    {
        $design=new servicerequestmanagement_Design();
        $Employee=$design->getCMBUnitEmployees();
        $message=$design->getTxtAssignMessage();
        $servicerequestController=new servicerequestController();
        try{
            $Result=$servicerequestController->Assign($this->getID(),$Employee->getSelectedID(),$message->getValue());
            $design->setData($Result);
            $design->setMessage("درخواست مورد نظر با موفقیت تخصیص داده شد.");
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
        return $design->getBodyHTML();
    }
}
?>