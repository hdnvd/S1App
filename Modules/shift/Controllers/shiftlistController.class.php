<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\shift\Entity\shift_inputfileEntity;
use Modules\shift\Entity\shift_personelEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_shiftEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-28 - 2018-01-18 18:55
*@lastUpdate 1396-10-28 - 2018-01-18 18:55
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class shiftlistController extends Controller {
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
		$inputfileEntityObject=new shift_inputfileEntity($DBAccessor);
		$result['inputfile_fid']=$inputfileEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(shift_shiftEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$shiftEnt=new shift_shiftEntity($DBAccessor);
		$result['shift']=$shiftEnt;
		$allcount=$shiftEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$shiftEnt->FindAll($QueryLogic);
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
		$shiftEnt=new shift_shiftEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$shifttype,$due_date_from,$due_date_to,$register_date_from,$register_date_to,$personel_fid,$inputfile_fid,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$shiftEnt=new shift_shiftEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("shifttype","%$shifttype%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("due_date",$due_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("due_date",$due_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("register_date",$register_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("register_date",$register_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("personel_fid","%$personel_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("inputfile_fid","%$inputfile_fid%",LogicalOperator::LIKE));
		$sortByField=$shiftEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>