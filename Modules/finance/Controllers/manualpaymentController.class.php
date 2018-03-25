<?php
namespace Modules\finance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\finance\PublicClasses\Payment;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\users\PublicClasses\User;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-15 - 2017-09-06 16:47
*@lastUpdate 1396-06-15 - 2017-09-06 16:47
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manualpaymentController extends Controller {
	private $PAGESIZE=10;
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		if($ID!=-1){
			//Do Something...
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function TxtPay($ID,$txtName,$txtFamily,$txtTel,$txtDescription,$txtAmount,$username=null,$password=null,$RedirectURL="")
	{
        $txtAmount*=10;
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$PayInfo=null;

		if($ID==-1){
			$Pay=new Payment();
			if($username == null)
                $PayInfo = $Pay->startTransaction($txtAmount, $txtName, $txtFamily, $txtTel, 1, $txtDescription, 1, true, $RedirectURL);
            else
            {
                $userID=User::getSystemUserIDFromUserPass($username,$password);
                $PayInfo = $Pay->startTransaction($txtAmount,$txtName,$txtFamily,$txtTel,1,$txtDescription,1,true,$RedirectURL,$userID);

            }
        }
		else{
			//UPDATE DATA
		}
		$result=$this->load($ID);
		$result['param1']="";
		$result['payinfo']=$PayInfo;
		$DBAccessor->close_connection();
		return $result;
	}
}
?>