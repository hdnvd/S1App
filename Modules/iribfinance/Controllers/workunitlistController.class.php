<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_workunitEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class workunitlistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(iribfinance_workunitEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$workunitEnt=new iribfinance_workunitEntity($DBAccessor);
		$result['workunit']=$workunitEnt;
		$allcount=$workunitEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$workunitEnt->FindAll($QueryLogic);
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
		$workunitEnt=new iribfinance_workunitEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$title,$minutes,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$workunitEnt=new iribfinance_workunitEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("title","%$title%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("minutes","%$minutes%",LogicalOperator::LIKE));
		$sortByField=$workunitEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>