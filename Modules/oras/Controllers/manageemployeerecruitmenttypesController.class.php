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
use Modules\oras\Entity\oras_employeerecruitmenttypeEntity;
use Modules\oras\Entity\oras_employeeEntity;
use Modules\oras\Entity\oras_recruitmenttypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-10 - 2017-10-02 23:05
*@lastUpdate 1396-07-10 - 2017-10-02 23:05
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageemployeerecruitmenttypesController extends employeerecruitmenttypelistController {
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
		$employeerecruitmenttypeEnt=new oras_employeerecruitmenttypeEntity($DBAccessor);
		$employeerecruitmenttypeEnt->setId($ID);
		if($employeerecruitmenttypeEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $employeerecruitmenttypeEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$employeerecruitmenttypeEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>