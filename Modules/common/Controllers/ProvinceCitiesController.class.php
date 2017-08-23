<?php

namespace Modules\common\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\common\Entity\common_cityEntity;
use Modules\common\Entity\common_provinceEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/06/26 18:03:08
 *@lastUpdate 2015/06/26 18:03:08
 *@SweetFrameworkHelperVersion 1.104
*/


class ProvinceCitiesController extends Controller {
	protected function getProvinces()
	{
		$DBAccessor=new dbaccess();
		$result=array();
		$ProvEnt=new common_provinceEntity($DBAccessor);
		$CityEnt=new common_cityEntity($DBAccessor);
		
		$result=$ProvEnt->Select(null, null, null, null, array("id"), array(false), "0,100");
		for($i=0;$i<count($result);$i++)
		    $result[$i]['cities']=$CityEnt->Select(null, null, null, $result[$i]['id'], array("title"), array(false), "0,100");
		$DBAccessor->close_connection();
		return $result;
	}
}
?>
