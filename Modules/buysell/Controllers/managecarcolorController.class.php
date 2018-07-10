<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\db\QueryLogic;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use Modules\buysell\Entity\buysell_carcolorEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-25 - 2017-06-15 02:06
*@lastUpdate 1396-03-25 - 2017-06-15 02:06
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecarcolorController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$carcolorEntityObject=new buysell_carcolorEntity($DBAccessor);
		if($ID!=-1){
			$carcolorEntityObject->setId($ID);
			$result['carcolor']=$carcolorEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$latintitle,$title)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		if($ID==-1){
			$carcolorEntityObject=new buysell_carcolorEntity($DBAccessor);
			$carcolorEntityObject->setLatintitle($latintitle);
			$carcolorEntityObject->setTitle($title);
			$carcolorEntityObject->Save();
		}
		else{
			$carcolorEntityObject=new buysell_carcolorEntity($DBAccessor);
			$carcolorEntityObject->setId($ID);
			$carcolorEntityObject->setLatintitle($latintitle);
			$carcolorEntityObject->setTitle($title);
			$carcolorEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>