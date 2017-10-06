<?php
namespace Modules\oras\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\oras\Entity\oras_employeeroleEntity;
use Modules\oras\Entity\oras_employeeEntity;
use Modules\oras\Entity\oras_roleEntity;
use Modules\oras\Entity\oras_recruitmenttypeEntity;
use Modules\oras\Entity\oras_placeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 03:02
*@lastUpdate 1396-07-12 - 2017-10-04 03:02
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageemployeerolesController extends employeerolelistController {
	private $PAGESIZE=10;
	public function DeleteItem($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$employeeroleEnt=new oras_employeeroleEntity($DBAccessor);
		$employeeroleEnt->setId($ID);
		if($employeeroleEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $employeeroleEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$employeeroleEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>