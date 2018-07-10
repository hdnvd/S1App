<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\iribfinance\Entity\iribfinance_programestimationemployeeEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_paymentlicenceEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class paymentlicencelistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$programestimationemployeeEntityObject=new iribfinance_programestimationemployeeEntity($DBAccessor);
		$result['programestimationemployee_fid']=$programestimationemployeeEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(iribfinance_paymentlicenceEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$paymentlicenceEnt=new iribfinance_paymentlicenceEntity($DBAccessor);
		$result['paymentlicence']=$paymentlicenceEnt;
		$allcount=$paymentlicenceEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$paymentlicenceEnt->FindAll($QueryLogic);
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
		$paymentlicenceEnt=new iribfinance_paymentlicenceEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$programestimationemployee_fid,$month,$pay_date_from,$pay_date_to,$work,$decrementtime,$workfactor,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$paymentlicenceEnt=new iribfinance_paymentlicenceEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("programestimationemployee_fid","%$programestimationemployee_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("month","%$month%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("pay_date",$pay_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("pay_date",$pay_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("work","%$work%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("decrementtime","%$decrementtime%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("workfactor","%$workfactor%",LogicalOperator::LIKE));
		$sortByField=$paymentlicenceEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>