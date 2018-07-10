<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use Modules\buysell\Entity\buysell_carcolorEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-25 - 2017-06-15 02:06
*@lastUpdate 1396-03-25 - 2017-06-15 02:06
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecarcolorsController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$carcolorEnt=new buysell_carcolorEntity($DBAccessor);
		$q=new QueryLogic();
		$result['data']=$carcolorEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function DeleteItem($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$carcolorEnt=new buysell_carcolorEntity($DBAccessor);
		$carcolorEnt->setId($ID);
		$carcolorEnt->Remove();
		return $this->load(-1);
		$DBAccessor->close_connection();
	}
}
?>