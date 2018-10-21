<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_degreeEntity;
use Modules\itsap\Entity\itsap_unitEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use Modules\itsap\Entity\itsap_employeeEntity;
use Modules\users\PublicClasses\User;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-17 - 2017-12-08 11:51
*@lastUpdate 1396-09-17 - 2017-12-08 11:51
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageemployeeController extends Controller {
	private $adminMode=true;
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
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$employeeEntityObject=new itsap_employeeEntity($DBAccessor);
//		$unitEntityObject=new itsap_unitEntity($DBAccessor);
//		$result['unit_fid']=$unitEntityObject->FindAll(new QueryLogic());
		$degreeEntityObject=new itsap_degreeEntity($DBAccessor);
		$result['degree_fid']=$degreeEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('employee_fid',$ID));
		$result['employee']=$employeeEntityObject;
		if($ID!=-1){
			$employeeEntityObject->setId($ID);
			if($employeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $employeeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
            if($su->getUserType()!=3 && $su->getUserType()!=1)//!=SystemAdmin Or Developer
            {
                $org=new OrganizationController();
                $TopUnitID=($org->getCurrentUserInfo())['unit']->getTopunit_fid();
                $UnitEnt=new itsap_unitEntity($DBAccessor);
                $UnitEnt->setId($employeeEntityObject->getUnit_fid());
                if($UnitEnt->getId()<=0 || $UnitEnt->getTopunit_fid()!=$TopUnitID)
                    throw new DataNotFoundException();
            }
			$result['employee']=$employeeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function ResetPassword($ID)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=$role_systemuser_fid;
        $result=array();
        $employeeEntityObject=new itsap_employeeEntity($DBAccessor);
        $employeeEntityObject->setId($ID);
        if($employeeEntityObject->getId()<=0)
            throw new DataNotFoundException();
        $Unit=new itsap_unitEntity($DBAccessor);
        $Unit->setId($employeeEntityObject->getUnit_fid());
        if($su->getUserType()!=3 && $su->getUserType()!=1)//!=SystemAdmin Or Developer
        {
            $org=new OrganizationController();
            $TopUnitID=($org->getCurrentUserInfo())['unit']->getTopunit_fid();

            if($Unit->getId()<=0 || $Unit->getTopunit_fid()!=$TopUnitID)
                throw new DataNotFoundException();
        }

        User::UpdatePassword($employeeEntityObject->getRole_systemuser_fid(),$employeeEntityObject->getMellicode(),$DBAccessor);
        $result=$this->load($ID);
        $result['param1']="";
        $DBAccessor->close_connection();
        return $result;

    }
	public function BtnSave($ID,$unit_fid,$emp_code,$mellicode,$name,$family,$mobile,$degree_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$employeeEntityObject=new itsap_employeeEntity($DBAccessor);
        $Unit=new itsap_unitEntity($DBAccessor);
        if($ID==-1)
            $Unit->setId($unit_fid);
        else
        {
            $employeeEntityObject->setId($ID);
            $Unit->setId($employeeEntityObject->getUnit_fid());
        }

		if($Unit->getId()<=0)
            throw new DataNotFoundException();
        if($su->getUserType()!=3 && $su->getUserType()!=1)//!=SystemAdmin Or Developer
        {
            $org=new OrganizationController();
            $TopUnitID=($org->getCurrentUserInfo())['unit']->getTopunit_fid();

            if($Unit->getId()<=0 || $Unit->getTopunit_fid()!=$TopUnitID)
                throw new DataNotFoundException();
        }

		$this->ValidateFieldArray([$unit_fid,$emp_code,$mellicode,$name,$family,$mobile,$degree_fid],[$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$UNIT_FID),$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$EMP_CODE),$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$MELLICODE),$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$NAME),$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$FAMILY),$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$MOBILE),$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$DEGREE_FID)]);

		$role=5;//normal
//        echo $Unit->getId();
        if($Unit->getIsfava())
        {
            $role=6; //Fava Operator
            if($ID>0 && $Unit->getAdmin_employee_fid()==$ID)
                $role=7;//Fava Admin
//            echo $role;
        }

        if($Unit->getIssecurity())
        {
            $role=9;
        }
        $DBAccessor->close_connection();
		if($ID==-1){
            $DBAccessor=new dbaccess();
            $DBAccessor->beginTransaction();
            $id=User::addUser($mellicode,$mellicode);
            User::setUserRole($id,$role);
			$employeeEntityObject->setUnit_fid($unit_fid);
			$employeeEntityObject->setEmp_code($emp_code);
			$employeeEntityObject->setMellicode($mellicode);
			$employeeEntityObject->setName($name);
			$employeeEntityObject->setFamily($family);
			$employeeEntityObject->setMobile($mobile);
			$employeeEntityObject->setDegree_fid($degree_fid);
			$employeeEntityObject->setRole_systemuser_fid($id);
			$employeeEntityObject->Save();

			$ID=$employeeEntityObject->getId();
            $DBAccessor->commit();
		}
		else{

			$employeeEntityObject->setId($ID);
			if($employeeEntityObject->getId()==-1)
				throw new DataNotFoundException();

            $UserID=$employeeEntityObject->getRole_systemuser_fid();

			if($mellicode!=$employeeEntityObject->getMellicode())
            {
                    User::UpdatePassword($UserID,$mellicode,$DBAccessor);
            }
			$employeeEntityObject->setEmp_code($emp_code);
			$employeeEntityObject->setMellicode($mellicode);
			$employeeEntityObject->setName($name);
			$employeeEntityObject->setFamily($family);
			$employeeEntityObject->setMobile($mobile);
			$employeeEntityObject->setDegree_fid($degree_fid);
			$employeeEntityObject->Save();
            User::setUserRole($employeeEntityObject->getRole_systemuser_fid(),$role);
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('employee_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>