<?php

namespace Modules\contactus\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\contactus\Entity\contactus_usermessageEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/06/04 19:13:00
 *@lastUpdate 2015/06/04 19:13:00
 *@SweetFrameworkHelperVersion 1.102
*/


class messageController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$msgEnt=new contactus_usermessageEntity($DBAccessor);
		$result['message']=$msgEnt->Select($ID, null, null, null, null, null, null, null, null, null,null, array('id'), array('false'), "0,1");
		$DBAccessor->close_connection();
		return $result;
	}
}
?>
