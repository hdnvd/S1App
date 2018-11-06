<?php

namespace Modules\posts\PublicClasses;

/**
 *
 * @author nahavandi
 *
 */
class irnaMaraghehCrawler extends irnaCrawler
{
    public function __construct($MaxPosts = 10)
    {
        $ArchiveUrl = "http://www.irna.ir/eazarbaijan/fa/zone/100066/%D8%AF%D9%81%D8%AA%D8%B1_%D9%85%D8%B1%D8%A7%D8%BA%D9%87";
        $this->setMaxPosts($MaxPosts);
        parent::__construct($ArchiveUrl);
    }

    public function isJunkWord($Word)
    {
        $Word = trim($Word);
        if ($Word == "است")
            return true;
        if ($Word == "دارد")
            return true;
        if ($Word == "ندارد")
            return true;
        if ($Word == "هست")
            return true;
        if ($Word == "نیست")
            return true;
        if ($Word == "هستند")
            return true;
        if ($Word == "نیستند")
            return true;
        if ($Word == "آیند")
            return true;
        if ($Word == "کند")
            return true;
        if ($Word == "نکند")
            return true;
        if ($Word == "کنند")
            return true;
        if ($Word == "نکنند")
            return true;
        return false;
    }

    public function getJunkWordCount($Context)
    {
        $Context = trim($Context);
        $JunkWordCount = 0;
        if (strpos("استکبار", $Context) !== false)
            $JunkWordCount++;
        if (strpos("شعار", $Context) !== false)
            $JunkWordCount++;
        if (strpos("انزجار", $Context) !== false)
            $JunkWordCount++;
        if (strpos("فلسطین", $Context) !== false)
            $JunkWordCount++;
        if (strpos("لبنان", $Context) !== false)
            $JunkWordCount++;
        if (strpos("عراق", $Context) !== false)
            $JunkWordCount++;
        if (strpos("امام جمعه", $Context) !== false)
            $JunkWordCount++;
        if (strpos("اولویت", $Context) !== false)
            $JunkWordCount++;
        if (strpos("روستا", $Context) !== false)
            $JunkWordCount += 0.5;
        if (strpos("عراق", $Context) !== false)
            $JunkWordCount++;
        if (strpos("آمریکا", $Context) !== false)
            $JunkWordCount++;
        if (strpos("انزوا", $Context) !== false)
            $JunkWordCount++;
        if (strpos("ولایت", $Context) !== false)
            $JunkWordCount++;
        if (strpos("عزت", $Context) !== false)
            $JunkWordCount++;
        if (strpos("نظام اسلامی", $Context) !== false)
            $JunkWordCount++;
        if (strpos("جمهوری اسلامی", $Context) !== false)
            $JunkWordCount++;
        if (strpos("صلابت", $Context) !== false)
            $JunkWordCount++;
        if (strpos("توتئه", $Context) !== false)
            $JunkWordCount++;
        if (strpos("انقلاب", $Context) !== false)
            $JunkWordCount++;
        if (strpos("ماندگار", $Context) !== false)
            $JunkWordCount++;
        if (strpos("صرفه جویی", $Context) !== false)
            $JunkWordCount++;
        if (strpos("جهادی", $Context) !== false)
            $JunkWordCount++;
        if (strpos("مردم سالاری دینی", $Context) !== false)
            $JunkWordCount++;
        echo $Context . " Has $JunkWordCount Junkwords when getJunkWordCount";

        return $JunkWordCount;
    }

    public function getIsTitleForMaragheh($Context)
    {
        $Context = trim($Context);
        $JunkWordCount = 0;
        if (strpos("مراغه", $Context) !== false)
            return true;
        if (strpos("قره ‌آغاج", $Context) !== false)
            $JunkWordCount++;
        if (strpos("چاراویماق", $Context) !== false)
            $JunkWordCount++;
        if (strpos("هشترود", $Context) !== false)
            $JunkWordCount++;
        if (strpos("عجب شیر", $Context) !== false)
            $JunkWordCount++;
        echo $Context . " Has $JunkWordCount Junkwords when getIsTitleForMaragheh";
        if ($JunkWordCount > 0)
            return false;
        return true;
    }

    public function getPostsArray()
    {
        $Posts = parent::getPostsArray();
        try {
            for ($i =0;$i<count($Posts['titles']) ; $i++) {
                $Posts['titles'][$i] = trim($Posts['titles'][$i]);
                if ($Posts['titles'][$i] != "") {
                    $PostWords = explode(" ", $Posts['titles'][$i]);
                    $LastWord = $PostWords[count($PostWords) - 1];
                    if ($this->isJunkWord($LastWord) || $this->getJunkWordCount($Posts['titles'][$i]) >= 1 || !$this->getIsTitleForMaragheh($Posts['titles'][$i]))
                        $Posts['categoryids'][$i] = "1";
                    else
                        $Posts['categoryids'][$i] = "12";
                }
            }
        } catch (\Exception $ex) {

        }

        return $Posts;
    }
}

?>