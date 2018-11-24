<?php

namespace Modules\posts\PublicClasses;

/**
 *
 * @author nahavandi
 *        
 */
class maraghehMehrCrawler extends Crawler{
	private $ArchiveUrl;
	private $MaxPosts=10;
	public function __construct($ArchiveUrl)
	{
		$this->ArchiveUrl=$ArchiveUrl;
	}
	public function getPostsArray()
	{
		$RSSURL="https://www.mehrnews.com/rss?kw=%D9%85%D8%B1%D8%A7%D8%BA%D9%87";
		$Service['logic2']="div .item-body .item-text";//main
		
		
		$titles=array();
		$FullTitles=[];
		$links=array();
		$summary=array();
		$dom=new \simple_html_dom();


		//***********Title***********//

        $data=$this->getXMLFromURL($RSSURL);
        $xml = simplexml_load_string($data);
        $items=$xml->channel->item;
        $ItemCount=count($items);

        $categoryids=[];
        for($i=0;$i<$ItemCount && $i<$this->MaxPosts;$i++)
        {
            $titles[$i]=$items[$i]->title . "";
            $links[$i]=$items[$i]->link . "";
            $summary[$i]=$items[$i]->description . "";
            $images[$i]=$items[$i]->enclosure->attributes()->url . "";
            if (trim($titles[$i]) != "") {
                $PostWords = explode(" ", $titles[$i]);
                $LastWord = $PostWords[count($PostWords) - 1];
                if ($this->isJunkWord($LastWord) || $this->getJunkWordCount($titles[$i]) >= 1 || !$this->getIsTitleForMaragheh($titles[$i]))
                    $categoryids[$i] = ["1"];
                else
                    $categoryids[$i] = ["1","12"];
                $FullTitles[$i]=$titles[$i];
                $titles[$i]=$this->getConciseTitle($titles[$i]);
            }
        }
		$postsCount=$i;
		//***********Title***********//
		$contents=[];
		$imageContainers=array();
		for($i=0;$i<$postsCount;$i++)
		{
			$response=sweet_file_get_html($links[$i]);
			$html=str_get_html($response);
			$logic=$Service['logic2'];
			$element=$html->find($logic,0);
			$contents[$i]=$element->innertext;
			$imageContainers[$i]=$html->find(".item-summary",0);
			$contents[$i]=$imageContainers[$i]->innertext . $contents[$i];
		}
		$result=array("titles"=>$titles,"fulltitles"=>$FullTitles,"contents"=>$contents,"summary"=>$summary,"links"=>$links,"description"=>$summary,"thumbnails"=>$images,'categoryids'=>$categoryids);


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