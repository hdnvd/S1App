<?php

namespace Modules\company\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\company\Entity\company_customerEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/02/19 15:54:05
 *@lastUpdate 2015/02/19 15:54:05
 *@SweetFrameworkHelperVersion 1.102
*/


class lastcustomersController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$CEnt=new company_customerEntity($DBAccessor);
		$result['customers']=$CEnt->Select(null, null, null, null, null, array(), array(), "0,20");
		$DBAccessor->close_connection();
		return $result;
	}
}
?>
