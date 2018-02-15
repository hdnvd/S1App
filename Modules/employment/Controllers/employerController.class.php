<?php

namespace Modules\employment\Controllers;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\common\Controllers\ProvinceCitiesController;
use Modules\employment\Entity\employment_employerEntity;
use Modules\users\PublicClasses\User;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/06/26 18:03:08
 *@lastUpdate 2015/06/26 18:03:08
 *@SweetFrameworkHelperVersion 1.104
*/


class employerController extends ProvinceCitiesController {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		
		$result['provinces']=$this->getProvinces();
		return $result;
	}
	public function Register($City,$Finance_type,$Title,$Mob,$Distance,$Mail,$Pass)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$result['provinces']=$this->getProvinces();
		$Ent=new employment_employerEntity($DBAccessor);
		$Systemuser_fid=-1;
        $Systemuser_fid=User::addUser($Mail,$Pass,$DBAccessor);
		$Ent->Insert($Title, null, null, $Mob, $Mail, null, null, null, null, $City, $Systemuser_fid, null, false, $Finance_type, $Distance, null, null);
		$DBAccessor->close_connection();
		return $result;
	}
}
?>
