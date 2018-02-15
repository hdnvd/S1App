<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_employeeEntity;
use Modules\itsap\Entity\itsap_unitEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_degreeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-17 - 2017-12-08 09:41
*@lastUpdate 1396-09-17 - 2017-12-08 09:41
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class OrganizationController extends Controller {

	public function getCurrentUserInfo()
	{
		$role_systemuser_fid=(new sessionuser())->getSystemUserID();
		return $this->getSystemUserInfo($role_systemuser_fid);
	}
    public function getSystemUserInfo($SystemUserID)
    {
        $DBAccessor=new dbaccess();
        $empEnt=new itsap_employeeEntity($DBAccessor);
        $empEnt=$empEnt->FindOne(new QueryLogic([new FieldCondition(itsap_employeeEntity::$ROLE_SYSTEMUSER_FID,$SystemUserID)]));
        $unit=new itsap_unitEntity($DBAccessor);
        $unit->setId($empEnt->getUnit_fid());
        $DBAccessor->close_connection();
        $result=['employee'=>$empEnt,'unit'=>$unit];
        return $result;
    }
    public function getEmployeeInfo($EmployeeID)
    {
        $DBAccessor=new dbaccess();
        $empEnt=new itsap_employeeEntity($DBAccessor);
        $empEnt->setId($EmployeeID);
        $unit=new itsap_unitEntity($DBAccessor);
        $unit->setId($empEnt->getUnit_fid());
        $DBAccessor->close_connection();
        $result=['employee'=>$empEnt,'unit'=>$unit];
        return $result;
    }
}
?>