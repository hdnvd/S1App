<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\iribfinance\Entity\iribfinance_activityEntity;
use Modules\iribfinance\Entity\iribfinance_employeeEntity;
use Modules\iribfinance\Entity\iribfinance_employmenttypeEntity;
use Modules\iribfinance\Entity\iribfinance_programestimationEntity;
use Modules\iribfinance\Entity\iribfinance_workunitEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_programestimationemployeeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 20:01
*@lastUpdate 1396-11-05 - 2018-01-25 20:01
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class programestimationemployeelistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$employeeEntityObject=new iribfinance_employeeEntity($DBAccessor);
		$result['employee_fid']=$employeeEntityObject->FindAll(new QueryLogic());
		$activityEntityObject=new iribfinance_activityEntity($DBAccessor);
		$result['activity_fid']=$activityEntityObject->FindAll(new QueryLogic());
		$programestimationEntityObject=new iribfinance_programestimationEntity($DBAccessor);
		$result['programestimation_fid']=$programestimationEntityObject->FindAll(new QueryLogic());
		$employmenttypeEntityObject=new iribfinance_employmenttypeEntity($DBAccessor);
		$result['employmenttype_fid']=$employmenttypeEntityObject->FindAll(new QueryLogic());
		$workunitEntityObject=new iribfinance_workunitEntity($DBAccessor);
		$result['workunit_fid']=$workunitEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(iribfinance_programestimationemployeeEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$programestimationemployeeEnt=new iribfinance_programestimationemployeeEntity($DBAccessor);
		$result['programestimationemployee']=$programestimationemployeeEnt;
		$allcount=$programestimationemployeeEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$programestimationemployeeEnt->FindAll($QueryLogic);
        $AllCount1 = count($result['data']);
        for ($i = 0; $i < $AllCount1; $i++) {
            $item=$result['data'][$i];
//            $result['employee'][$i]=new iribfinance_employeeEntity($DBAccessor);
            $em=new iribfinance_employeeEntity($DBAccessor);
            $act=new iribfinance_activityEntity($DBAccessor);
            $em->setId($item->getEmployee_fid());
            $act->setId($item->getActivity_fid());
            $result['employee'][$i]=$em;
            $result['activity'][$i]=$act;

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
	public function load($PageNum,$EstimationID)
	{
		$DBAccessor=new dbaccess();
		$programestimationemployeeEnt=new iribfinance_programestimationemployeeEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
        $q->addCondition(new FieldCondition(iribfinance_programestimationemployeeEntity::$PROGRAMESTIMATION_FID,$EstimationID));
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$employee_fid,$activity_fid,$programestimation_fid,$employmenttype_fid,$totalwork,$workunit_fid,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$programestimationemployeeEnt=new iribfinance_programestimationemployeeEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("employee_fid","%$employee_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("activity_fid","%$activity_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("programestimation_fid","%$programestimation_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("employmenttype_fid","%$employmenttype_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("totalwork","%$totalwork%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("workunit_fid","%$workunit_fid%",LogicalOperator::LIKE));
		$sortByField=$programestimationemployeeEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>