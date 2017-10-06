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
use Modules\oras\Entity\oras_employeeEntity;
use Modules\oras\Entity\oras_photoEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 16:08
*@lastUpdate 1396-07-12 - 2017-10-04 16:08
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageemployeesController extends employeelistController {
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
		$employeeEnt=new oras_employeeEntity($DBAccessor);
		$employeeEnt->setId($ID);
		if($employeeEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $employeeEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$employeeEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>