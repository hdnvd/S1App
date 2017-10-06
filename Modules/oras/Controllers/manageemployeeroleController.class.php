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
 * @author Hadi AmirNahavandi
 * @creationDate 1396-07-12 - 2017-10-04 03:02
 * @lastUpdate 1396-07-12 - 2017-10-04 03:02
 * @SweetFrameworkHelperVersion 2.002
 * @SweetFrameworkVersion 2.002
 */
class manageemployeeroleController extends Controller
{
    private $adminMode = true;

    public function getAdminMode()
    {
        return $this->adminMode;
    }

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }

    public function load($ID, $EmployeeID)
    {
        $Language_fid = CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor = new dbaccess();
        $su = new sessionuser();
        $role_systemuser_fid = $su->getSystemUserID();
        $UserID = null;
        if (!$this->getAdminMode())
            $UserID = $role_systemuser_fid;
        $result = array();
        $employeeroleEntityObject = new oras_employeeroleEntity($DBAccessor);
        $employeeEntityObject = new oras_employeeEntity($DBAccessor);
        $employeeEntityObject->setId($EmployeeID);
        $result['employee_fid'] = $employeeEntityObject;
        $roleEntityObject = new oras_roleEntity($DBAccessor);
        $roleQ = new QueryLogic();
        $roleQ->addOrderBy(oras_roleEntity::$TITLE, false);
        $result['role_fid'] = $roleEntityObject->FindAll($roleQ);
        $recruitmenttypeEntityObject = new oras_recruitmenttypeEntity($DBAccessor);
        $result['recruitmenttype_fid'] = $recruitmenttypeEntityObject->FindAll(new QueryLogic());
        $placeEntityObject = new oras_placeEntity($DBAccessor);
        $PlaceQ = new QueryLogic();
        $PlaceQ->addOrderBy(oras_placeEntity::$TITLE, false);
        $result['place_fid'] = $placeEntityObject->FindAll($PlaceQ);
        $result['employeerole'] = $employeeroleEntityObject;
        if ($ID != -1) {
            $employeeroleEntityObject->setId($ID);
            if ($employeeroleEntityObject->getId() == -1)
                throw new DataNotFoundException();
            if ($UserID != null && $employeeroleEntityObject->getRole_systemuser_fid() != $UserID)
                throw new DataNotFoundException();
            $result['employee_fid']->setId($employeeroleEntityObject->getEmployee_fid());
            $result['employeerole'] = $employeeroleEntityObject;
        }
        $result['param1'] = "";
        $DBAccessor->close_connection();
        return $result;
    }

    public function BtnSave($ID, $employee_fid, $role_fid, $recruitmenttype_fid, $place_fid, $start_time)
    {
        $Language_fid = CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor = new dbaccess();
        $su = new sessionuser();
        $role_systemuser_fid = $su->getSystemUserID();
        $UserID = null;
        if (!$this->getAdminMode())
            $UserID = $role_systemuser_fid;
        $result = array();
        $employeeroleEntityObject = new oras_employeeroleEntity($DBAccessor);
        $this->ValidateFieldArray([$employee_fid, $role_fid, $recruitmenttype_fid, $place_fid, $start_time], [$employeeroleEntityObject->getFieldInfo(oras_employeeroleEntity::$EMPLOYEE_FID), $employeeroleEntityObject->getFieldInfo(oras_employeeroleEntity::$ROLE_FID), $employeeroleEntityObject->getFieldInfo(oras_employeeroleEntity::$RECRUITMENTTYPE_FID), $employeeroleEntityObject->getFieldInfo(oras_employeeroleEntity::$PLACE_FID), $employeeroleEntityObject->getFieldInfo(oras_employeeroleEntity::$START_TIME)]);
        if ($ID == -1) {
            $employeeroleEntityObject->setEmployee_fid($employee_fid);
            $employeeroleEntityObject->setRole_fid($role_fid);
            $employeeroleEntityObject->setRecruitmenttype_fid($recruitmenttype_fid);
            $employeeroleEntityObject->setPlace_fid($place_fid);
            $employeeroleEntityObject->setStart_time($start_time);
            $employeeroleEntityObject->Save();
        } else {
            $employeeroleEntityObject->setId($ID);
            if ($employeeroleEntityObject->getId() == -1)
                throw new DataNotFoundException();
            if ($UserID != null && $employeeroleEntityObject->getRole_systemuser_fid() != $UserID)
                throw new DataNotFoundException();
            $employeeroleEntityObject->setRole_fid($role_fid);
            $employeeroleEntityObject->setRecruitmenttype_fid($recruitmenttype_fid);
            $employeeroleEntityObject->setPlace_fid($place_fid);
            $employeeroleEntityObject->setStart_time($start_time);
            $employeeroleEntityObject->Save();
        }
        $result = $this->load($ID, $employee_fid);
        $result['param1'] = "";
        $DBAccessor->close_connection();
        return $result;
    }
}

?>