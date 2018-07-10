<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\common\Entity\common_cityEntity;
use Modules\iribfinance\Entity\iribfinance_bankEntity;
use Modules\iribfinance\Entity\iribfinance_employmenttypeEntity;
use Modules\iribfinance\Entity\iribfinance_nationalityEntity;
use Modules\iribfinance\Entity\iribfinance_paycenterEntity;
use Modules\iribfinance\Entity\iribfinance_roleEntity;
use Modules\iribfinance\Entity\iribfinance_visatypeEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_employeeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
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
		$roleEntityObject=new iribfinance_roleEntity($DBAccessor);
		$result['role_fid']=$roleEntityObject->FindAll(new QueryLogic());
		$nationalityEntityObject=new iribfinance_nationalityEntity($DBAccessor);
		$result['nationality_fid']=$nationalityEntityObject->FindAll(new QueryLogic());
		$paycenterEntityObject=new iribfinance_paycenterEntity($DBAccessor);
		$result['paycenter_fid']=$paycenterEntityObject->FindAll(new QueryLogic());
		$employmenttypeEntityObject=new iribfinance_employmenttypeEntity($DBAccessor);
		$result['employmenttype_fid']=$employmenttypeEntityObject->FindAll(new QueryLogic());
		$common_cityEntityObject=new common_cityEntity($DBAccessor);
		$result['common_city_fid']=$common_cityEntityObject->FindAll(new QueryLogic());
		$bankEntityObject=new iribfinance_bankEntity($DBAccessor);
		$result['bank_fid']=$bankEntityObject->FindAll(new QueryLogic());
		$visatypeEntityObject=new iribfinance_visatypeEntity($DBAccessor);
		$result['visatype_fid']=$visatypeEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(iribfinance_employeeEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$employeeEnt=new iribfinance_employeeEntity($DBAccessor);
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
		$employeeEnt=new iribfinance_employeeEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$name,$family,$fathername,$ismale,$mellicode,$shsh,$shshserial,$personelcode,$employmentcode,$role_fid,$nationality_fid,$paycenter_fid,$employmenttype_fid,$born_date_from,$born_date_to,$childcount,$ismarried,$mobile,$tel,$address,$zipcode,$common_city_fid,$accountnumber,$cardnumber,$bank_fid,$is_neededinsurance,$is_payabale,$passportnumber,$passportserial,$education,$entrance_date_from,$entrance_date_to,$visatype_fid,$visaexpire_date_from,$visaexpire_date_to,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$employeeEnt=new iribfinance_employeeEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("name","%$name%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("family","%$family%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("fathername","%$fathername%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("ismale","%$ismale%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("mellicode","%$mellicode%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("shsh","%$shsh%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("shshserial","%$shshserial%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("personelcode","%$personelcode%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("employmentcode","%$employmentcode%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("role_fid","%$role_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("nationality_fid","%$nationality_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("paycenter_fid","%$paycenter_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("employmenttype_fid","%$employmenttype_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("born_date",$born_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("born_date",$born_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("childcount","%$childcount%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("ismarried","%$ismarried%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("mobile","%$mobile%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("tel","%$tel%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("address","%$address%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("zipcode","%$zipcode%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("common_city_fid","%$common_city_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("accountnumber","%$accountnumber%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("cardnumber","%$cardnumber%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("bank_fid","%$bank_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("is_neededinsurance","%$is_neededinsurance%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("is_payabale","%$is_payabale%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("passportnumber","%$passportnumber%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("passportserial","%$passportserial%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("education","%$education%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("entrance_date",$entrance_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("entrance_date",$entrance_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("visatype_fid","%$visatype_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("visaexpire_date",$visaexpire_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("visaexpire_date",$visaexpire_date_to,LogicalOperator::Smaller));
		$sortByField=$employeeEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>