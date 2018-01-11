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
*@creationDate 1396-09-29 - 2017-12-20 15:49
*@lastUpdate 1396-09-29 - 2017-12-20 15:49
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class servicerequest_Code extends FormCode {
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
			$design=new servicerequest_Design();
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
	public function btnChangeState_Click()
    {
        $design=new servicerequest_Design();
        $state=$design->getCmbState();
        $servicerequestController=new servicerequestController();
        try{
            $Result=$servicerequestController->ChangeState($this->getID(),$state->getSelectedID());
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
        $design=new servicerequest_Design();
        $TopUnit=$design->getCMBTopUnits();
        $servicerequestController=new servicerequestController();
        try{
            $Result=$servicerequestController->Refer($this->getID(),$TopUnit->getSelectedID(),"Not Implemented Yet!");
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
        $design=new servicerequest_Design();
        $Employee=$design->getCMBUnitEmployees();
        $servicerequestController=new servicerequestController();
        try{
            $Result=$servicerequestController->Assign($this->getID(),$Employee->getSelectedID(),"Not Implemented Yet!");
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