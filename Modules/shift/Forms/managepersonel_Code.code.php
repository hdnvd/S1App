<?php
namespace Modules\shift\Forms;
use core\CoreClasses\Exception\InvalidFieldException;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\shift\Controllers\managepersonelController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-28 - 2018-01-18 17:32
*@lastUpdate 1396-10-28 - 2018-01-18 17:32
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managepersonel_Code extends FormCode {    
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
		$managepersonelController=new managepersonelController();
		$managepersonelController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$managepersonelController->load($this->getID());
			$design=new managepersonel_Design();
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
		$this->setTitle("Manage Personel");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$managepersonelController=new managepersonelController();
		$managepersonelController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new managepersonel_Design();
		$childcount=$design->getChildcount()->getValue();
		$address=$design->getAddress()->getValue();
		$fathername=$design->getFathername()->getValue();
		$priority=$design->getPriority()->getValue();
		$employment_date=$design->getEmployment_date()->getTime();
		$personelcode=$design->getPersonelcode()->getValue();
		$sanavat=$design->getSanavat()->getValue();
		$shhesab=$design->getShhesab()->getValue();
		$bakhsh_fid_ID=$design->getBakhsh_fid()->getSelectedID();
		$madrak_fid_ID=$design->getMadrak_fid()->getSelectedID();
		$name=$design->getName()->getValue();
		$family=$design->getFamily()->getValue();
		$tel=$design->getTel()->getValue();
		$born_date=$design->getBorn_date()->getTime();
		$is_male_ID=$design->getIs_male()->getSelectedID();
		$extrasanavat=$design->getExtrasanavat()->getValue();
		$monthsanavat=$design->getMonthsanavat()->getValue();
		$eshteghal_fid_ID=$design->getEshteghal_fid()->getSelectedID();
		$zarib=$design->getZarib()->getValue();
		$role_fid_ID=$design->getRole_fid()->getSelectedID();
		$shsh=$design->getShsh()->getValue();
		$computercode=$design->getComputercode()->getValue();
		$mellicode=$design->getMellicode()->getValue();
		$is_married_ID=$design->getIs_married()->getSelectedID();
		$Result=$managepersonelController->BtnSave($this->getID(),$childcount,$address,$fathername,$priority,$employment_date,$personelcode,$sanavat,$shhesab,$bakhsh_fid_ID,$madrak_fid_ID,$name,$family,$tel,$born_date,$is_male_ID,$extrasanavat,$monthsanavat,$eshteghal_fid_ID,$zarib,$role_fid_ID,$shsh,$computercode,$mellicode,$is_married_ID);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("shift","managepersonels");
		}
			AppRooter::redirect($ManageListRooter->getAbsoluteURL(),DEFAULT_PAGESAVEREDIRECTTIME);
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
        catch(InvalidFieldException $ifex){
            $design=new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("شماره ملی صحیح نمی باشد.");
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