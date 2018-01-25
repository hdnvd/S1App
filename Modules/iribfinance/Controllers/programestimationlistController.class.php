<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\iribfinance\Entity\iribfinance_classEntity;
use Modules\iribfinance\Entity\iribfinance_departmentEntity;
use Modules\iribfinance\Entity\iribfinance_employeeEntity;
use Modules\iribfinance\Entity\iribfinance_paycenterEntity;
use Modules\iribfinance\Entity\iribfinance_programmaketypeEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_programestimationEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:27
*@lastUpdate 1396-11-05 - 2018-01-25 18:27
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class programestimationlistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$departmentEntityObject=new iribfinance_departmentEntity($DBAccessor);
		$result['department_fid']=$departmentEntityObject->FindAll(new QueryLogic());
		$classEntityObject=new iribfinance_classEntity($DBAccessor);
		$result['class_fid']=$classEntityObject->FindAll(new QueryLogic());
		$programmaketypeEntityObject=new iribfinance_programmaketypeEntity($DBAccessor);
		$result['programmaketype_fid']=$programmaketypeEntityObject->FindAll(new QueryLogic());
		$producer_employeeEntityObject=new iribfinance_employeeEntity($DBAccessor);
		$result['producer_employee_fid']=$producer_employeeEntityObject->FindAll(new QueryLogic());
		$executor_employeeEntityObject=new iribfinance_employeeEntity($DBAccessor);
		$result['executor_employee_fid']=$executor_employeeEntityObject->FindAll(new QueryLogic());
		$paycenterEntityObject=new iribfinance_paycenterEntity($DBAccessor);
		$result['paycenter_fid']=$paycenterEntityObject->FindAll(new QueryLogic());
		$makergroup_paycenterEntityObject=new iribfinance_paycenterEntity($DBAccessor);
		$result['makergroup_paycenter_fid']=$makergroup_paycenterEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(iribfinance_programestimationEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$programestimationEnt=new iribfinance_programestimationEntity($DBAccessor);
		$result['programestimation']=$programestimationEnt;
		$allcount=$programestimationEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$programestimationEnt->FindAll($QueryLogic);
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
	public function load($PageNum)
	{
		$DBAccessor=new dbaccess();
		$programestimationEnt=new iribfinance_programestimationEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$title,$department_fid,$class_fid,$programmaketype_fid,$totalprogramcount,$timeperprogram,$is_haslegalproblem,$approval_date_from,$approval_date_to,$end_date_from,$end_date_to,$add_date_from,$add_date_to,$producer_employee_fid,$executor_employee_fid,$paycenter_fid,$makergroup_paycenter_fid,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$programestimationEnt=new iribfinance_programestimationEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("title","%$title%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("department_fid","%$department_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("class_fid","%$class_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("programmaketype_fid","%$programmaketype_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("totalprogramcount","%$totalprogramcount%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("timeperprogram","%$timeperprogram%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("is_haslegalproblem","%$is_haslegalproblem%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("approval_date",$approval_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("approval_date",$approval_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("end_date",$end_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("end_date",$end_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("add_date",$add_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("add_date",$add_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("producer_employee_fid","%$producer_employee_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("executor_employee_fid","%$executor_employee_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("paycenter_fid","%$paycenter_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("makergroup_paycenter_fid","%$makergroup_paycenter_fid%",LogicalOperator::LIKE));
		$sortByField=$programestimationEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>