<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_topunitEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-08 - 2017-11-29 16:57
*@lastUpdate 1396-09-08 - 2017-11-29 16:57
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class topunitController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$topunitEntityObject=new itsap_topunitEntity($DBAccessor);
		$result['topunit']=$topunitEntityObject;
		if($ID!=-1){
			$topunitEntityObject->setId($ID);
			if($topunitEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['topunit']=$topunitEntityObject;
			$topunitEntityObject=new itsap_topunitEntity($DBAccessor);
			$topunitEntityObject->SetId($result['topunit']->getTopunit_fid());
//			if($topunitEntityObject->getId()==-1)
//				throw new DataNotFoundException();
			$result['topunit_fid']=$topunitEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>