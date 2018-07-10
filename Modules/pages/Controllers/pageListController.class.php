<?php

namespace Modules\pages\Controllers;

use core\CoreClasses\services\Controller;
use Modules\pages\Entity\pagetagEntity;
use Modules\pages\Entity\pageEntity;
/**
 *
 * @author hadi
 *        
 */
class pageListController extends Controller{
	
	
	public function loadTagPages($tag)
	{
		$pagetagEntity=new pagetagEntity(null);
		$contents=$pagetagEntity->getTagContents($tag);
		$result=null;
		for($i=0;$i<count($contents);$i++)
		{
			$tmppage=new pageEntity();
			$result[$i]=$tmppage->loadPage($contents[$i]->id)[0];
		}
		return $result;
	}
}

?>