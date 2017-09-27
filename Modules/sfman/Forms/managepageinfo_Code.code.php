<?php
namespace Modules\sfman\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\sfman\Controllers\managepageinfoController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-06 - 2017-09-28 01:28
*@lastUpdate 1396-07-06 - 2017-09-28 01:28
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
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
		catch(\Exception $uex){
			$design=new message_Design();
			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
		}
		return $design->getBodyHTML();
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
		$translator=new ModuleTranslator("sfman");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new managepageinfo_Design();
		$title=$design->getTitle()->getValue();
		$description=$design->getDescription()->getValue();
		$keywords=$design->getKeywords()->getValue();
		$themepage=$design->getThemepage()->getValue();
		$internalurl=$design->getInternalurl()->getValue();
		$Result=$managepageinfoController->BtnSave($this->getID(),$title,$description,$keywords,$themepage,$internalurl);
		$design->setData($Result);
		$design->setMessage("btnSave is done!");
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
		catch(\Exception $uex){
			$design=new message_Design();
			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
		}
		return $design->getBodyHTML();
	}
}
?>