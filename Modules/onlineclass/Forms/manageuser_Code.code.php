<?php
namespace Modules\onlineclass\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\buysell\Exceptions\nosamepassException;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\onlineclass\Controllers\manageuserController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
use Modules\users\Exceptions\TooSmallPasswordException;
use Modules\users\Exceptions\TooSmallUsernameException;
use Modules\users\Exceptions\UsernameExistsException;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 22:27
*@lastUpdate 1396-07-25 - 2017-10-17 22:27
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
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
		return $this->getLoadDesign()->getBodyHTML();
	}
	public function getLoadDesign()
	{
		$manageuserController=new manageuserController();
		$manageuserController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("onlineclass");
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
		$translator=new ModuleTranslator("onlineclass");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new manageuser_Design();
		$fullname=$design->getFullname()->getValue();
		$ismale_ID=$design->getIsmale()->getSelectedID();
		$email=$design->getEmail()->getValue();
		$mobile=$design->getMobile()->getValue();
		$registration_time=$design->getRegistration_time()->getTime();
		$devicecode=$design->getDevicecode()->getValue();
            $username=$design->getUserName()->getValue();
            $password=$design->getPassword()->getValue();
		$Result=$manageuserController->BtnSave($this->getID(),$fullname,$ismale_ID,$email,$mobile,$registration_time,$devicecode,$username,$password);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("onlineclass","manageusers");
		}
//			AppRooter::redirect($ManageListRooter->getAbsoluteURL(),DEFAULT_PAGESAVEREDIRECTTIME);
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
        catch (nosamepassException $ex) {

            $design=new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("رمز عبور و تکرار آن یکی نیست");
        } catch (UsernameExistsException $ex2) {
            $design=new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage( " کاربری با این نام کاربری قبلا ثبت نام کرده است");
        } catch (TooSmallUsernameException $ex3) {
            $design=new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage( " طول نام کاربری بسیار کوتاه است ");
        } catch (TooSmallPasswordException $ex3) {
            $design=new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage( "کلمه عبور باید بیشتر از 8 حرف باشد");
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