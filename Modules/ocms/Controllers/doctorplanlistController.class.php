<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\ocms\Entity\ocms_doctorEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_doctorplanEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class doctorplanlistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$doctorEntityObject=new ocms_doctorEntity($DBAccessor);
		$result['doctor_fid']=$doctorEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(ocms_doctorplanEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$doctorplanEnt=new ocms_doctorplanEntity($DBAccessor);
		$result['doctorplan']=$doctorplanEnt;
		$allcount=$doctorplanEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$doctorplanEnt->FindAll($QueryLogic);
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
		$doctorplanEnt=new ocms_doctorplanEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$start_time_from,$start_time_to,$end_time_from,$end_time_to,$doctor_fid,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$doctorplanEnt=new ocms_doctorplanEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("start_time",$start_time_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("start_time",$start_time_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("end_time",$end_time_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("end_time",$end_time_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("doctor_fid","%$doctor_fid%",LogicalOperator::LIKE));
		$sortByField=$doctorplanEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>