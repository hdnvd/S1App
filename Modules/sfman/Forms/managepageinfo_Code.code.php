<?php
namespace Modules\sfman\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\sfman\Controllers\managepageinfoController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-08 - 2017-09-30 23:34
*@lastUpdate 1396-07-08 - 2017-09-30 23:34
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managepageinfo_Code extends FormCode {    
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
		$managepageinfoController=new managepageinfoController();
		$managepageinfoController->setAdminMode($this->adminMode);
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$managepageinfoController->load($this->getID());
			$design=new managepageinfo_Design();
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
		$this->setTitle("Manage Pageinfo");
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
		$managepageinfoController=new managepageinfoController();
		$managepageinfoController->setAdminMode($this->adminMode);
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new managepageinfo_Design();
		$title=$design->getTitle()->getValue();
		$description=$design->getDescription()->getValue();
		$keywords=$design->getKeywords()->getValue();
		$themepage=$design->getThemepage()->getValue();
		$internalurl=$design->getInternalurl()->getValue();
		$canonicalurl=$design->getCanonicalurl()->getValue();
		$sentenceinurl=$design->getSentenceinurl()->getValue();
		$Result=$managepageinfoController->BtnSave($this->getID(),$title,$description,$keywords,$themepage,$internalurl,$canonicalurl,$sentenceinurl);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->adminMode){
			$ManageListRooter=new AppRooter("sfman","managepageinfos");
		}
		else{
			$ManageListRooter=new AppRooter("sfman","manageuserpageinfos");
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