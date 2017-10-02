<?php
namespace Modules\users\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\users\Controllers\managemenuitemController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-09 - 2017-10-01 01:08
*@lastUpdate 1396-07-09 - 2017-10-01 01:08
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managemenuitem_Code extends FormCode {    
private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	public function load()
	{
		$managemenuitemController=new managemenuitemController();
		$managemenuitemController->setAdminMode($this->adminMode);
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$managemenuitemController->load($this->getID());
			$design=new managemenuitem_Design();
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
		return $design->getBodyHTML();
	}
	public function __construct($namespace)
	{
		parent::__construct($namespace);
		$this->setTitle("مدیریت منو");
        $this->setThemePage("admin.php");
	}
	public function getID()
	{
		$id=-1;
		if(isset($_GET['id']))
			$id=$_GET['id'];
		return $id;
	}
	public function btnSave_Click()
	{
		$managemenuitemController=new managemenuitemController();
		$managemenuitemController->setAdminMode($this->adminMode);
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new managemenuitem_Design();
		$latintitle=$design->getLatintitle()->getValue();
		$module=$design->getModule()->getValue();
		$page=$design->getPage()->getValue();
		$parameters=$design->getParameters()->getValue();
		$Result=$managemenuitemController->BtnSave($this->getID(),$latintitle,$module,$page,$parameters);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->adminMode){
			$ManageListRooter=new AppRooter("users","managemenuitems");
		}
		else{
			$ManageListRooter=new AppRooter("users","manageusermenuitems");
		}
			AppRooter::redirect($ManageListRooter->getAbsoluteURL(),1000);
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