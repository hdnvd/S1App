<?php

namespace Modules\pages\Controllers;

use core\CoreClasses\services\Controller;
use Modules\pages\Entity\pageEntity;
use Modules\pages\Entity\tagEntity;
use Modules\pages\Entity\pagetagEntity;

/**
 *
 * @author Hadi Nahavandi
 * @version 0.1
 * 
 *        
 */
class pageLoadController extends Controller {
	public function LoadPage($PageID)
	{
		
		$pageEntity=new pageEntity();
		$page=$pageEntity->loadPage($PageID);
		if(!is_null($page))
		{
			$tagEntity=new pagetagEntity($PageID);
			$tags=$tagEntity->getContentTags();
			$result['tags']=$tags;
			$result['page']=$page;
			return $result;
		}
		return null;
	}
}

?>