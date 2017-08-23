<?php

namespace Modules\employment\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\common\Controllers\ProvinceCitiesController;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/06/28 11:26:00
 *@lastUpdate 2015/06/28 11:26:00
 *@SweetFrameworkHelperVersion 1.105
*/


class registeremployeeController extends ProvinceCitiesController {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		
		$result['provinces']=$this->getProvinces();
		$DBAccessor->close_connection();
		return $result;
	}
}
?>
