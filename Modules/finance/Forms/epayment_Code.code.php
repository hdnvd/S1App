<?php

namespace Modules\finance\Forms;

use core\CoreClasses\services\FormCode;
use Modules\common\PublicClasses\AppRooter;
use Modules\finance\Entity\finance_bankpaymentinfoEntity;
use Modules\finance\Exceptions\AmountMismatchException;
use Modules\finance\Exceptions\EmptyAmountException;
use Modules\finance\Exceptions\EmptyApiCodeException;
use Modules\finance\Exceptions\InvalidPortalException;
use Modules\finance\Exceptions\InvalidTransactionIDException;
use Modules\finance\Exceptions\NonNummericAmountException;
use Modules\finance\Exceptions\NoRedirectURLException;
use Modules\finance\Exceptions\TooSmallAmountException;
use Modules\finance\Exceptions\TransactionWithErrorException;
use Modules\finance\Exceptions\URLmisMatchException;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\finance\Controllers\epaymentController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;

/**
 * @author Hadi AmirNahavandi
 * @creationDate 1396-06-13 - 2017-09-04 20:51
 * @lastUpdate 1396-06-13 - 2017-09-04 20:51
 * @SweetFrameworkHelperVersion 2.002
 * @SweetFrameworkVersion 2.002
 */
class epayment_Code extends FormCode
{
    public function load()
    {
        $epaymentController = new epaymentController();
        $translator = new ModuleTranslator("finance");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        try {
            if (isset($_POST['transId'])) {
                $epaymentController->Commit($_POST['transId'],$_POST['status'],$_POST['cardNumber'],$_POST['factorNumber'],$_POST['errorCode']);
                $design = new message_Design();
                $design->setMessage("پرداخت شما با موفقیت انجام شد.شماره تراکنش: ".$_POST['transId']);
            } else {

                $Result = $epaymentController->load($this->getID());
                $design = new epayment_Design();
                $design->setData($Result);
                $design->setMessage("");
            }

        } catch (DataNotFoundException $dnfex) {
            $design = new message_Design();
            $design->setMessage("تراکنش مورد نظر پیدا نشد");
        }catch (EmptyAmountException $dnfex) {
            $design = new message_Design();
            $design->setMessage("خطا: مبلغ وارد نشده");
        } catch (EmptyApiCodeException $dnfex) {
            $design = new message_Design();
            $design->setMessage("خطا : کد درگاه صحیح نیست");
        } catch (InvalidPortalException $dnfex) {
            $design = new message_Design();
            $design->setMessage("خطا: کد درگاه صحیح نیست");
        } catch (NonNummericAmountException $dnfex) {
            $design = new message_Design();
            $design->setMessage("خطا: مبلغ وارد شده صحیح نیست");
        } catch (NoRedirectURLException $dnfex) {
            $design = new message_Design();
            $design->setMessage("خطا: آدرس برگشت وارد نشده");
        } catch (TooSmallAmountException $dnfex) {
            $design = new message_Design();
            $design->setMessage("خطا: مبلغ تراکنش کمتر از حداقل مجاز است");
        } catch (TransactionWithErrorException $dnfex) {
            $design = new message_Design();
            $design->setMessage("تراکنش به صورت ناموفق انجام شد،در صورتی که مبلغی از حساب شما کسر شده باشد تا ۷۲ ساعت آینده به حساب شما بازخواهد گشت");
        } catch (URLmisMatchException $dnfex) {
            $design = new message_Design();
            $design->setMessage("خطا: آدرس وب سایت با آدرس درگاه یکی نیست");
        }catch (InvalidTransactionIDException $dnfex) {
            $design = new message_Design();
            $design->setMessage("خطا: کد تراکنش صحیح نیست");
        }catch (AmountMismatchException $dnfex) {
            $design = new message_Design();
            $design->setMessage("خطا: تراکنش تایید شد ولی مبلغ وارد شده با مبلغ اولیه تراکنش یکسان نیست.به همین دلیل پرداخت شما در سیستم تایید نشد،لطفا با مدیر سیستم تماس بگیرید");
        }  catch (\Exception $uex) {
            $design = new message_Design();
            $design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
        }
        return $design->getBodyHTML();
    }

    public function btnPay_Click()
    {
        $epaymentController = new epaymentController();
        $translator = new ModuleTranslator("finance");
        $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
        try {
            $Result = $epaymentController->getTransactionID($this->getID());
            AppRooter::redirect("https://pay.ir/payment/gateway/" . $Result['transactionID']);
            $design=new message_Design();
        } catch (DataNotFoundException $dnfex) {
            $design = new message_Design();
            $design->setMessage("تراکنش مورد نظر پیدا نشد");
        } catch (\Exception $uex) {
            $design = new message_Design();
            $design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
        }
        return $design->getBodyHTML();
    }

    public function getID()
    {
        $id = -1;
        if (isset($_GET['id']))
            $id = $_GET['id'];
        return $id;
    }
}

?>