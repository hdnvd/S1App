<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-07 - 2017-08-29 16:28
*@lastUpdate 1396-06-07 - 2017-08-29 16:28
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class selectgroupController extends Controller {
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
}
?>