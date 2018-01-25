<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\iribfinance\Entity\iribfinance_employeeEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_prosperityfundEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 19:04
*@lastUpdate 1396-11-05 - 2018-01-25 19:04
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class prosperityfundlistController extends Controller {
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
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(iribfinance_prosperityfundEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$prosperityfundEnt=new iribfinance_prosperityfundEntity($DBAccessor);
		$result['prosperityfund']=$prosperityfundEnt;
		$allcount=$prosperityfundEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$prosperityfundEnt->FindAll($QueryLogic);
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
		$prosperityfundEnt=new iribfinance_prosperityfundEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$employee_fid,$totalamount,$add_date_from,$add_date_to,$monthcount,$amountpermonth,$isactive,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$prosperityfundEnt=new iribfinance_prosperityfundEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("employee_fid","%$employee_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("totalamount","%$totalamount%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("add_date",$add_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("add_date",$add_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("monthcount","%$monthcount%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("amountpermonth","%$amountpermonth%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("isactive","%$isactive%",LogicalOperator::LIKE));
		$sortByField=$prosperityfundEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>