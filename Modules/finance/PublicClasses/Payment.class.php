<?php
namespace Modules\finance\PublicClasses;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\QueryLogic;
use Modules\finance\Entity\finance_bankpaymentinfoEntity;
use Modules\finance\Entity\finance_transactionEntity;
use Modules\users\PublicClasses\sessionuser;

/**
 * Created by PhpStorm.
 * User: Will
 * Date: 9/4/2017
 * Time: 6:40 PM
 */
class Payment
{
    public function getBalance($ChapterID)
    {
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $Tent=new finance_transactionEntity($DBAccessor);
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition(finance_transactionEntity::$ROLE_SYSTEMUSER_FID,$role_systemuser_fid));
        $q->addCondition(new FieldCondition(finance_transactionEntity::$CHAPTER_FID,$ChapterID));
        $q->addCondition(new FieldCondition(finance_transactionEntity::$ISSUCCESSFUL,1));
        $q->setResultField(['0 as id','sum(amount) balance']);
        $res=$Tent->FindOne($q);
        $DBAccessor->close_connection();
        if($res->getBalance()=="")
            return 0;
        return $res->getBalance();
    }
    public function startTransaction($amount,$name,$family,$phonenumber,$portal_fid,$description,$ChapterID,$PayByPortal,$RedirectURL)
    {
        $DBAccessor=new dbaccess();
        $DBAccessor2=new dbaccess();
        $DBAccessor->beginTransaction();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $Pent2=new finance_bankpaymentinfoEntity($DBAccessor2);
        $lastID=$Pent2->FindAllCount(new QueryLogic());


        $Tent=new finance_transactionEntity($DBAccessor);
        $Tent->setAmount($amount);
        $Tent->setRole_systemuser_fid($role_systemuser_fid);
        $Tent->setAdd_time(time());
        $Tent->setIssuccessful("0");
        $Tent->setCommit_time(-1);
        $Tent->setChapter_fid($ChapterID);
        $Tent->setDescription($description);
        $Tent->Save();

        if($PayByPortal)
        {
            $Pent=new finance_bankpaymentinfoEntity($DBAccessor);
            $Pent->setName($name);
            $Pent->setFamily($family);
            $Pent->setPhonenumber($phonenumber);
            $Pent->setStatus_fid(-1);
            $Pent->setPortal_fid($portal_fid);
            $Pent->setTransaction_fid($Tent->getId());
            $Pent->setInternalRedirectURL($RedirectURL);
            $Pent->setBanktransactionid(-1);
            $serial="silhv&^%&*fcxasw" . $lastID ."t" .  time();
            $serial=md5($serial);
            $Pent->setFactorserial($serial);
            $Pent->Save();
        }
        else
        {

            $Tent->setCommit_time(time());
            $Tent->setIssuccessful(1);
            $Tent->Save();
        }

        $DBAccessor->commit();
        $DBAccessor->close_connection();
        $DBAccessor2->close_connection();
        $result['transaction']['id']=$Pent->getId();
        return $result;
    }

}