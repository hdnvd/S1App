<?php

namespace Modules\oras\Controllers;

use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\oras\Entity\oras_employeeroleEntity;
use Modules\oras\Entity\oras_roleEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\oras\Entity\oras_recordEntity;
use Modules\oras\Entity\oras_shifttypeEntity;
use Modules\oras\Entity\oras_recordtypeEntity;
use Modules\oras\Entity\oras_employeeEntity;
use Modules\oras\Entity\oras_placeEntity;
use Modules\oras\Entity\oras_file1Entity;
use Modules\oras\Entity\oras_file2Entity;
use Modules\oras\Entity\oras_file3Entity;
use Modules\oras\Entity\oras_file4Entity;

/**
 * @author Hadi AmirNahavandi
 * @creationDate 1396-07-12 - 2017-10-04 03:03
 * @lastUpdate 1396-07-12 - 2017-10-04 03:03
 * @SweetFrameworkHelperVersion 2.002
 * @SweetFrameworkVersion 2.002
 */
class managerecordController extends Controller
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

    public function load($ID, $EmployeeID, $PlaceID,$RoleID)
    {
        $Language_fid = CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor = new dbaccess();
        $su = new sessionuser();
        $role_systemuser_fid = $su->getSystemUserID();
        $UserID = null;
        if (!$this->getAdminMode())
            $UserID = $role_systemuser_fid;
        $result = array();
        $recordEntityObject = new oras_recordEntity($DBAccessor);
        $shifttypeEntityObject = new oras_shifttypeEntity($DBAccessor);
        $result['shifttype_fid'] = $shifttypeEntityObject->FindAll(new QueryLogic());
        $recordtypeEntityObject = new oras_recordtypeEntity($DBAccessor);
        $result['recordtype_fid'] = $recordtypeEntityObject->FindAll(new QueryLogic());



        $result['record'] = $recordEntityObject;
        if ($ID != -1) {
            $recordEntityObject->setId($ID);
            if ($recordEntityObject->getId() == -1)
                throw new DataNotFoundException();
            if ($UserID != null && $recordEntityObject->getRole_systemuser_fid() != $UserID)
                throw new DataNotFoundException();
            $result['record'] = $recordEntityObject;
            $EmployeeID=$recordEntityObject->getEmployee_fid();
            $RoleID=$recordEntityObject->getRole_fid();
            $PlaceID=$recordEntityObject->getPlace_fid();
        }
        if ($EmployeeID > 0) {
            $employeeEntityObject = new oras_employeeEntity($DBAccessor);
            $employeeEntityObject->setId($EmployeeID);
            $result['employee_fid'] = $employeeEntityObject;
        }

        if ($RoleID > 0) {
            $roleEntityObject = new oras_roleEntity($DBAccessor);
            $roleEntityObject->setId($RoleID);
            $result['role_fid'] = $roleEntityObject;
        }
        if ($PlaceID > 0) {
            $placeEntityObject = new oras_placeEntity($DBAccessor);
            $placeEntityObject->setId($PlaceID);
            $result['place_fid'] = $placeEntityObject;
        }
        $result['param1'] = "";
        $DBAccessor->close_connection();
        return $result;
    }

    /**
     * @param int $EmployeeID
     * @param dbaccess $DBAccessor
     * @return oras_employeeroleEntity
     */
    private function getEmployeeLastRole($EmployeeID, dbaccess $DBAccessor)
    {
        $empRole=new oras_employeeroleEntity($DBAccessor);
        $q2=new QueryLogic();
        $q2->addCondition(new FieldCondition(oras_employeeroleEntity::$EMPLOYEE_FID,$EmployeeID));
        $q2->addOrderBy(oras_employeeroleEntity::$START_TIME,true);
        return $empRole->FindOne($q2);
    }
    public function BtnSave($ID, $title, $occurance_date, $description, $shifttype_fid, $recordtype_fid, $employee_fid, $place_fid, $file1_flu, $file2_flu, $file3_flu, $file4_flu)
    {


        $registration_time=time();
        $Language_fid = CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor = new dbaccess();
        $Role_fid=-1;
        if($employee_fid>0 && $place_fid<=0) {
            $Role = $this->getEmployeeLastRole($employee_fid, $DBAccessor);
            if ($Role != null){
                $place_fid = $Role->getPlace_fid();
                $Role_fid = $Role->getRole_fid();
            }
        }

        $su = new sessionuser();
        $role_systemuser_fid = $su->getSystemUserID();
        $UserID = null;
        if (!$this->getAdminMode())
            $UserID = $role_systemuser_fid;
        $result = array();
        $recordEntityObject = new oras_recordEntity($DBAccessor);
        $file1_fluURL = '';
        if ($file1_flu != null && count($file1_flu) > 0)
            $file1_fluURL = $file1_flu[0]['url'];
        $file2_fluURL = '';
        if ($file2_flu != null && count($file2_flu) > 0)
            $file2_fluURL = $file2_flu[0]['url'];
        $file3_fluURL = '';
        if ($file3_flu != null && count($file3_flu) > 0)
            $file3_fluURL = $file3_flu[0]['url'];
        $file4_fluURL = '';
        if ($file4_flu != null && count($file4_flu) > 0)
            $file4_fluURL = $file4_flu[0]['url'];
        $this->ValidateFieldArray([$title, $occurance_date, $description, $shifttype_fid, $recordtype_fid, $employee_fid, $place_fid, $file1_fluURL, $file2_fluURL, $file3_fluURL, $file4_fluURL], [$recordEntityObject->getFieldInfo(oras_recordEntity::$TITLE), $recordEntityObject->getFieldInfo(oras_recordEntity::$OCCURANCE_DATE), $recordEntityObject->getFieldInfo(oras_recordEntity::$DESCRIPTION), $recordEntityObject->getFieldInfo(oras_recordEntity::$SHIFTTYPE_FID), $recordEntityObject->getFieldInfo(oras_recordEntity::$RECORDTYPE_FID), $recordEntityObject->getFieldInfo(oras_recordEntity::$EMPLOYEE_FID), $recordEntityObject->getFieldInfo(oras_recordEntity::$PLACE_FID), $recordEntityObject->getFieldInfo(oras_recordEntity::$FILE1_FLU), $recordEntityObject->getFieldInfo(oras_recordEntity::$FILE2_FLU), $recordEntityObject->getFieldInfo(oras_recordEntity::$FILE3_FLU), $recordEntityObject->getFieldInfo(oras_recordEntity::$FILE4_FLU)]);
        if ($ID == -1) {
            $recordEntityObject->setTitle($title);
            $recordEntityObject->setOccurance_date($occurance_date);
            $recordEntityObject->setDescription($description);
            $recordEntityObject->setShifttype_fid($shifttype_fid);
            $recordEntityObject->setRecordtype_fid($recordtype_fid);
            $recordEntityObject->setEmployee_fid($employee_fid);
            $recordEntityObject->setPlace_fid($place_fid);
            $recordEntityObject->setRegistration_time($registration_time);
            $recordEntityObject->setFile1_flu($file1_fluURL);
            $recordEntityObject->setFile2_flu($file2_fluURL);
            $recordEntityObject->setFile3_flu($file3_fluURL);
            $recordEntityObject->setFile4_flu($file4_fluURL);
            $recordEntityObject->setRole_systemuser_fid($role_systemuser_fid);
            $recordEntityObject->setRole_fid($Role_fid);
            $recordEntityObject->Save();
        } else {
            $recordEntityObject->setId($ID);
            if ($recordEntityObject->getId() == -1)
                throw new DataNotFoundException();
            if ($UserID != null && $recordEntityObject->getRole_systemuser_fid() != $UserID)
                throw new DataNotFoundException();
            $recordEntityObject->setTitle($title);
            $recordEntityObject->setOccurance_date($occurance_date);
            $recordEntityObject->setDescription($description);
            $recordEntityObject->setShifttype_fid($shifttype_fid);
            $recordEntityObject->setRecordtype_fid($recordtype_fid);
            $recordEntityObject->setEmployee_fid($employee_fid);
            $recordEntityObject->setPlace_fid($place_fid);
            $recordEntityObject->setRegistration_time($registration_time);
            if($file1_fluURL!="")
                $recordEntityObject->setFile1_flu($file1_fluURL);
            if($file2_fluURL!="")
                $recordEntityObject->setFile2_flu($file2_fluURL);
            if($file3_fluURL!="")
                $recordEntityObject->setFile3_flu($file3_fluURL);
            if($file4_fluURL!="")
                $recordEntityObject->setFile4_flu($file4_fluURL);
            $recordEntityObject->Save();
        }
        $result = $this->load($ID,$employee_fid,$place_fid,$Role_fid);
        $result['param1'] = "";
        $DBAccessor->close_connection();
        return $result;
    }
}

?>