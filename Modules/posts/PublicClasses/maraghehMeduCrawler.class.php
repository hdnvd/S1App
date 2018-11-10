<?php

namespace Modules\posts\PublicClasses;

use core\CoreClasses\SweetDate;
/**
 *
 * @author nahavandi
 *
 */
class maraghehMeduCrawler extends Crawler{
    private $ArchiveUrl;
    private $MaxPosts=5;
    private $SearchText;
    public function __construct()
    {
    }
    public function getPostsArray()
    {

        $ListURL="http://medu.ir/fa/news/section/1/%D8%A7%D8%AE%D8%A8%D8%A7%D8%B1%20%D9%85%D9%87%D9%85?ocode=90185701";
        $ListItemsLogic=".body-news-grid .news_grid_item a";
        $RootURL="http://medu.ir";
        $ContentLogic="#news";

        $titles=array();
        $links=array();
        $summary=array();
        $contents=array();
        $dposter=new \data_poster();
        $dom=new \simple_html_dom();


        //***********Title***********//

        $html=sweet_file_get_html($ListURL);
//        echo $html;
        $Elements=$html->find($ListItemsLogic);
        echo "count:".count($Elements);
        $maxSummaryLength=300;
        $categoryids=[];
        for($i=0;$i<count($Elements) && $i<$this->MaxPosts;$i++)
        {
            $titles[$i]=trim($Elements[$i]->plaintext);
            if (trim($titles[$i]) != "") {
                if ($this->getJunkWordCount($titles[$i]) >= 1)
                    $categoryids[$i] = ["1"];
                else
                    $categoryids[$i] = ["1","12"];
            }
            $titles[$i]=$this->getConciseTitle($titles[$i]);

            $links[$i]=html_entity_decode($Elements[$i]->href);
            echo $titles[$i] . "</br>";
        }
        $postsCount=$i;
//        die();
        //***********Title***********//
        $contents=array();
        for($i=0;$i<$postsCount;$i++)
        {
            $response=sweet_file_get_html($links[$i]);
            $html=str_get_html($response);
            $element=$html->find($ContentLogic,0);
            $contents[$i]=$element->innertext;
            $contents[$i]=str_replace("src=\"/portal","src=\"".$RootURL."/portal",$contents[$i]);
            $contents[$i]=str_replace("src='/portal","src='".$RootURL."/portal",$contents[$i]);
            $contents[$i]=str_replace("style","disabledstyle",$contents[$i]);
            $contents[$i]=str_replace("bgcolor","disabledbgcolor",$contents[$i]);
            $contents[$i]=str_replace("table","div",$contents[$i]);
            $contents[$i]=str_replace("td","div",$contents[$i]);
            $contents[$i]=str_replace("tr","div",$contents[$i]);
            $contents[$i]=str_replace("face","disabledface",$contents[$i]);

            $summary[$i]=$element->plaintext;
            $firstSentenceEnd=strpos($summary[$i],".",$maxSummaryLength);
            $foundSentenceEnd=true;
            if($firstSentenceEnd<=1)
            {
                $foundSentenceEnd=false;
                $firstSentenceEnd=strpos($summary[$i]," ",$maxSummaryLength);
            }
            $summary[$i]=substr($summary[$i],0,$firstSentenceEnd+1);
            if(!$foundSentenceEnd && strlen($summary[$i])>=$maxSummaryLength)
                $summary[$i]=$summary[$i]. "...";
        }
        $result=array("titles"=>$titles,"contents"=>$contents,"summary"=>$summary,"links"=>$links,"description"=>$summary,"categoryids"=>$categoryids);
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