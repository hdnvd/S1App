<?php

namespace Modules\contactus\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\contactus\Entity\contactus_usermessageEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/06/04 19:12:41
 *@lastUpdate 2015/06/04 19:12:41
 *@SweetFrameworkHelperVersion 1.102
*/


class messagelistController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$msgEnt=new contactus_usermessageEntity($DBAccessor);
		
		$result['messages']=$msgEnt->Select(null, null, null, null, null, null, null, null, null, null,null, array('id'), array(true), "0,2000");
		$DBAccessor->close_connection();
		return $result;
	}
}
?>
