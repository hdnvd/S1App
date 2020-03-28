<?php

namespace Modules\posts\PublicClasses;

/**
 *
 * @author nahavandi
 *
 */
class irnaMaraghehCrawler extends irnaRssCrawler
{
    public function __construct($MaxPosts = 10)
    {
        $ArchiveUrl = "https://www.irna.ir/rss?kw=%D9%85%D8%B1%D8%A7%D8%BA%D9%87";
        $this->setMaxPosts($MaxPosts);
        parent::__construct($ArchiveUrl);
    }




    public function getPostsArray()
    {
        $Posts = parent::getPostsArray();
        try {
            for ($i =0;$i<count($Posts['titles']) ; $i++) {
                $Posts['contents'][$i]=str_replace("شهرستان مراغه با حدود ۲۶۸ هزار نفر جمعیت در ۱۲۷ کیلومتری تبریز، مرکز آذربایجان شرقی قرار دارد","",$Posts['contents'][$i]);
                $Posts['titles'][$i] = trim($Posts['titles'][$i]);
                if ($Posts['titles'][$i] != "" && strlen($this->getConciseTitle($Posts['titles'][$i]))>3)
                {
                    $PostWords = explode(" ", $Posts['titles'][$i]);
                    $LastWord = $PostWords[count($PostWords) - 1];
                    if ($this->isJunkWord($LastWord) || $this->getJunkWordCount($Posts['titles'][$i]) >= 1 || !$this->getIsTitleForMaragheh($Posts['titles'][$i]))
                        $Posts['categoryids'][$i] = ["1"];
                    else
                        $Posts['categoryids'][$i] = ["1","12"];
                    $Posts['fulltitles'][$i]=$Posts['titles'][$i];
                    $Posts['titles'][$i]=$this->getConciseTitle($Posts['titles'][$i]);
                }
            }
        } catch (\Exception $ex) {

        }
        return $Posts;
    }
}

?>