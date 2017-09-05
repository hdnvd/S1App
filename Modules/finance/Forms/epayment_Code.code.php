<?php
namespace Modules\finance\Forms;
use core\CoreClasses\services\FormCode;
use Modules\common\PublicClasses\AppRooter;
use Modules\finance\Entity\finance_bankpaymentinfoEntity;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\finance\Controllers\epaymentController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-13 - 2017-09-04 20:51
*@lastUpdate 1396-06-13 - 2017-09-04 20:51
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class epayment_Code extends FormCode {
	public function load()
	{
		$epaymentController=new epaymentController();
		$translator=new ModuleTranslator("finance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$Result=$epaymentController->load($this->getID());
		if(isset($_POST['transId']))
        {
            $payir=new \payir();
            $payir->setApiKey("f512812c02020dada05b67e957ae57d0");
            echo $_POST['cardNumber'];
            echo $_POST['message'];
            if($_POST['message']=="OK")
            {
                $payir->verify($_POST['transId']);
                echo "Verified";
            }
        }
		$design=new epayment_Design();
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
    public function btnPay_Click()
    {
        $epaymentController=new epaymentController();
        $translator=new ModuleTranslator("finance");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        try{
            $Result=$epaymentController->load($this->getID());
            $payinf=$Result['paymentinfo'];
            $TransactionInf=$Result['transaction'];
            $payir=new \payir();
            $payir->setApiKey("f512812c02020dada05b67e957ae57d0");
            $tp=new AppRooter("finance","epayment");
            $res=$payir->send($TransactionInf->getAmount(),$tp->getAbsoluteURL(),$payinf->getFactorserial());
            $res=json_decode($res);
            AppRooter::redirect("https://pay.ir/payment/gateway/" . $res->transId);
            $design=new epayment_Design();
            $design->setData($Result);
            $design->setMessage("");
        }
        catch(DataNotFoundException $dnfex){
            $design=new message_Design();
            $design->setMessage("تراکنش مورد نظر پیدا نشد");
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
}
?>