<?php
namespace Modules\wc\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\wc\Entity\wc_wcEntity;
use Modules\wc\Entity\wc_cityEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-16 - 2017-10-08 14:43
*@lastUpdate 1396-07-16 - 2017-10-08 14:43
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class wcController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$wcEntityObject=new wc_wcEntity($DBAccessor);
		$result['wc']=$wcEntityObject;
		if($ID!=-1){
			$wcEntityObject->setId($ID);
			if($wcEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['wc']=$wcEntityObject;
			$common_cityEntityObject=new wc_cityEntity($DBAccessor);
			$common_cityEntityObject->SetId($result['wc']->getCommon_city_fid());
			if($common_cityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['common_city_fid']=$common_cityEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>