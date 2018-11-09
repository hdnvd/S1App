<?php

namespace Modules\posts\PublicClasses;

/**
 *
 * @author nahavandi
 *        
 */
class Crawler {

    private $maxTitleLength=110;
    private $maxSummaryLength=300;
	public function getPostsArray()
	{
		return null;
	}
    protected function getIsTitleForMaragheh($Context)
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
//        echo $Context . " Has $JunkWordCount Junkwords when getIsTitleForMaragheh";
        if ($JunkWordCount > 0)
            return false;
        return true;
    }
    protected function isJunkWord($Word)
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


    protected function getJunkWordCount($Context)
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
        if (strpos($Context,"منجر می شود") !== false)
            $JunkWordCount++;
        if (strpos($Context,"رهبری") !== false)
            $JunkWordCount++;
        if (strpos($Context,"شئونات") !== false)
            $JunkWordCount++;
        if (strpos($Context,"آیت الله") !== false)
            $JunkWordCount++;
        if (strpos($Context,"حجاب") !== false)
            $JunkWordCount++;
        if (strpos($Context,"عفاف") !== false)
            $JunkWordCount++;
        if (strpos($Context,"راهپیمایی") !== false)
            $JunkWordCount++;
        if (strpos($Context,"انقلاب") !== false)
            $JunkWordCount++;
//        echo $Context . " Has $JunkWordCount Junkwords when getJunkWordCount";

        return $JunkWordCount;
    }
	protected function getConciseTitle($Title)
    {
        $Title=trim($Title);
        if(strlen($Title)>=$this->maxTitleLength)
        {
            $spaceaftermax=strpos($Title," ",$this->maxTitleLength);
            $Title=substr($Title,0,$spaceaftermax) . "...";
        }
        return $Title;
    }
    protected function getXMLFromURL($RSSURL)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $RSSURL);

        $data = curl_exec($ch); // execute curl request
//        echo $data;
        curl_close($ch);
        return $data;
    }
}

?>