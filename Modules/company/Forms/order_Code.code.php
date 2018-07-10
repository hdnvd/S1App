<?php
namespace Modules\company\Forms;
use core\CoreClasses\services\FormCode;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\company\Controllers\orderController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-28 - 2017-09-19 16:32
*@lastUpdate 1396-06-28 - 2017-09-19 16:32
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class order_Code extends FormCode {
	public function load()
	{
		$orderController=new orderController();
		$translator=new ModuleTranslator("company");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$orderController->load($this->getHttpGETparameter("serial","-1"));
			$design=new order_Design();
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

    public function btnPayPreOrder_Click()
    {
        $orderhomeController=new orderController();
        $translator=new ModuleTranslator("company");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        $design=new order_Design();
        $Result=$orderhomeController->BtnPayPreOrder($this->getHttpGETparameter("serial","-1"));
        AppRooter::redirect(DEFAULT_PUBLICURL . "/fa/finance/epayment.jsp?id=".$Result['transaction']['id']);
        $design->setData($Result);
        $design->setMessage("در حال انتقال به صفحه پرداخت");
        return $design->getBodyHTML();
    }
    public function btnPay_Click()
    {
        $orderhomeController=new orderController();
        $translator=new ModuleTranslator("company");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        $design=new order_Design();
        $Result=$orderhomeController->BtnPay($this->getHttpGETparameter("serial","-1"));
        AppRooter::redirect(DEFAULT_PUBLICURL . "/fa/finance/epayment.jsp?id=".$Result['transaction']['id']);
        $design->setData($Result);
        $design->setMessage("در حال انتقال به صفحه پرداخت");
        return $design->getBodyHTML();
    }
}
?>