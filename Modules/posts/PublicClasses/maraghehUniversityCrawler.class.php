<?php

namespace Modules\posts\PublicClasses;

use core\CoreClasses\SweetDate;
/**
 *
 * @author nahavandi
 *
 */
class maraghehUniversityCrawler extends Crawler{
    private $ArchiveUrl;
    private $MaxPosts=5;
    private $SearchText;
    public function __construct()
    {
    }
    public function getPostsArray()
    {

        $RSSURL="https://www.maragheh.ac.ir/RssTopNews/CMS/TopNews.aspx?Top=".$this->MaxPosts."&sort=DESC&BasesID=1&Type=1&StateID=0&sortFiled=created";
        $ContentLogic=".opinion-div-fulltext-news";
        $RootURL="https://www.maragheh.ac.ir";

        $titles=array();
        $fulltitles=array();
        $links=array();
        $summary=array();
        $contents=array();
        $dposter=new \data_poster();
        $dom=new \simple_html_dom();


        //***********Title***********//

        $data=$this->getXMLFromURL($RSSURL);
        $xml = simplexml_load_string($data);
        $items=$xml->channel->item;
        $ItemCount=count($items);
        for($i=0;$i<$ItemCount && $i<$this->MaxPosts;$i++)
        {
            $fulltitles[$i]=$items[$i]->title . "";
            $links[$i]=$items[$i]->link . "";
            $summary[$i]=$items[$i]->description . "";
        }

        $postsCount=$i;
        //***********Title***********//
        $contents=[];
        $categoryids=[];
        $Images=[];
        for($i=0;$i<$postsCount;$i++)
        {
            $response=sweet_file_get_html($links[$i]);
            $html=str_get_html($response);
            $element=$html->find($ContentLogic,0);
            $contents[$i]=$element->innertext;

            $SmallTitle[$i]=$html->find("#ctl01_lblhead",0);
            $titles2[$i]=$SmallTitle[$i]->plaintext . "";
            if(strlen($titles2[$i])>5)
                $fulltitles[$i]=$titles2[$i];
            $contents[$i]=str_replace("src=\"","src=\"".$RootURL,$contents[$i]);
            $contents[$i]=str_replace("src='","src='".$RootURL,$contents[$i]);
            $ThumbIMG[$i]=$html->find("#ctl01_imgSubject",0);
            $Images[$i]="";
            try
            {
                $Images[$i]=$RootURL."/".$ThumbIMG[$i]->src;
                if(trim($Images[$i])!="")
                    $contents[$i]="<div class='posttitleimg'><img src='".$Images[$i]."' alt='".$fulltitles[$i]."'/></div>\r\n".$contents[$i] ;
            }
            catch (\Exception $ex)
            {

            }
            if (trim([$i]) != "") {
                if ($this->getJunkWordCount($fulltitles[$i]) >= 1)
                    $categoryids[$i] = ["1"];
                else
                    $categoryids[$i] = ["1","12"];
            }

            $titles[$i]=$this->getConciseTitle($fulltitles[$i]);
//            $Images[$i]=$this->getAnImageURL($contents[$i]);
        }

        $result=array("titles"=>$titles,"fulltitles"=>$fulltitles,"contents"=>$contents,"summary"=>$summary,"links"=>$links,"description"=>$summary,'categoryids'=>$categoryids,"thumbnails"=>$Images);
//		print_r($result);
//		die();
        return $result;

    }

    protected function getMaxPosts()
    {
        return $this->MaxPosts;
    }

    protected function setMaxPosts($MaxPosts)
    {
        $this->MaxPosts = $MaxPosts;
    }

    public function getSearchText()
    {
        return $this->SearchText;
    }

    public function setSearchText($SearchText)
    {
        $this->SearchText = $SearchText;
    }
}

?>