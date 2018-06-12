<?php
namespace Modules\sfman\Controllers;
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
*@creationDate 1396-08-17 - 2017-11-08 14:23
*@lastUpdate 1396-08-17 - 2017-11-08 14:23
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managetableController extends Controller {
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
        $result['sql']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnGenerateSQL($ID,$txtTableName,$txtFields)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$fields=explode(',',$txtFields);
		$SQL="CREATE TABLE `sweetp_" . $txtTableName. "` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `deletetime` int(11) NOT NULL DEFAULT '-1'";
        $AllCount1 = count($fields);
        for ($i = 0; $i < $AllCount1; $i++) {
            $item=trim($fields[$i]);
            $items=explode(' ',$item);
            $type='text';
            if(count($items)>1)
            {
                if($items[1]=='i')
                    $type='int(11)';
            }
            $SQL.=",`" .$items[0]."`  $type NOT NULL";
        }
        $SQL.=') ENGINE=InnoDB DEFAULT CHARSET=utf8;';
		if($ID==-1){
			//INSERT NEW DATA
		}
		else{
			//UPDATE DATA
		}
		$result=$this->load($ID);
		$result['sql']=$SQL;
		$DBAccessor->close_connection();
		return $result;
	}
}
?>