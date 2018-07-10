<?php

namespace Modules\company\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\company\Entity\company_productEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/02/19 12:34:08
 *@lastUpdate 2015/02/19 12:34:08
*/


class productsController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$PEnt=new company_productEntity($DBAccessor);
		$result['products']=$PEnt->Select(null, null, null, null, null, null, array(), array(), "0,20");
		$DBAccessor->close_connection();
		return $result;
	}
}
?>
