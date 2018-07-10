<?php

namespace Modules\ocms\Controllers;

use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\common\Entity\common_cityEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\ocms\Entity\ocms_specialityEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_doctorEntity;
use Modules\users\PublicClasses\User;

/**
 * @author Hadi AmirNahavandi
 * @creationDate 1396-09-23 - 2017-12-14 01:18
 * @lastUpdate 1396-09-23 - 2017-12-14 01:18
 * @SweetFrameworkHelperVersion 2.004
 * @SweetFrameworkVersion 2.004
 */
class AppUserManager extends Controller
{

    public static function getUserID($UserName,$Password)
    {

        $su=new sessionuser();
        if($UserName!='' && $UserName!=-1)
            $role_systemuser_fid=User::getSystemUserIDFromUserPass($UserName,$Password);
        else
            $role_systemuser_fid=$su->getSystemUserID();
        return $role_systemuser_fid;
    }
}

?>