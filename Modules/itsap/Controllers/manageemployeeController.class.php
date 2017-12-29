<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_degreeEntity;
use Modules\itsap\Entity\itsap_unitEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Entity\roleSystemUserEntity;
use Modules\users\Entity\RoleSystemUserRoleEntity;
use Modules\users\Exceptions\UsernameExistsException;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_employeeEntity;
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
		$unitEntityObject=new itsap_unitEntity($DBAccessor);
		$result['unit_fid']=$unitEntityObject->FindAll(new QueryLogic());
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
			$result['employee']=$employeeEntityObject;
		}
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
		$this->ValidateFieldArray([$unit_fid,$emp_code,$mellicode,$name,$family,$mobile,$degree_fid],[$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$UNIT_FID),$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$EMP_CODE),$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$MELLICODE),$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$NAME),$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$FAMILY),$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$MOBILE),$employeeEntityObject->getFieldInfo(itsap_employeeEntity::$DEGREE_FID)]);
		if($ID==-1){
            $sysUserEnt=new roleSystemUserEntity($DBAccessor);
            $DBAccessor->beginTransaction();
            $found=$sysUserEnt->Select(array("username"),array($mellicode));
            if($found!=null)
                throw new UsernameExistsException();

            $id=$sysUserEnt->Add($mellicode,$mellicode);
            $roleEnt=new RoleSystemUserRoleEntity();
            $roleEnt->addUserRole($id,5);
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
			if($UserID!=null && $employeeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();

			if($mellicode!=$employeeEntityObject->getMellicode())
            {
                $sysUserEnt=new roleSystemUserEntity($DBAccessor);
                $found=$sysUserEnt->Select(array("username"),array($employeeEntityObject->getMellicode()));
                if($found==null)
                {
                    throw new DataNotFoundException();
                }
                else
                {
                    $sysUserEnt->Update($found[0]['id'],$mellicode,$mellicode,$mellicode,-1);
                    $employeeEntityObject->setRole_systemuser_fid($found[0]['id']);
                }
            }
			$employeeEntityObject->setUnit_fid($unit_fid);
			$employeeEntityObject->setEmp_code($emp_code);
			$employeeEntityObject->setMellicode($mellicode);
			$employeeEntityObject->setName($name);
			$employeeEntityObject->setFamily($family);
			$employeeEntityObject->setMobile($mobile);
			$employeeEntityObject->setDegree_fid($degree_fid);
			$employeeEntityObject->Save();
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