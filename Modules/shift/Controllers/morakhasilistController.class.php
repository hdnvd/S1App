<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\shift\Entity\shift_personelEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_morakhasiEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-26 - 2018-01-16 20:22
*@lastUpdate 1396-10-26 - 2018-01-16 20:22
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class morakhasilistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$personelEntityObject=new shift_personelEntity($DBAccessor);
		$result['personel_fid']=$personelEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(shift_morakhasiEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$morakhasiEnt=new shift_morakhasiEntity($DBAccessor);
		$result['morakhasi']=$morakhasiEnt;
		$allcount=$morakhasiEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$morakhasiEnt->FindAll($QueryLogic);
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
		$morakhasiEnt=new shift_morakhasiEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$elat,$doctor,$start_time_from,$start_time_to,$end_time_from,$end_time_to,$add_time_from,$add_time_to,$morakhasi_type,$personel_fid,$mahal,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$morakhasiEnt=new shift_morakhasiEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("elat","%$elat%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("doctor","%$doctor%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("start_time",$start_time_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("start_time",$start_time_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("end_time",$end_time_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("end_time",$end_time_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("add_time",$add_time_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("add_time",$add_time_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("morakhasi_type","%$morakhasi_type%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("personel_fid","%$personel_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("mahal","%$mahal%",LogicalOperator::LIKE));
		$sortByField=$morakhasiEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>