<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\iribfinance\Entity\iribfinance_taxtypeEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_activityEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:01
*@lastUpdate 1396-11-05 - 2018-01-25 18:01
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class activityController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$activityEntityObject=new iribfinance_activityEntity($DBAccessor);
		$result['activity']=$activityEntityObject;
		if($ID!=-1){
			$activityEntityObject->setId($ID);
			if($activityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['activity']=$activityEntityObject;
			$taxtypeEntityObject=new iribfinance_taxtypeEntity($DBAccessor);
			$taxtypeEntityObject->SetId($result['activity']->getTaxtype_fid());
			if($taxtypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['taxtype_fid']=$taxtypeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>