<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 2/17/2018
 * Time: 9:45 AM
 */

namespace Modules\sfman\Controllers;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\QueryLogic;
use Modules\sfman\Entity\sfman_translationEntity;
use Stichoza\GoogleTranslate\GoogleTranslate;


class Translator
{
    private $db;

    public function __construct()
    {
        $this->db=new dbaccess();
    }
    public function __destruct()
    {
        $this->db->close_connection();
    }

    private function loadTranslationFromDB($Word)
    {
        $Word=trim($Word);
        $Word=strtolower($Word);
//        echo "FINDING";
        $translationEnt=new sfman_translationEntity($this->db);
        $ql=new QueryLogic();
        $ql->addCondition(new FieldCondition(sfman_translationEntity::$ENGLISH,$Word));
        $result=$translationEnt->FindOne($ql);
//        var_dump($result);
//        die();
        if($result==null)
            return null;
        else
            return $result->getPersian();
    }
    private function loadTranslationFromGoogleTranslate($Word)
    {
        $Word=trim($Word);
        $Word=strtolower($Word);
        try {
            $translate = new GoogleTranslate();
            $translate->setSource(); // Translate from English
            $translate->setTarget('fa'); // Translate to Georgian
            $NormalWordForTranslate=str_replace("_"," ",$Word);
            $NormalWordForTranslate=str_replace("type"," type",$NormalWordForTranslate);
            $NormalWordForTranslate=str_replace("name"," name",$NormalWordForTranslate);
            $NormalWordForTranslate=str_replace("mother","mother ",$NormalWordForTranslate);
            $NormalWordForTranslate=str_replace("max","maximum ",$NormalWordForTranslate);
            $NormalWordForTranslate=str_replace("min","minimum ",$NormalWordForTranslate);
            $NormalWordForTranslate=str_replace("price"," price",$NormalWordForTranslate);
            $NormalWordForTranslate=trim($NormalWordForTranslate);
            $translation=$translate->translate($NormalWordForTranslate);
            return $translation;
        }catch (\Exception $ex){}
    }
    private function addWordToTranslatiobDB($Word,$Translation)
    {
        $translationEnt=new sfman_translationEntity($this->db);
        $translationEnt->setEnglish($Word);
        $translationEnt->setPersian($Translation);
        $translationEnt->setIs_automatic(true);
        $translationEnt->Save();
    }
    public function getPersian($Word,$DefaultValue)
    {
        $Word=trim(strtolower($Word));
        $Result="";
        if(strlen($Word)>5)
        {
            $LastPart=substr($Word,strlen($Word)-4);
            $LastPart2=substr($Word,strlen($Word)-5);
            $LastPart3=substr($Word,strlen($Word)-3);
            $Prefix1=substr($Word,0,2);
            $Prefix2=substr($Word,0,3);
            $Prefix3=substr($Word,0,4);
            if($LastPart=="_fid" || $LastPart=="_flu" || $LastPart=="_igu")
            {
                $Word=substr($Word,0,strlen($Word)-4);
            }
            if($LastPart3=="_id")
            {
                $Word=substr($Word,0,strlen($Word)-3);
            }
            if($LastPart=="_num" || $LastPart=="_prc" || $LastPart=="_int" || $LastPart=="_flt")
            {
                $Word=substr($Word,0,strlen($Word)-4);
            }
            if($LastPart2=="_bnum")
            {
                $Word=substr($Word,0,strlen($Word)-5);
//                $Result=$Result."زمان ";
            }
            if($LastPart=="_clk")
            {
                $Word=substr($Word,0,strlen($Word)-4);
                $Result=$Result."زمان ";
            }
            if($LastPart2=="_time")
            {
                $Word=substr($Word,0,strlen($Word)-5);
                $Result=$Result."زمان ";
            }
            if($LastPart2=="_date")
            {
                $Word=substr($Word,0,strlen($Word)-5);
                $Result=$Result."تاریخ ";
            }
            if($LastPart3=="_te")
            {
                $Word=substr($Word,0,strlen($Word)-3);
            }
            if($Prefix3=="can_")
            {
                $Word=substr($Word,4);
                $Result=$Result."قابلیت ";
            }

            elseif($Prefix2=="is_")
                $Word=substr($Word,3);
            elseif($Prefix1=="is")
                $Word=substr($Word,2);
        }
        $translation=$this->loadTranslationFromDB($Word);
        if($translation!=null)
            return $Result . $translation;
        else
        {
            $translation=$this->loadTranslationFromGoogleTranslate($Word);
            if($translation!=$Word)
            {
                $this->addWordToTranslatiobDB($Word,$translation);
                return $Result . $translation;
            }
        }
        return $DefaultValue;
    }
}