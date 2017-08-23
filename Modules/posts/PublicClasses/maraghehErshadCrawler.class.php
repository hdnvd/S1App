<?php

namespace Modules\posts\PublicClasses;

use core\CoreClasses\SweetDate;
/**
 *
 * @author nahavandi
 *        
 */
class maraghehErshadCrawler extends Crawler{
	private $ArchiveUrl;
	private $MaxPosts=5;
	private $SearchText;
	public function __construct()
	{
	}
	public function getPostsArray()
	{
		
		$Service['url1']="http://maraghe.ershad-as.ir/default.aspx?MID=24&SubjectTypeID=1&dates=1392/11/08&datee=1404/01/01";
		$Service['logic1']=".News_Titr";
		$Service['url2']="http://maraghe.ershad-as.ir";
		$Service['logic2']="#ctl02_ctl00_lblFullText div";
		$Service['logic3']=".News_Titr #ctl02_ctl00_lblheadTitle";
		
		$titles=array();
		$links=array();
		$summary=array();
		$contents=array();
		$dposter=new \data_poster();
		$dom=new \simple_html_dom();
		
		
		//***********Title***********//
		$url=$Service['url1'];
		//$response=$dposter->send_request($url, $postdata);
		$html=sweet_file_get_html($url);
// 		echo $html;
		$logic=$Service['logic1'];
		$Elements=$html->find($logic);
// 		echo count($Elements);
		$maxTitleLength=110;
		$maxSummaryLength=300;
		for($i=0;$i<count($Elements) && $i<$this->MaxPosts;$i++)
		{
			$titles[$i]=trim($Elements[$i]->plaintext);
			
			if(strlen($titles[$i])>=$maxTitleLength)
			{
			    $spaceaftermax=strpos($titles[$i]," ",$maxTitleLength);
			    $titles[$i]=substr($titles[$i],0,$spaceaftermax) . "...";
			}
			     
			$links[$i]=$Service['url2'] . html_entity_decode($Elements[$i]->href);
			echo $titles[$i] . "</br>";
		}
		$postsCount=$i;
		//***********Title***********//
		$contents=array();
		for($i=0;$i<$postsCount;$i++)
		{
			$postdata = array();
			$response=sweet_file_get_html($links[$i]);
			$html=str_get_html($response);
			$logic=$Service['logic2'];
			$element=$html->find($logic,0);
			$contents[$i]=$element->innertext;
			$summary[$i]=$element->plaintext;
// 			$Summaryelement=$html->find($Service['logic3'],0);
// 			$summary[$i]=trim($Summaryelement->plaintext);
// 			echo strlen($summary[$i]) . "--" . $summary[$i] . "<br><br>";
// 			if(strlen($summary[$i])<10)
// 			{
// 			    $summary[$i]=substr($contents[$i],0,150);
// 			    if(strlen($summary[$i])==150) 
// 			        $summary[$i]=$summary[$i]. "...";
// 			}
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
			/******************Filter Content******************/
			$contents[$i]=str_ireplace("style", "deletedstyle", $contents[$i]);
			$foundImages=0;
			$TMPContentHTML = str_get_html($contents[$i]);
			$foundImage=$TMPContentHTML->find("img",$foundImages);
			while($foundImage!=null)
			{
			    $ImageURL=trim($foundImage->src);
			    if(strtolower(substr($ImageURL, 0,4))!="http")
			        $foundImage->src="http://maraghe.ershad-as.ir/" . $foundImage->src;
			    $foundImages++;
			    $foundImage=$TMPContentHTML->find("img",$foundImages);
			}
			$contents[$i]=$TMPContentHTML->__toString();
			/******************Filter Content******************/
			
			
			
// 			$firstSentenceEnd=strpos($summary[$i],".");
// // 			echo $firstSentenceEnd . "::";
//             if($firstSentenceEnd>0)
// 			$summary[$i]=substr($summary[$i], 0,$firstSentenceEnd+1);
		}
		$result=array("titles"=>$titles,"contents"=>$contents,"summary"=>$summary,"links"=>$links,"description"=>$summary);
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