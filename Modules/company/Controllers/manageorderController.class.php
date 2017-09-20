<?php
namespace Modules\company\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\finance\Entity\finance_transactionEntity;
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
class manageorderController extends Controller {    
private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->adminMode)
            $UserID=$role_systemuser_fid;
		$result=array();
			$packageEntityObject=new company_packageEntity($DBAccessor);
			$result['package_fid']=$packageEntityObject->FindAll(new QueryLogic());
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$descriptions,$similarproducts,$email,$mobile,$name,$family,$package_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->adminMode)
            $UserID=$role_systemuser_fid;
		$result=array();
        $orderdate=time();
			$orderEntityObject=new company_orderEntity($DBAccessor);
			$orderEntityObject->setDescriptions($descriptions);
			$orderEntityObject->setSimilarproducts($similarproducts);
			$orderEntityObject->setEmail($email);
			$orderEntityObject->setOrderdate($orderdate);
			$orderEntityObject->setMobile($mobile);
			$orderEntityObject->setName($name);
			$orderEntityObject->setFamily($family);
			$orderEntityObject->setPaydate(-1);
			$orderEntityObject->setPackage_fid($package_fid);
			$orderEntityObject->setFinance_transaction_fid(-1);
			$orderEntityObject->setPrepayment_finance_transaction_fid(-1);
			$orderEntityObject->Save();

        $OrderID=$orderEntityObject->getId();
        $serial="w,ع5" . $OrderID ."%" .  time();
        $serial=md5($serial);
        $serial=strtolower($serial);
        $orderEntityObject->setOrderserial($serial);

        $orderEntityObject->Save();
        $this->sendOnTelegram($orderEntityObject);

		$result=$this->load($ID);
		$result['order']=$orderEntityObject;
		$DBAccessor->close_connection();
		return $result;
	}
	private function sendOnTelegram(company_orderEntity $orderEntityObject)
    {
        $PMan=new ParameterManager();
        $orderDate=$orderEntityObject->getOrderdate();
        $date = new SweetDate(true, true, 'Asia/Tehran');
        $theDate=$date->date("Y/m/d H:i",$orderDate,false);
        $ChatID=$PMan->getParameter("company_order_admintelegramchatid");
        $BotToken=$PMan->getParameter("company_order_telegram_bottoken");
            $this->PublishOnTelegram("سفارش جدید در تاریخ " . $theDate . "\n"  .DEFAULT_PUBLICURL . 'fa/company/order.jsp?serial=' . $orderEntityObject->getOrderserial() . "\n\n", $ChatID, $BotToken);
    }
    private function PublishOnTelegram($Content,$ChatID,$BotToken)
    {
        $TC=new \TelegramClient($BotToken);
        $TC->sendMessage($ChatID, $Content, false, "", "");
    }
}
?>