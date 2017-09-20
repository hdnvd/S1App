<?php
namespace Modules\company\Forms;
use core\CoreClasses\services\FormCode;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\company\Controllers\manageorderController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-28 - 2017-09-19 16:32
*@lastUpdate 1396-06-28 - 2017-09-19 16:32
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageorder_Code extends FormCode {    
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
		$manageorderController=new manageorderController();
		$manageorderController->setAdminMode($this->adminMode);
		$translator=new ModuleTranslator("company");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$manageorderController->load($this->getID());
			$design=new manageorder_Design();
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
		$manageorderController=new manageorderController();
		$translator=new ModuleTranslator("company");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new manageorder_Design();
		$descriptions=$design->getDescriptions()->getValue();
		$similarproducts=$design->getSimilarproducts()->getValue();
		$email=$design->getEmail()->getValue();
		$orderdate=$design->getOrderdate()->getValue();
		$mobile=$design->getMobile()->getValue();
		$name=$design->getName()->getValue();
		$family=$design->getFamily()->getValue();
		$paydate=$design->getPaydate()->getValue();
		$package_fid_ID=$design->getPackage_fid()->getSelectedID();
		$Result=$manageorderController->BtnSave(-1,$descriptions,$similarproducts,$email,$mobile,$name,$family,$package_fid_ID);
		$design->setData($Result);
		$design->setMessage("سفارش شما با موفقیت ثبت شد.");
		AppRooter::redirect(DEFAULT_PUBLICURL . "fa/company/order.jsp?serial=" . $Result['order']->getOrderserial());
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