<?php
namespace Modules\finance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\finance\Entity\finance_bankpaymentinfoEntity;
use Modules\finance\Entity\finance_transactionEntity;
use Modules\finance\PublicClasses\Payment;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-13 - 2017-09-04 20:51
*@lastUpdate 1396-06-13 - 2017-09-04 20:51
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
//		else
//        {
//            $p=new Payment();
//            $p->startTransaction("1000","هادی","امیرنهاوندی","09367356253",1);
//        }
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>