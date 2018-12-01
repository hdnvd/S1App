<?php
namespace Modules\company\Controllers;
use classes\Telegram\TelegramClient;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\finance\Entity\finance_transactionEntity;
use Modules\finance\PublicClasses\Payment;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\parameters\PublicClasses\ParameterManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\company\Entity\company_orderEntity;
use Modules\company\Entity\company_packageEntity;
use Modules\company\Entity\company_transactionEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-28 - 2017-09-19 16:32
*@lastUpdate 1396-06-28 - 2017-09-19 16:32
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class orderController extends Controller {
	public function load($OrderSerial)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$orderEntityObject=new company_orderEntity($DBAccessor);
		if($OrderSerial!="-1"){
		    $q=new QueryLogic();
		    $q->addCondition(new FieldCondition(company_orderEntity::$ORDERSERIAL,trim(strtolower($OrderSerial))));
			$orderEntityObject=$orderEntityObject->FindOne($q);
			if($orderEntityObject==null || $orderEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['order']=$orderEntityObject;
			$packageEntityObject=new company_packageEntity($DBAccessor);
			$packageEntityObject->SetId($result['order']->getPackage_fid());
			if($packageEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['package_fid']=$packageEntityObject;
			$finance_transactionEntityObject=new finance_transactionEntity($DBAccessor);
			$finance_transactionEntityObject->SetId($result['order']->getFinance_transaction_fid());
			$result['finance_transaction_fid']=$finance_transactionEntityObject;
			$prepayment_finance_transactionEntityObject=new finance_transactionEntity($DBAccessor);
			$prepayment_finance_transactionEntityObject->SetId($result['order']->getPrepayment_finance_transaction_fid());
			$result['prepayment_finance_transaction_fid']=$prepayment_finance_transactionEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
    public function BtnPayPreOrder($OrderSerial)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $result=array();
        if($OrderSerial==-1){
            //INSERT NEW DATA
        }
        else{
            $orderEnt=new company_orderEntity($DBAccessor);
            $q=new QueryLogic();
            $q->addCondition(new FieldCondition(company_orderEntity::$ORDERSERIAL,trim(strtolower($OrderSerial))));
            $orderEnt=$orderEnt->FindOne($q);
            $PID=$orderEnt->getPackage_fid();
            $Package=new company_packageEntity($DBAccessor);
            $Package->setId($PID);
            $price=$Package->getPrepayment();
            $pay=new Payment();
            $transaction=$pay->startTransaction($price,$orderEnt->getName(),$orderEnt->getFamily(),$orderEnt->getMobile(),1,"پرداخت پیش پرداخت سفارش پروژه ",2,true,"");
            $orderEnt->setPrepayment_finance_transaction_fid($transaction['transaction']['id']);
            $orderEnt->Save();
            $this->sendOnTelegram($orderEnt);
            $result=$this->load($OrderSerial);
            $result['transaction']['id']=$transaction['transaction']['id'];
        }
        $result['param1']="";
        $DBAccessor->close_connection();
        return $result;
    }
    public function BtnPay($OrderSerial)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $result=array();
        if($OrderSerial==-1){
            //INSERT NEW DATA
        }
        else{
            $orderEnt=new company_orderEntity($DBAccessor);
            $q=new QueryLogic();
            $q->addCondition(new FieldCondition(company_orderEntity::$ORDERSERIAL,trim(strtolower($OrderSerial))));
            $orderEnt=$orderEnt->FindOne($q);
            $PID=$orderEnt->getPackage_fid();
            $Package=new company_packageEntity($DBAccessor);
            $Package->setId($PID);
            $price=$Package->getPrice() - $Package->getPrepayment();
            $pay=new Payment();
            $transaction=$pay->startTransaction($price,$orderEnt->getName(),$orderEnt->getFamily(),$orderEnt->getMobile(),1,"پرداخت مبلغ باقی مانده سفارش پروژه ",2,true,"");
            $orderEnt->setFinance_transaction_fid($transaction['transaction']['id']);
            $orderEnt->Save();
            $this->sendOnTelegram($orderEnt);
            $result=$this->load($OrderSerial);
            $result['transaction']['id']=$transaction['transaction']['id'];
        }
        $result['param1']="";
        $DBAccessor->close_connection();
        return $result;
    }

    private function sendOnTelegram(company_orderEntity $orderEntityObject)
    {
        $PMan=new ParameterManager();
        $date = new SweetDate(true, true, 'Asia/Tehran');
        $theDate=$date->date("Y/m/d H:i",time(),false);
        $ChatID=$PMan->getParameter("company_order_admintelegramchatid");
        $BotToken=$PMan->getParameter("company_order_telegram_bottoken");
        $this->PublishOnTelegram("شروع به پرداخت  جدید در تاریخ " . $theDate . "\n"  .DEFAULT_PUBLICURL . 'fa/company/order.jsp?serial=' . $orderEntityObject->getOrderserial() . "\n\n", $ChatID, $BotToken);
    }
    private function PublishOnTelegram($Content,$ChatID,$BotToken)
    {
        $TC=new TelegramClient($BotToken);
        $TC->sendMessage($ChatID, $Content, false, "", "");
    }
}
?>