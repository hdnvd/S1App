<?php
namespace Modules\oras\Controllers;
use core\CoreClasses\Exception\InvalidParameterException;
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
class manageemployeerecruitmenttypeController extends Controller {    
private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
    public function getAdminMode()
    {
        return $this->adminMode;
    }
	public function load($ID,$EmployeeID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
		if($EmployeeID<=0)
            throw new InvalidParameterException();
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$employeerecruitmenttypeEntityObject=new oras_employeerecruitmenttypeEntity($DBAccessor);
        $employeerecruitmenttypeEntityObject2=new oras_employeerecruitmenttypeEntity($DBAccessor);
			$employeeEntityObject=new oras_employeeEntity($DBAccessor);
			$employeeEntityObject->setId($EmployeeID);
			$result['employee']=$employeeEntityObject;
			$q2=new QueryLogic();
			$q2->addCondition(new FieldCondition(oras_employeerecruitmenttypeEntity::$EMPLOYEE_FID,$EmployeeID));
			$q2->addOrderBy(oras_employeerecruitmenttypeEntity::$START_DATE,true);
			$result['lastinfo']=$employeerecruitmenttypeEntityObject2->FindOne($q2);
			$recruitmenttypeEntityObject=new oras_recruitmenttypeEntity($DBAccessor);
			$result['recruitmenttype_fid']=$recruitmenttypeEntityObject->FindAll(new QueryLogic());
		$result['employeerecruitmenttype']=$employeerecruitmenttypeEntityObject;
		if($ID!=-1){
			$employeerecruitmenttypeEntityObject->setId($ID);
			if($employeerecruitmenttypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $employeerecruitmenttypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['employeerecruitmenttype']=$employeerecruitmenttypeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$employee_fid,$recruitmenttype_fid,$start_date,$end_date)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$employeerecruitmenttypeEntityObject=new oras_employeerecruitmenttypeEntity($DBAccessor);
		$this->ValidateFieldArray([$employee_fid,$recruitmenttype_fid,$start_date,$end_date],[$employeerecruitmenttypeEntityObject->getFieldInfo(oras_employeerecruitmenttypeEntity::$EMPLOYEE_FID),$employeerecruitmenttypeEntityObject->getFieldInfo(oras_employeerecruitmenttypeEntity::$RECRUITMENTTYPE_FID),$employeerecruitmenttypeEntityObject->getFieldInfo(oras_employeerecruitmenttypeEntity::$START_DATE),$employeerecruitmenttypeEntityObject->getFieldInfo(oras_employeerecruitmenttypeEntity::$END_DATE)]);
		if($ID==-1){
			$employeerecruitmenttypeEntityObject->setEmployee_fid($employee_fid);
			$employeerecruitmenttypeEntityObject->setRecruitmenttype_fid($recruitmenttype_fid);
			$employeerecruitmenttypeEntityObject->setStart_date($start_date);
			$employeerecruitmenttypeEntityObject->setEnd_date($end_date);
			$employeerecruitmenttypeEntityObject->Save();
		}
		else{
			$employeerecruitmenttypeEntityObject->setId($ID);
			if($employeerecruitmenttypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $employeerecruitmenttypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$employeerecruitmenttypeEntityObject->setEmployee_fid($employee_fid);
			$employeerecruitmenttypeEntityObject->setRecruitmenttype_fid($recruitmenttype_fid);
			$employeerecruitmenttypeEntityObject->setStart_date($start_date);
			$employeerecruitmenttypeEntityObject->setEnd_date($end_date);
			$employeerecruitmenttypeEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>