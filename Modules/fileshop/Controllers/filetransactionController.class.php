<?php
namespace Modules\fileshop\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\fileshop\Entity\fileshop_filetransactionEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-09 - 2017-11-30 16:35
*@lastUpdate 1396-09-09 - 2017-11-30 16:35
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class filetransactionController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$filetransactionEntityObject=new fileshop_filetransactionEntity($DBAccessor);
		$result['filetransaction']=$filetransactionEntityObject;
		if($ID!=-1){
			$filetransactionEntityObject->setId($ID);
			if($filetransactionEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['filetransaction']=$filetransactionEntityObject;
			$fileEntityObject=new fileshop_fileEntity($DBAccessor);
			$fileEntityObject->SetId($result['filetransaction']->getFile_fid());
			if($fileEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['file_fid']=$fileEntityObject;
			$finance_bankpaymentinfoEntityObject=new fileshop_bankpaymentinfoEntity($DBAccessor);
			$finance_bankpaymentinfoEntityObject->SetId($result['filetransaction']->getFinance_bankpaymentinfo_fid());
			if($finance_bankpaymentinfoEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['finance_bankpaymentinfo_fid']=$finance_bankpaymentinfoEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>