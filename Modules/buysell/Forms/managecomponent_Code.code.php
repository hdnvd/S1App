<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\GRecaptchaValidationStatus;
use core\CoreClasses\services\FormCode;
use Modules\buysell\Constants;
use Modules\buysell\Exceptions\ProductNotFoundException;
use Modules\common\Forms\message_Design;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\managecomponentController;
use Modules\files\PublicClasses\uploadHelper;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-26 - 2017-02-14 14:56
*@lastUpdate 1395-11-26 - 2017-02-14 14:56
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponent_Code extends FormCode {

    public function __construct($namespace=null)
    {
        parent::__construct($namespace);
        $this->setThemePage("admin.php");
        $this->setTitle("مدیریت قطعه");
    }
	public function load()
	{
		$managecomponentController=new managecomponentController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try
        {
            $Result=$managecomponentController->load($this->getID(),$this->getHttpGETparameter('groupid',1));
            $design=new managecomponent_Design();
            $design->setData($Result);
            $design->setMessage("");
            return $design->getBodyHTML();
        }
        catch (ProductNotFoundException $ex)
        {
            return "محصول مورد نظر پیدا نشد";
        }
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
        $managecomponentController = new managecomponentController();
        $translator = new ModuleTranslator("buysell");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        $design = new managecomponent_Design();
        $recaptchaStatus = $design->getRecaptcha()->getValidationStatus();
        if ($recaptchaStatus == GRecaptchaValidationStatus::$VALID) {
        $txtTitle = $design->getTxtTitle()->getValue();
        $cmbComponentGroup_ID = $design->getCmbComponentGroup()->getSelectedID();
        $txtprice = $design->getTxtprice()->getValue();
        $cmbUseStatus_ID = $design->getCmbUseStatus()->getSelectedID();
        $cmbCountry_ID = $design->getCmbCountry()->getSelectedID();
		$cmbCarModel_ID=$design->getCarmodel_fid()->getSelectedID();
		$txtDetails=$design->getTxtDetails()->getValue();
            $carGroup=$this->getHttpGETparameter('groupid',1);
		$Result=$managecomponentController->BtnSave($this->getID(),$txtTitle,$cmbComponentGroup_ID,$txtprice,$cmbUseStatus_ID,$cmbCountry_ID,$cmbCarModel_ID,$txtDetails,$carGroup);
		$design->setData($Result);
        $Ar=new AppRooter('buysell','managecomponentphoto');
        $Ar->addParameter(new UrlParameter('id',$Result['id']));
        $design->setMessage(AppRooter::redirect($Ar->getAbsoluteURL()));
		return $design->getBodyHTML();
        } else if ($recaptchaStatus == GRecaptchaValidationStatus::$NOTCLICKED) {
            $design = new message_Design();
            $design->setMessageType("error");
            $design->setMessage("سوال امنیتی پاسخ داده نشده");
            return $design->getBodyHTML();
        } else {
            $design = new message_Design();
            $design->setMessageType("error");
            $design->setMessage("پاسخ سوال امنیتی صحیح نبود،لطفا دوباره تلاش کنید");
            return $design->getBodyHTML();
        }
	}
}
?>