<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_unitEntity;
use Modules\itsap\Exceptions\EmployeeHasUnitException;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_employeeEntity;
use Modules\users\PublicClasses\User;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-17 - 2017-12-08 11:51
*@lastUpdate 1396-09-17 - 2017-12-08 11:51
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageemployeesController extends employeelistController {
	private $PAGESIZE=10;
	public function DeleteItem($ID,$UnitID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();

        $UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$employeeEnt=new itsap_employeeEntity($DBAccessor);
		$employeeEnt->setId($ID);
        if($su->getUserType()!=3 && $su->getUserType()!=1)//!=SystemAdmin Or Developer
        {
            $org=new OrganizationController();
            $TopUnitID=($org->getCurrentUserInfo())['unit']->getTopunit_fid();
            $UnitEnt=new itsap_unitEntity($DBAccessor);
            $UnitEnt->setId($employeeEnt->getUnit_fid());
            if($UnitEnt->getId()<=0 || $UnitEnt->getTopunit_fid()!=$TopUnitID)
                throw new DataNotFoundException();
        }
		if($employeeEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $employeeEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$employeeEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1,$UnitID);
	}
    public function RemoveUnit($ID,$UnitID)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
        $employeeEnt=new itsap_employeeEntity($DBAccessor);
        $employeeEnt->setId($ID);
        if($employeeEnt->getId()==-1)
            throw new DataNotFoundException();
        if($UserID!=null && $employeeEnt->getRole_systemuser_fid()!=$UserID)
            throw new DataNotFoundException();

        $Unit=new itsap_unitEntity($DBAccessor);
        $Unit->setId($employeeEnt->getUnit_fid());
        if($Unit->getId()==-1)
            throw new DataNotFoundException();
        if($su->getUserType()!=3 && $su->getUserType()!=1)//!=SystemAdmin Or Developer
        {
            $UnitID=$Unit->getId();
            $org=new OrganizationController();
            $TopUnitID=($org->getCurrentUserInfo())['unit']->getTopunit_fid();
            if($Unit->getTopunit_fid()!=$TopUnitID)
                throw new DataNotFoundException();
        }

        $LastAdminEmpID=$Unit->getAdmin_employee_fid();
        if($LastAdminEmpID==$ID)
        {
            $Unit->setAdmin_employee_fid(-1);
            $Unit->Save();
        }
        $employeeEnt->setUnit_fid(-1);
        $employeeEnt->Save();
        User::setUserRole($employeeEnt->getRole_systemuser_fid(),8);//User With No Unit
        $DBAccessor->close_connection();
        return $this->load(-1,$UnitID);
    }

    public function AddToUnit($MelliCode,$UnitID)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $employeeEnt=new itsap_employeeEntity($DBAccessor);
        $employeeEnt=$employeeEnt->FindOne(new QueryLogic([new FieldCondition(itsap_employeeEntity::$MELLICODE,$MelliCode)]));
        if($employeeEnt==null || $employeeEnt->getId()==-1)
            throw new DataNotFoundException();
        if($employeeEnt->getUnit_fid()>0)
            throw new EmployeeHasUnitException();
        $Unit=new itsap_unitEntity($DBAccessor);
        $Unit->setId($UnitID);
        if($Unit->getId()==-1)
            throw new DataNotFoundException();
        if($su->getUserType()!=3 && $su->getUserType()!=1)//!=SystemAdmin Or Developer
        {
            $UnitID=$Unit->getId();
            $org=new OrganizationController();
            $TopUnitID=($org->getCurrentUserInfo())['unit']->getTopunit_fid();
            if($Unit->getTopunit_fid()!=$TopUnitID)
                throw new DataNotFoundException();
        }

        $employeeEnt->setUnit_fid($UnitID);
        $employeeEnt->Save();
        $role=5;//Simple User
        if($Unit->getIsfava())
            $role=6;//Fava Operator
        User::setUserRole($employeeEnt->getRole_systemuser_fid(),$role);
        $DBAccessor->close_connection();
        return $this->load(-1,$UnitID);
    }
    public function SetAsAdmin($ID,$UnitID)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
        $employeeEnt=new itsap_employeeEntity($DBAccessor);
        $employeeEnt->setId($ID);
        if($employeeEnt->getId()==-1)
            throw new DataNotFoundException();
        if($UserID!=null && $employeeEnt->getRole_systemuser_fid()!=$UserID)
            throw new DataNotFoundException();
        $Unit=new itsap_unitEntity($DBAccessor);
        $Unit->setId($UnitID);
        if($Unit->getId()==-1)
            throw new DataNotFoundException();
        if($su->getUserType()!=3 && $su->getUserType()!=1)//!=SystemAdmin Or Developer
        {
            $org=new OrganizationController();
            $TopUnitID=($org->getCurrentUserInfo())['unit']->getTopunit_fid();
            $Unit2=new itsap_unitEntity($DBAccessor);
            $Unit2->setId($employeeEnt->getUnit_fid());
            if($Unit2->getTopunit_fid()!=$TopUnitID)
                throw new DataNotFoundException();
        }

        $LastAdminEmpID=$Unit->getAdmin_employee_fid();
        //Change Last Admin Role
        if($LastAdminEmpID>0)
        {
            $LastAdminEmp=new itsap_employeeEntity($DBAccessor);
            $LastAdminEmp->setId($LastAdminEmpID);
            $role=5;//Simple User
            if($Unit->getIsfava())
                $role=6; //Fava Operator
            User::setUserRole($LastAdminEmp->getRole_systemuser_fid(),$role);
        }

        $NewAdminEmp=new itsap_employeeEntity($DBAccessor);
        $NewAdminEmp->setId($ID);
        if($NewAdminEmp->getId()==-1)
            throw new DataNotFoundException();
        $role=5;//Simple User
        if($Unit->getIsfava())
            $role=7; //Fava Admin
        User::setUserRole($NewAdminEmp->getRole_systemuser_fid(),$role);
        $Unit->setAdmin_employee_fid($ID);
        $Unit->Save();
        $DBAccessor->close_connection();
        return $this->load(-1,$UnitID);
    }
}
?>