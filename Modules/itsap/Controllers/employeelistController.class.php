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
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_employeeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-17 - 2017-12-08 11:51
*@lastUpdate 1396-09-17 - 2017-12-08 11:51
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class employeelistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$unitEntityObject=new itsap_unitEntity($DBAccessor);
		$result['unit_fid']=$unitEntityObject->FindAll(new QueryLogic());
		$degreeEntityObject=new itsap_degreeEntity($DBAccessor);
		$result['degree_fid']=$degreeEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(itsap_employeeEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$employeeEnt=new itsap_employeeEntity($DBAccessor);
		$result['employee']=$employeeEnt;
		$allcount=$employeeEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$employeeEnt->FindAll($QueryLogic);
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
		$employeeEnt=new itsap_employeeEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$unit_fid,$emp_code,$mellicode,$name,$family,$mobile,$degree_fid,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$employeeEnt=new itsap_employeeEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("unit_fid","%$unit_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("emp_code","%$emp_code%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("mellicode","%$mellicode%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("name","%$name%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("family","%$family%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("mobile","%$mobile%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("degree_fid","%$degree_fid%",LogicalOperator::LIKE));
		$sortByField=$employeeEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>