<?php
namespace Modules\finance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\common\PublicClasses\AppRooter;
use Modules\finance\Entity\finance_bankpaymentinfoEntity;
use Modules\finance\Entity\finance_transactionEntity;
use Modules\finance\Exceptions\AmountMismatchException;
use Modules\finance\Exceptions\EmptyAmountException;
use Modules\finance\Exceptions\EmptyApiCodeException;
use Modules\finance\Exceptions\InvalidPortalException;
use Modules\finance\Exceptions\InvalidTransactionIDException;
use Modules\finance\Exceptions\NonNummericAmountException;
use Modules\finance\Exceptions\NoRedirectURLException;
use Modules\finance\Exceptions\PaymentCanceledException;
use Modules\finance\Exceptions\TooSmallAmountException;
use Modules\finance\Exceptions\TransactionWithErrorException;
use Modules\finance\Exceptions\URLmisMatchException;
use Modules\finance\PublicClasses\Payment;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\parameters\PublicClasses\ParameterManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-13 - 2017-09-04 20)51
*@lastUpdate 1396-06-13 - 2017-09-04 20)51
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class epaymentController extends Controller {
	private $PAGESIZE=10;
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		if($ID!=-1){
			$ent=new finance_bankpaymentinfoEntity($DBAccessor);
			$ent->setId($ID);
			$result['paymentinfo']=$ent;
			$Tent=new finance_transactionEntity($DBAccessor);
			$Tent->setId($ent->getTransaction_fid());
            $result['transaction']=$Tent;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
    public function getTransactionID($ID)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $result=array();
        if($ID!=-1){
            $Pent=new finance_bankpaymentinfoEntity($DBAccessor);
            $Pent->setId($ID);
            if($Pent->getBanktransactionid()<=0)
            {
                $Tent=new finance_transactionEntity($DBAccessor);
                $Tent->setId($Pent->getTransaction_fid());
                $payir = new \payir();
                $param=ParameterManager::getParameter('payirapicode');
                $payir->setApiKey($param);
                $tp = new AppRooter("finance", "epayment");
                $res = $payir->send($Tent->getAmount(), $tp->getAbsoluteURL(), $Pent->getFactorserial());
                $res = json_decode($res);
                $Pent->setBanktransactionid($res->transId);
                $Pent->Save();
                $result['transactionID']=$res->transId;
            }
            else
            {
                $result['transactionID']=$Pent->getTransaction_fid();
            }

        }
        $result['param1']="";
        $DBAccessor->close_connection();
        return $result;
    }
    public function Commit($BankTransactioID,$Status,$CardNumber,$FactorSerial,$ErrorCode)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $result=array();
        $Tent=new finance_transactionEntity($DBAccessor);
        $Pent=new finance_bankpaymentinfoEntity($DBAccessor);
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition(finance_bankpaymentinfoEntity::$BANKTRANSACTIONID,$BankTransactioID,LogicalOperator::Equal));
        $q->addCondition(new FieldCondition(finance_bankpaymentinfoEntity::$FACTORSERIAL,$FactorSerial,LogicalOperator::Equal));
        $Pent=$Pent->FindOne($q);
        $Tent->setId($Pent->getTransaction_fid());

        $DBAccessor=new dbaccess();
        $DBAccessor->beginTransaction();
        if($Status==1)
        {
            $pay=new \payir();
            $param=ParameterManager::getParameter('payirapicode');
            $pay->setApiKey($param);
            $VerifyResult=$pay->verify($BankTransactioID);
            $VerifyResult = json_decode($VerifyResult);
            if($VerifyResult->status==1)
            {
                if($VerifyResult->amount!=$Tent->getAmount())
                {
                    throw new AmountMismatchException();
                }
            }
            else
            {
                if($VerifyResult->errorCode==-1)
                    throw new EmptyApiCodeException();
                if($VerifyResult->errorCode==-2)
                    throw new InvalidTransactionIDException();
                if($VerifyResult->errorCode==-3 || $VerifyResult->errorCode==-4)
                    throw new InvalidPortalException();
                if($VerifyResult->errorCode==-5)
                    throw new TransactionWithErrorException();
                throw new \Exception();
            }
            $Pent->setStatus_fid(1);
            $Tent->setIssuccessful(true);
            $Tent->setCommit_time(time());
            $Tent->Save();
        }
        else
        {
            $Pent->setStatus_fid($ErrorCode);
                if ($ErrorCode==-1)
                    throw new EmptyApiCodeException();
                if ($ErrorCode==-2)
                    throw new EmptyAmountException();
                if ($ErrorCode==-3)
                    throw new NonNummericAmountException();
                if ($ErrorCode==-4)
                    throw new TooSmallAmountException();
                if ($ErrorCode==-5)
                    throw new NoRedirectURLException();
                if ($ErrorCode==-6)
                    throw new InvalidPortalException();
                if ($ErrorCode==-7)
                    throw new InvalidPortalException();
                if ($ErrorCode==-8)
                    throw new URLmisMatchException();
                if ($ErrorCode=="failed")
                    throw new TransactionWithErrorException();
                if($ErrorCode=="")
                    throw new PaymentCanceledException();
                throw new \Exception();

        }
        $Pent->setCardnumber($CardNumber);
        $Pent->Save();
        $DBAccessor->commit();
        $result['paymentinfo']=$Pent;
        $DBAccessor->close_connection();
        return $result;
    }

}
?>