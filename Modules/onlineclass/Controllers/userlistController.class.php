<?php
namespace Modules\onlineclass\Controllers;
use core\CoreClasses\Exception\SweetException;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\finance\Entity\finance_transactionEntity;
use Modules\finance\PublicClasses\Payment;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\onlineclass\Entity\onlineclass_courseEntity;
use Modules\onlineclass\Entity\onlineclass_tutorEntity;
use Modules\onlineclass\Entity\onlineclass_usercourseEntity;
use Modules\onlineclass\Entity\onlineclass_videoEntity;
use Modules\users\Entity\roleSystemUserEntity;
use Modules\users\Entity\RoleSystemUserRoleEntity;
use Modules\users\Entity\roleUserEntity;
use Modules\users\Entity\userEntity;
use Modules\users\Entity\users_userEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\onlineclass\Entity\onlineclass_userEntity;
use Modules\users\PublicClasses\User;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 22:27
*@lastUpdate 1396-07-25 - 2017-10-17 22:27
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class userlistController extends Controller {
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
            $QueryLogic->addCondition(new FieldCondition(users_userEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$userEnt=new users_userEntity($DBAccessor);
		$result['user']=$userEnt;
//        echo "1";
		$allcount=$userEnt->FindAllCount($QueryLogic);
//        echo "1";
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$userEnt->FindAll($QueryLogic);
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
		$userEnt=new users_userEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$fullname,$ismale,$email,$mobile,$registration_time_from,$registration_time_to,$devicecode,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
        $userEnt=new users_userEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("fullname","%$fullname%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("ismale","%$ismale%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("email","%$email%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("mobile","%$mobile%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("registration_time",$registration_time_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("registration_time",$registration_time_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("devicecode","%$devicecode%",LogicalOperator::LIKE));
		$sortByField=$userEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function getUserCourses($UserName,$Password)
    {
        $DBAccessor=new dbaccess();
        $userEnt=new users_userEntity($DBAccessor);
        $SysUserID=$this->getSysUserID($DBAccessor,$UserName,$Password);
        if($SysUserID<=0)
            throw new \Exception('usernotfound');
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition(users_userEntity::$ROLE_SYSTEMUSER_FID,$SysUserID,LogicalOperator::Equal));
        $userEnt=$userEnt->FindOne($q);

        $UserCourseEnt=new onlineclass_usercourseEntity($DBAccessor);
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition("user_fid",$userEnt->getId(),LogicalOperator::Equal));
        $UserCourses=$UserCourseEnt->FindAll($q);
        $result=array();
        $skipped=0;
        for ($i = 0; $i < count($UserCourses); $i++) {

            $payment=new Payment();
            if($payment->getTransactionStatus($UserCourses[$i]->getFinance_transaction_fid())==1)
            {
                $ind=$i-$skipped;
                $course[$ind]=new onlineclass_courseEntity($DBAccessor);
                $result['coursetutors'][$ind]=new onlineclass_tutorEntity($DBAccessor);
                $course[$ind]->setId($UserCourses[$i]->getCourse_fid());
                $result['coursetutors'][$ind]->setId($course[$ind]->getTutor_fid());
                $result['courses'][$ind]=$course[$ind];
            }
            else
            {
                $skipped++;
            }
        }

        $DBAccessor->close_connection();
        return $result;
    }

    private function getSysUserID(dbaccess $DBAccessor,$Username,$Password)
    {
        $sysu=new roleSystemUserEntity($DBAccessor);
        $res=$sysu->Select(array('username','password'),array(strtolower($Username),$Password));
        $id=-1;
        if($res!=null && count($res)>0)
            $id=$res[0]['id'];
        return $id;
    }
    private function getSysUserRole($SystemUserID)
    {
        $RoleEnt=new RoleSystemUserRoleEntity();
        $res=$RoleEnt->getUserRole($SystemUserID);
        $id=-1;
        if($res!=null && count($res)>0)
            $id=$res[0]['roleid'];
        return $id;
    }
    public function getUserNotBuyedCourses($UserName,$Password)
    {
        $DBAccessor=new dbaccess();
        $userEnt=new users_userEntity($DBAccessor);
        $SysUserID=$this->getSysUserID($DBAccessor,$UserName,$Password);
        if($SysUserID<=0)
            throw new \Exception('usernotfound');
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition(users_userEntity::$ROLE_SYSTEMUSER_FID,$SysUserID,LogicalOperator::Equal));
        $userEnt=$userEnt->FindOne($q);

        $UserCourseEnt=new onlineclass_usercourseEntity($DBAccessor);
        $CourseEnt=new onlineclass_courseEntity($DBAccessor);
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition("user_fid",$userEnt->getId(),LogicalOperator::Equal));
        $UserCourses=$UserCourseEnt->FindAll($q);
        $q2=new QueryLogic();
        $q2->addOrderBy(onlineclass_courseEntity::$START_DATE,true);
        $UserHaveNotCourses=$CourseEnt->FindAll($q2);
        $result=array();
        for ($i = 0; $i < count($UserCourses); $i++) {
            for($j=0;$j<count($UserHaveNotCourses);$j++)
            {

                if($UserHaveNotCourses[$j]!=null && $UserHaveNotCourses[$j]->getId()==$UserCourses[$i]->getCourse_fid())
                {
                    $payment=new Payment();
                    if($payment->getTransactionStatus($UserCourses[$i]->getFinance_transaction_fid())==1)
                        $UserHaveNotCourses[$j]=null;
                }
            }
        }

        $nullItems=0;
        for ($i = 0; $i < count($UserHaveNotCourses); $i++) {
            if($UserHaveNotCourses[$i]!=null){

                $result['coursetutors'][$i-$nullItems]=new onlineclass_tutorEntity($DBAccessor);
                $result['coursetutors'][$i-$nullItems]->setId($UserHaveNotCourses[$i]->getTutor_fid());
                $result['courses'][$i-$nullItems]=$UserHaveNotCourses[$i];
            }
            else
                $nullItems++;
        }

        $DBAccessor->close_connection();
        return $result;
    }
    public function getCourseVideos($UserName,$Password,$CourseID)
    {
        $DBAccessor=new dbaccess();
        $userEnt=new users_userEntity($DBAccessor);
        $SysUserID=$this->getSysUserID($DBAccessor,$UserName,$Password);
        if($SysUserID<=0)
            throw new \Exception('usernotfound');
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition(users_userEntity::$ROLE_SYSTEMUSER_FID,$SysUserID,LogicalOperator::Equal));
        $userEnt=$userEnt->FindOne($q);

        $videoEnt=new onlineclass_videoEntity($DBAccessor);
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition("course_fid",$CourseID,LogicalOperator::Equal));
        $q->addOrderBy("hold_date",false);
        $videos=$videoEnt->FindAll($q);
        $result['videos']=$videos;

        $DBAccessor->close_connection();
        return $result;
    }
    public function FindUserByUserInfoAndDevice($UserName, $Password, $Device)
    {
        $Device=trim($Device);
        $DBAccessor=new dbaccess();
        $SysUserID=$this->getSysUserID($DBAccessor,$UserName,$Password);
//        echo "1";
        if($SysUserID<=0)
            return ['status'=>404];//Not Found
        $role=$this->getSysUserRole($SysUserID);
        $q=new QueryLogic();
        $q->addOrderBy("id",true);
//        echo "1";
        $q->addCondition(new FieldCondition(users_userEntity::$ROLE_SYSTEMUSER_FID,$SysUserID,LogicalOperator::Equal));

        $dt=$this->getData(1,$q);
        if($role==5)//simple user
        {

            $dt['role']=5;
//        echo "1";
            if($dt['data']!=null && count($dt['data'])>0)
            {
                if(trim($dt['data'][0]->getAdditionalField1())==$Device)
                {
                    $dt['data']=$dt['data'][0];
                    $dt['status']=1;//Found
                    return $dt;
                }
                elseif(trim($dt['data'][0]->getDevicecode())=="")
                {
                    $dt['data'][0]->setDevicecode($Device);
                    $dt['data'][0]->Save();
                    return ['status'=>2];//Empty Device Code
                }
                else
                {
                    return ['status'=>3];//Invalid Device Code
                }
            }
        }
        else
        {
            if($dt['data']!=null && count($dt['data'])>0)
                return ['status'=>1,'role'=>$role,'data'=>$dt['data'][0]];//Found
            else
            {
                return ['status'=>1,'role'=>$role,'userid'=>$SysUserID];//Found
            }
        }

//        $DBAccessor->beginTransaction();
//        $userEnt=new onlineclass_userEntity($DBAccessor);
//        $us=new roleSystemUserEntity();
//        $sysUserID=$us->Add($Mobile,$Device);
//        $userEnt->setMobile($Mobile);
//        $userEnt->setDevicecode($Device);
//        $userEnt->setRole_systemuser_fid($sysUserID);
//        $userEnt->Save();
//        $DBAccessor->commit();
        $DBAccessor->close_connection();
        return ['status'=>404];//Not Found
    }
}
?>