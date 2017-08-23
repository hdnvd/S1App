<?php

namespace Modules\pages\Controllers;

use core\CoreClasses\services\Controller;
use Modules\pages\EntityObjects\pageEntityObject;
use Modules\pages\Entity\pageEntity;
use core\CoreClasses\SweetDate;
use Modules\pages\Entity\pagetagEntity;

/**
 *
 * @author Hadi Nahavandi
 * @version 0.1
 * @last Edit 1393 9 4 17:27
 *        
 */
class pageManageController extends pageLoadController {
	
	public function AddPage($Name,$Title,$Content,$Language,$Thumb,$IsPublished,$Tags)
	{
		$Date=$this->now();
		$pageEntity=new pageEntity();
		$pageID=$pageEntity->addPage($Name,$Title,$Content,$Language,$Date,$Thumb,$IsPublished);
	
		$tagentity=new pagetagEntity($pageID);
		$tagentity->setTags($Tags);
		$tagentity->addTags();
	}
	public function EditPage($PageID,$Name,$Title,$Content,$Language,$Thumb,$IsPublished,$Tags)
	{
		$Date=$this->now();
		$pageEntity=new pageEntity();
		$pageEntity->Update($PageID,$Name,$Title,$Content,$Language,$Date,$Thumb,"1",null);
	
		$tagentity=new pagetagEntity($PageID);
		$tagentity->setTags($Tags);
		$tagentity->addTags();
	}
	private function now()
	{
		date_default_timezone_set("UTC");
		$date = new SweetDate(true, true, 'Asia/Tehran'); 
		return $date->date("Y-m-d H:i",false,false);
	}

}

?>