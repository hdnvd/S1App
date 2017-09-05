<?php
namespace Modules\finance\PublicClasses;
use core\CoreClasses\db\dbaccess;
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
    public function startTransaction($amount,$name,$family,$phonenumber,$portal_fid,$description)
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
        $Tent->setDescription($description);
        $Tent->Save();

        $Pent=new finance_bankpaymentinfoEntity($DBAccessor);
        $Pent->setName($name);
        $Pent->setFamily($family);
        $Pent->setPhonenumber($phonenumber);
        $Pent->setStatus_fid(-1);
        $Pent->setPortal_fid($portal_fid);
        $Pent->setTransaction_fid($Tent->getId());
        $Pent->setBanktransactionid(-1);
        $serial="silhv&^%&*fcxasw" . $lastID ."t" .  time();
        $serial=md5($serial);
        $Pent->setFactorserial($serial);
        $Pent->Save();

        $DBAccessor->commit();
        $DBAccessor->close_connection();
        $DBAccessor2->close_connection();
    }

}