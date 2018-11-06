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
        if (strpos($Context,"استکبار") !== false)
            $JunkWordCount++;
        if (strpos($Context,"شعار") !== false)
            $JunkWordCount++;
        if (strpos($Context,"انزجار") !== false)
            $JunkWordCount++;
        if (strpos($Context,"فلسطین") !== false)
            $JunkWordCount++;
        if (strpos($Context,"لبنان") !== false)
            $JunkWordCount++;
        if (strpos($Context,"عراق") !== false)
            $JunkWordCount++;
        if (strpos($Context,"امام جمعه") !== false)
            $JunkWordCount++;
        if (strpos($Context,"اولویت") !== false)
            $JunkWordCount++;
        if (strpos($Context,"روستا") !== false)
            $JunkWordCount += 0.5;
        if (strpos($Context,"عراق") !== false)
            $JunkWordCount++;
        if (strpos($Context,"آمریکا") !== false)
            $JunkWordCount++;
        if (strpos($Context,"انزوا") !== false)
            $JunkWordCount++;
        if (strpos($Context,"ولایت") !== false)
            $JunkWordCount++;
        if (strpos($Context,"عزت") !== false)
            $JunkWordCount++;
        if (strpos($Context,"نظام اسلامی") !== false)
            $JunkWordCount++;
        if (strpos($Context,"جمهوری اسلامی") !== false)
            $JunkWordCount++;
        if (strpos($Context,"صلابت") !== false)
            $JunkWordCount++;
        if (strpos($Context,"توتئه") !== false)
            $JunkWordCount++;
        if (strpos($Context,"انقلاب") !== false)
            $JunkWordCount++;
        if (strpos($Context,"ماندگار") !== false)
            $JunkWordCount++;
        if (strpos($Context,"صرفه جویی") !== false)
            $JunkWordCount++;
        if (strpos($Context,"جهادی") !== false)
            $JunkWordCount++;
        if (strpos($Context,"مردم سالاری دینی") !== false)
            $JunkWordCount++;
        echo $Context . " Has $JunkWordCount Junkwords when getJunkWordCount";

        return $JunkWordCount;
    }

    public function getIsTitleForMaragheh($Context)
    {
        $Context = trim($Context);
        $JunkWordCount = 0;
        if (strpos($Context,"مراغه") !== false)
            return true;
        if (strpos($Context,"قره ‌آغاج") !== false)
            $JunkWordCount++;
        if (strpos($Context,"چاراویماق") !== false)
            $JunkWordCount++;
        if (strpos($Context,"هشترود") !== false)
            $JunkWordCount++;
        if (strpos($Context,"عجب شیر") !== false)
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