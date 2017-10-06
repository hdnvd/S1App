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
*@creationDate 1396-07-12 - 2017-10-04 16:20
*@lastUpdate 1396-07-12 - 2017-10-04 16:20
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class employeerolelistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic,$EmployeeID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
        $employeeEntityObject = new oras_employeeEntity($DBAccessor);
        $employeeEntityObject->setId($EmployeeID);
        $result['employee_fid'] = $employeeEntityObject;
		$roleEntityObject=new oras_roleEntity($DBAccessor);
		$result['role_fid']=$roleEntityObject->FindAll(new QueryLogic());
		$recruitmenttypeEntityObject=new oras_recruitmenttypeEntity($DBAccessor);
		$result['recruitmenttype_fid']=$recruitmenttypeEntityObject->FindAll(new QueryLogic());
		$placeEntityObject=new oras_placeEntity($DBAccessor);
		$result['place_fid']=$placeEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        $QueryLogic->addCondition(new FieldCondition(oras_employeeroleEntity::$EMPLOYEE_FID,$EmployeeID));
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(oras_employeeroleEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$employeeroleEnt=new oras_employeeroleEntity($DBAccessor);
		$result['employeerole']=$employeeroleEnt;
		$allcount=$employeeroleEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$employeeroleEnt->FindAll($QueryLogic);
        $data=$result['data'];
        $dataCount=0;
        if($data!=null)
            $dataCount=count($data);
        for($i=0;$i<$dataCount;$i++)
        {
            $roleEntityObject=new oras_roleEntity($DBAccessor);
            $roleEntityObject->setId($data[$i]->getRole_fid());
            $result['role_fids'][$i]=$roleEntityObject;
            $recruitmenttypeEntityObject=new oras_recruitmenttypeEntity($DBAccessor);
            $recruitmenttypeEntityObject->setId($data[$i]->getRecruitmenttype_fid());
            $result['recruitmenttype_fids'][$i]=$recruitmenttypeEntityObject;
            $placeEntityObject=new oras_placeEntity($DBAccessor);
            $placeEntityObject->setId($data[$i]->getPlace_fid());
            $result['place_fids'][$i]=$placeEntityObject;
        }
		$DBAccessor->close_connection();
		return $result;
	}
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
	public function load($PageNum,$EmployeeID)
	{
		$DBAccessor=new dbaccess();
		$employeeroleEnt=new oras_employeeroleEntity($DBAccessor);
		$q=new QueryLogic();
        $q->addOrderBy("start_time",false);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q,$EmployeeID);
	}
	public function Search($PageNum,$employee_fid,$role_fid,$recruitmenttype_fid,$place_fid,$start_time_from,$start_time_to,$sortby,$isdesc,$EmployeeID)
	{
		$DBAccessor=new dbaccess();
		$employeeroleEnt=new oras_employeeroleEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addCondition(new FieldCondition("employee_fid","%$employee_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("role_fid","%$role_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("recruitmenttype_fid","%$recruitmenttype_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("place_fid","%$place_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("start_time",$start_time_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("start_time",$start_time_to,LogicalOperator::Smaller));
		$sortByField=$employeeroleEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q,$EmployeeID);
	}
}
?>