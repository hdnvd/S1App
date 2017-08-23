<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 8/23/2017
 * Time: 2:18 AM
 */

namespace Modules\buysell\PublicClasses;


class CarGroups
{
    private $groups=[1=>'personalcars',2=>'heavyvehicles'];
    private $PersianGroups=[1=>'خودروهای شخصی',2=>'ماشین های سنگین'];
    public function getGroupName($id)
    {
        return $this->groups[$id];
    }
    public function getPersianGroupName($id)
    {
        return $this->PersianGroups[$id];
    }
}