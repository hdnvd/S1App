<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\iribfinance\Entity\iribfinance_programestimationemployeeEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_paymentlicenceEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:01
*@lastUpdate 1396-11-05 - 2018-01-25 18:01
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class paymentlicenceController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$paymentlicenceEntityObject=new iribfinance_paymentlicenceEntity($DBAccessor);
		$result['paymentlicence']=$paymentlicenceEntityObject;
		if($ID!=-1){
			$paymentlicenceEntityObject->setId($ID);
			if($paymentlicenceEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['paymentlicence']=$paymentlicenceEntityObject;
			$programestimationemployeeEntityObject=new iribfinance_programestimationemployeeEntity($DBAccessor);
			$programestimationemployeeEntityObject->SetId($result['paymentlicence']->getProgramestimationemployee_fid());
			if($programestimationemployeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['programestimationemployee_fid']=$programestimationemployeeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>