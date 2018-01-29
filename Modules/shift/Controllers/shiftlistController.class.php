<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\shift\Entity\shift_bakhshEntity;
use Modules\shift\Entity\shift_eshteghalEntity;
use Modules\shift\Entity\shift_inputfileEntity;
use Modules\shift\Entity\shift_personelEntity;
use Modules\shift\Entity\shift_roleEntity;
use Modules\shift\Entity\shift_shifttypeEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_shiftEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 00:33
*@lastUpdate 1396-11-05 - 2018-01-25 00:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class shiftlistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic,$daycount=14,$startdate=null)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$shifttypeEntityObject=new shift_shifttypeEntity($DBAccessor);
		$result['shifttype_fid']=$shifttypeEntityObject->FindAll(new QueryLogic());
		$personelEntityObject=new shift_personelEntity($DBAccessor);
		$result['personel_fid']=$personelEntityObject->FindAll(new QueryLogic());
		$bakhshEntityObject=new shift_bakhshEntity($DBAccessor);
		$result['bakhsh_fid']=$bakhshEntityObject->FindAll(new QueryLogic());
		$roleEntityObject=new shift_roleEntity($DBAccessor);
		$result['role_fid']=$roleEntityObject->FindAll(new QueryLogic());
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
        $AllCount1 = count($result['data']);
        for ($i = 0; $i < $AllCount1; $i++) {
            $item=$result['data'][$i];
            $em=new shift_personelEntity($DBAccessor);
            $em->setId($item->getPersonel_fid());
            $result['personel'][$i]=$em;
            $role=new shift_roleEntity($DBAccessor);
            $role->setId($em->getRole_fid());
            $result['role'][$i]=$role;
            $Esh=new shift_eshteghalEntity($DBAccessor);
            $Esh->setId($em->getEshteghal_fid());
            $result['eshteghaltype'][$i]=$Esh;
        }
        $result['daycount']=$daycount;
        $result['starttime']=$startdate;
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
	public function Search($PageNum,$shifttype_fid,$due_date_from,$due_date_to,$register_date_from,$register_date_to,$personel_fid,$bakhsh_fid,$role_fid,$inputfile_fid,$sortby,$isdesc)
	{
	    $daycount=($due_date_to-$due_date_from)/86400;
        $starttime=$due_date_from;
		$DBAccessor=new dbaccess();
		$shiftEnt=new shift_shiftEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("shifttype_fid","%$shifttype_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("due_date",$due_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("due_date",$due_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("register_date",$register_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("register_date",$register_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("personel_fid","%$personel_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("bakhsh_fid","%$bakhsh_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("role_fid","%$role_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("inputfile_fid","%$inputfile_fid%",LogicalOperator::LIKE));
		$sortByField=$shiftEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q,$daycount,$starttime);
	}
}
?>