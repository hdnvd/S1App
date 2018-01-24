<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\finance\Exceptions\LowBalanceException;
use Modules\finance\PublicClasses\Payment;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\ocms\Entity\ocms_doctorEntity;
use Modules\ocms\Entity\ocms_doctorreserveEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_doctorplanEntity;
use Modules\users\PublicClasses\User;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class doctorplanlistController extends Controller {
	private $PAGESIZE=100;
	public function getData($PageNum,QueryLogic $QueryLogic,$username,$password)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$user=new User(-1);
		$role_systemuser_fid=$user->getSystemUserIDFromUserPass($username,$password);
		$result=array();
		$doctorEntityObject=new ocms_doctorEntity($DBAccessor);
		$result['doctor_fid']=$doctorEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;

        $q=new QueryLogic();
        $q->addCondition(new FieldCondition(ocms_doctorEntity::$ROLE_SYSTEMUSER_FID,$role_systemuser_fid));
        $doctorEntityObject=$doctorEntityObject->FindOne($q);
        $QueryLogic->addCondition(new FieldCondition(ocms_doctorplanEntity::$DOCTOR_FID,$doctorEntityObject->getId()));
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
	public function load($PageNum,$username,$password)
	{
		$DBAccessor=new dbaccess();
		$doctorplanEnt=new ocms_doctorplanEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q,$username,$password);
	}
	public function getDayPlans($DoctorID,$Year,$Month,$Day)
    {
        $DBAccessor=new dbaccess();
        $ent=new ocms_doctorplanEntity($DBAccessor);
        date_default_timezone_set("Asia/Tehran");
        $sweetDate = new SweetDate(true, true, 'Asia/Tehran');
        $start_time = $sweetDate->mktime("0", "0","0", $Month, $Day, $Year);
        $start_time--;
        $end_time = $sweetDate->mktime("23", "59","59", $Month, $Day, $Year);

        $Plans=$ent->getDoctorFreePlans($DoctorID,$start_time,$end_time);

        $result['data']=$Plans;
        return $result;
    }
    public function reserve($DoctorPlanID,$UserName,$Password,$PresenceTypeID)
    {
        $DBAccessor=new dbaccess();
        $ent=new ocms_doctorplanEntity($DBAccessor);
        $ent->setId($DoctorPlanID);
        if($ent->getId()<=0)
            throw new DataNotFoundException();
        $DrEnt=new ocms_doctorEntity($DBAccessor);
        $DrEnt->setId($ent->getDoctor_fid());
        if($DrEnt->getId()<=0)
            throw new DataNotFoundException();
        $Payment=new Payment();

        $user=new User(-1);
        $SystemUserID=$user->getSystemUserIDFromUserPass($UserName,$Password);
        $UserBalance=$Payment->getBalance(1,$SystemUserID);
//        echo $UserBalance;
        if($UserBalance<$DrEnt->getPrice())
            throw new LowBalanceException();

        //Deduction from customer account
        $result=$Payment->startTransaction(-1*$DrEnt->getPrice(),$SystemUserID,'','','','رزرو وقت',1,false,'',$SystemUserID);
        $resEnt=new ocms_doctorreserveEntity($DBAccessor);
        $resEnt->setReserve_date(time());
        $resEnt->setDoctorplan_fid($DoctorPlanID);
        $resEnt->setPresencetype_fid($PresenceTypeID);
        $resEnt->setRole_systemuser_fid($SystemUserID);
        $resEnt->setFinancial_transaction_fid($result['transaction']['id']);
        $resEnt->Save();
        $doctorSystemUserID=$DrEnt->getRole_systemuser_fid();

        //Add to Doctor Account
        $result=$Payment->startTransaction($DrEnt->getPrice(),$doctorSystemUserID,'','','','رزرو وقت توسط کاربر شماره '. $SystemUserID,1,false,'',$doctorSystemUserID);

        return [];


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