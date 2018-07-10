<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_carmodelEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-21 - 2017-02-09 01:49
*@lastUpdate 1395-11-21 - 2017-02-09 01:49
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class managecarmodelsController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $ModEnt=new buysell_carmodelEntity($DBAccessor);
		$result['carmodels']=$ModEnt->Select(null,null,null,null,-1,array('carmaker_fid','title'),array(false,false),"0,1000");
		$DBAccessor->close_connection();
		return $result;
	}
}
?>