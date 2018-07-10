<?php
namespace Modules\users\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\users\Controllers\manageuserController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-15 - 2018-02-04 12:42
*@lastUpdate 1396-11-15 - 2018-02-04 12:42
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageuser_Code extends FormCode {    
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
		$manageuserController=new manageuserController();
		$manageuserController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$manageuserController->load($this->getID());
			$design=new manageuser_Design();
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
		$this->setTitle("Manage User");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$manageuserController=new manageuserController();
		$manageuserController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new manageuser_Design();
		$name=$design->getName()->getValue();
		$family=$design->getFamily()->getValue();
		$mail=$design->getMail()->getValue();
		$mobile=$design->getMobile()->getValue();
		$ismale_ID=$design->getIsmale()->getSelectedID();
		$profilepicture=$design->getProfilepicture()->getValue();
		$additionalfield1=$design->getAdditionalfield1()->getValue();
		$additionalfield2=$design->getAdditionalfield2()->getValue();
		$additionalfield3=$design->getAdditionalfield3()->getValue();
		$additionalfield4=$design->getAdditionalfield4()->getValue();
		$additionalfield5=$design->getAdditionalfield5()->getValue();
		$additionalfield6=$design->getAdditionalfield6()->getValue();
		$additionalfield7=$design->getAdditionalfield7()->getValue();
		$additionalfield8=$design->getAdditionalfield8()->getValue();
		$additionalfield9=$design->getAdditionalfield9()->getValue();
		$signup_time=$design->getSignup_time()->getTime();
		$Result=$manageuserController->BtnSave($this->getID(),$name,$family,$mail,$mobile,$ismale_ID,$profilepicture,$additionalfield1,$additionalfield2,$additionalfield3,$additionalfield4,$additionalfield5,$additionalfield6,$additionalfield7,$additionalfield8,$additionalfield9,$signup_time);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("users","manageusers");
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