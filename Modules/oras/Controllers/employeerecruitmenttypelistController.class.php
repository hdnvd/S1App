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
class employeerecruitmenttypelistController extends Controller {
	private $PAGESIZE=10;    
	private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
    /**
     * @return bool $adminMode
     */
    public function getAdminMode()
    {
        return $this->adminMode;
    }
	public function load($PageNum)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$employeeEntityObject=new oras_employeeEntity($DBAccessor);
		$result['employee_fid']=$employeeEntityObject->FindAll(new QueryLogic());
		$recruitmenttypeEntityObject=new oras_recruitmenttypeEntity($DBAccessor);
		$result['recruitmenttype_fid']=$recruitmenttypeEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$employeerecruitmenttypeEnt=new oras_employeerecruitmenttypeEntity($DBAccessor);
		$result['employeerecruitmenttype']=$employeerecruitmenttypeEnt;
		$q=new QueryLogic();
		if($UserID!=null)
            $q->addCondition(new FieldCondition(oras_employeerecruitmenttypeEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$q->addOrderBy("id",true);
		$allcount=$employeerecruitmenttypeEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$employeerecruitmenttypeEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function Search($PageNum,$employee_fid,$recruitmenttype_fid,$start_date_from,$start_date_to,$end_date_from,$end_date_to,$sortby,$isdesc)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$employeeEntityObject=new oras_employeeEntity($DBAccessor);
		$result['employee_fid']=$employeeEntityObject->FindAll(new QueryLogic());
		$recruitmenttypeEntityObject=new oras_recruitmenttypeEntity($DBAccessor);
		$result['recruitmenttype_fid']=$recruitmenttypeEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$employeerecruitmenttypeEnt=new oras_employeerecruitmenttypeEntity($DBAccessor);
		$result['employeerecruitmenttype']=$employeerecruitmenttypeEnt;
		$q=new QueryLogic();
		if($UserID!=null)
            $q->addCondition(new FieldCondition(oras_employeerecruitmenttypeEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$q->addCondition(new FieldCondition("employee_fid","%$employee_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("recruitmenttype_fid","%$recruitmenttype_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("start_date",$start_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("start_date",$start_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("end_date",$end_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("end_date",$end_date_to,LogicalOperator::Smaller));
		$q->addOrderBy($sortby,$isdesc);
		$allcount=$employeerecruitmenttypeEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$employeerecruitmenttypeEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>