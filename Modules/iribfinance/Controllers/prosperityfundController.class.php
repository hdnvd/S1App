<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_prosperityfundEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:01
*@lastUpdate 1396-11-05 - 2018-01-25 18:01
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class prosperityfundController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$prosperityfundEntityObject=new iribfinance_prosperityfundEntity($DBAccessor);
		$result['prosperityfund']=$prosperityfundEntityObject;
		if($ID!=-1){
			$prosperityfundEntityObject->setId($ID);
			if($prosperityfundEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$result['prosperityfund']=$prosperityfundEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>