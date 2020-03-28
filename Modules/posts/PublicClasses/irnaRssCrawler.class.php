<?php

namespace Modules\posts\PublicClasses;

/**
 *
 * @author nahavandi
 *
 */
class irnaRssCrawler extends Crawler{
    private $ArchiveUrl;
    private $MaxPosts=10;
    public function __construct($ArchiveUrl)
    {
        $this->ArchiveUrl=$ArchiveUrl;
    }
    public function getPostsArray()
    {
        $Service['url1']=$this->ArchiveUrl;
        $Service['contentlogic']="div.item-text";


        $titles=array();
        $links=array();
        $summary=array();
        $contents=array();
        $dposter=new \data_poster();
        $dom=new \simple_html_dom();


        //***********Title***********//
        $url=$Service['url1'];
        $postdata = array();
        //$response=$dposter->send_request($url, $postdata);
        $xml=sweet_file_get_contents_curl($url);
        if($xml!=null){
            $newsList = new \SimpleXMLElement($xml);
//            var_dump($newsList);
            $channel=$newsList->channel;
            $items=$channel[0]->item;
//            var_dump(((array)$items[0]->enclosure)["@attributes"]["url"]);
//            die();
// 		echo $this->MaxPosts;

            $Images=[];
            for($i=0;$i<count($items) && $i<$this->MaxPosts;$i++)
            {
                $titles[$i]=((array)$items[$i]->title)[0];
                $links[$i]=((array)$items[$i]->link)[0];
                $summary[$i]=((array)$items[$i]->description)[0];
                $Images[$i]=((array)$items[$i]->enclosure)["@attributes"]["url"];
            }
            $postsCount=$i;
            //***********Title***********//
// 		echo "getting Contents:";
            $contents=array();
            for($i=0;$i<$postsCount;$i++)
            {
                $topImg=$Images[$i];
                $imgTitle=$titles[$i];
                $topSummary=$summary[$i];
                $content="<p><figure class='item-img'><img src='$topImg' title='$imgTitle'/></figure></p>";
                $content.="<p class='summary'>$topSummary</p>";
                $response=sweet_file_get_html($links[$i]);
                $html=str_get_html($response);
                $logic=$Service['contentlogic'];
                $element=$html->find($logic,0);
                $contents[$i]=$content. $element->innertext;
            }
            $result=array("titles"=>$titles,"contents"=>$contents,"summary"=>$summary,"links"=>$links,"description"=>$summary,"thumbnails"=>$Images);
            return $result;
        }
        $result=array("titles"=>[],"contents"=>[],"summary"=>[],"links"=>[],"description"=>[],"thumbnails"=>[]);
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
}

?>