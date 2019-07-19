<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 2/17/2018
 * Time: 9:45 AM
 */

namespace Modules\sfman\Controllers;


class FieldCode
{
    public static $ADD_POLICY_TO_TOP=1;
    public static $ADD_POLICY_TO_BOTTOM=2;
    public static $ADD_POLICY_TO_WITH_CURRENT=3;
    public static $ADD_POLICY_TO_AFTER_JOB=4;
    private $AddPolicy;

    /**
     * @return int
     */
    public function getAddPolicy()
    {
        return $this->AddPolicy;
    }

    /**
     * @param int $AddPolicy
     */
    public function setAddPolicy($AddPolicy)
    {
        $this->AddPolicy = $AddPolicy;
    }
}