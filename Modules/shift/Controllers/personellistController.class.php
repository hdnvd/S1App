<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\shift\Entity\shift_bakhshEntity;
use Modules\shift\Entity\shift_eshteghalEntity;
use Modules\shift\Entity\shift_madrakEntity;
use Modules\shift\Entity\shift_roleEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_personelEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-28 - 2018-01-18 17:32
*@lastUpdate 1396-10-28 - 2018-01-18 17:32
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class personellistController extends Controller {
	private $PAGESIZE=40;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$bakhshEntityObject=new shift_bakhshEntity($DBAccessor);
		$result['bakhsh_fid']=$bakhshEntityObject->FindAll(new QueryLogic());
		$madrakEntityObject=new shift_madrakEntity($DBAccessor);
		$result['madrak_fid']=$madrakEntityObject->FindAll(new QueryLogic());
		$eshteghalEntityObject=new shift_eshteghalEntity($DBAccessor);
		$result['eshteghal_fid']=$eshteghalEntityObject->FindAll(new QueryLogic());
		$roleEntityObject=new shift_roleEntity($DBAccessor);
		$result['role_fid']=$roleEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(shift_personelEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$personelEnt=new shift_personelEntity($DBAccessor);
		$result['personel']=$personelEnt;
		$allcount=$personelEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$personelEnt->FindAll($QueryLogic);
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
		$personelEnt=new shift_personelEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$childcount,$address,$fathername,$priority,$employment_date_from,$employment_date_to,$personelcode,$sanavat,$shhesab,$bakhsh_fid,$madrak_fid,$name,$family,$tel,$born_date_from,$born_date_to,$is_male,$extrasanavat,$monthsanavat,$eshteghal_fid,$zarib,$role_fid,$shsh,$computercode,$mellicode,$is_married,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$personelEnt=new shift_personelEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("childcount","%$childcount%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("address","%$address%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("fathername","%$fathername%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("priority","%$priority%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("employment_date",$employment_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("employment_date",$employment_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("personelcode","%$personelcode%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("sanavat","%$sanavat%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("shhesab","%$shhesab%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("bakhsh_fid","%$bakhsh_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("madrak_fid","%$madrak_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("name","%$name%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("family","%$family%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("tel","%$tel%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("born_date",$born_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("born_date",$born_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("is_male","%$is_male%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("extrasanavat","%$extrasanavat%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("monthsanavat","%$monthsanavat%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("eshteghal_fid","%$eshteghal_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("zarib","%$zarib%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("role_fid","%$role_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("shsh","%$shsh%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("computercode","%$computercode%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("mellicode","%$mellicode%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("is_married","%$is_married%",LogicalOperator::LIKE));
		$sortByField=$personelEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>