<?php

namespace Modules\posts\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\posts\Entity\posts_tagEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/02/25 12:57:43
 *@lastUpdate 2015/02/25 12:57:43
 *@SweetFrameworkHelperVersion 1.102
*/


class tagsController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$TE=new posts_tagEntity($DBAccessor);
		$result=array();
		$result['tags']=$TE->Select(null, null, null, array(), array(), "0,1000");
		$DBAccessor->close_connection();
		return $result;
	}
}
?>
