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
            $titles[$i]=$this->getConciseTitle($items[$i]->title . "");
            $links[$i]=$items[$i]->link . "";
            $summary[$i]=$items[$i]->description . "";
        }

		$postsCount=$i;
		//***********Title***********//
        $contents=[];
        $categoryids=[];
        for($i=0;$i<$postsCount;$i++)
        {
            $response=sweet_file_get_html($links[$i]);
            $html=str_get_html($response);
            $element=$html->find($ContentLogic,0);
            $contents[$i]=$element->innertext;
            $SmallTitle[$i]=$html->find("#ctl01_lblhead",0);
            $titles[$i]=$SmallTitle[$i]->plaintext . "";
            $contents[$i]=str_replace("src=\"","src=\"".$RootURL,$contents[$i]);
            $contents[$i]=str_replace("src='","src='".$RootURL,$contents[$i]);
            if (trim($titles[$i]) != "") {
                if ($this->getJunkWordCount($titles[$i]) >= 1)
                    $categoryids[$i] = "1";
                else
                    $categoryids[$i] = "12";
            }
        }

		$result=array("titles"=>$titles,"contents"=>$contents,"summary"=>$summary,"links"=>$links,"description"=>$summary,'categoryids'=>$categoryids);
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