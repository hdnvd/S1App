<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 2/17/2018
 * Time: 9:45 AM
 */

namespace Modules\sfman\Classes\Field;


use Modules\sfman\Controllers\FieldType;

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
    public static function getModuleNameFromFIDFieldName($Field,$DefaultModuleName)
    {
        if(strlen($Field)>=8 && substr($Field,strlen($Field)-8,8)=="user_fid")
            return "";
        $Field=FieldCode::getFieldNameWithoutPostFix($Field);
        $Pos=strpos($Field,"__");
        if($Pos!==false)
            $Field=substr($Field,$Pos+2);
        $Pos=strpos($Field,"_");
        if($Pos!==false)
        {
            $Field=substr($Field,0,$Pos);
        }
        else
            $Field=$DefaultModuleName;
        return $Field;
    }
    public static function getFieldNameWithoutPostFix($FieldName)
    {
        $PureField=$FieldName;
        if (FieldType::getFieldType($FieldName) == FieldType::$FID)
        {
            if(substr($FieldName,strlen($FieldName)-3)=="_id")
                $PureField = substr($FieldName, 0, strlen($FieldName) - 3);
            else
                $PureField = substr($FieldName, 0, strlen($FieldName) - 4);
        }
        return $PureField;
    }

    public static function getTableNameFromFIDFieldName($Field)
    {
        if(strlen($Field)>=8 && substr($Field,strlen($Field)-8,8)=="user_fid")
            return "User";
        $Field=FieldCode::getFieldNameWithoutPostFix($Field);
        $Pos=strpos($Field,"__");
        if($Pos!==false)
        {
            $Field=substr($Field,$Pos+2);
        }
        $Pos=strpos($Field,"_");
        if($Pos!==false)
        {
            $Field=substr($Field,$Pos+1);
        }
        return $Field;
    }
    public static function getFieldNameWithoutPreFix($FieldName)
    {
        $PureField=$FieldName;
        if (FieldType::getFieldType($FieldName) == FieldType::$BOOLEAN)
        {
            if(substr($FieldName,0,3)=="isـ")
                $PureField = substr($FieldName, 3);
            elseif(substr($FieldName,0,4)=="can_")
                $PureField = substr($FieldName, 4);
            if(substr($FieldName,0,2)=="is")
                $PureField = substr($FieldName, 2);
        }
        return $PureField;
    }

    public static function getPureFieldName($FieldName)
    {
        $PureField=FieldCode::getFieldNameWithoutPostFix($FieldName);
        $PureField=FieldCode::getFieldNameWithoutPreFix($PureField);
        $PureField=str_replace("_","",$PureField);
        return $PureField;
    }

    public static function getTableFieldPart($theFieldName, $offset)
    {
        $theFieldNameParts = explode('_', $theFieldName);
        $allCount = count($theFieldNameParts);
        $place=($allCount + $offset);
        if($place<0)
            $place=-$place;
        $place = $place % $allCount;
        $theFieldPart = $theFieldNameParts[$place];
        return $theFieldPart;
    }
}