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
		
		$Service['url1']="http://www.mehrnews.com/tag/%D8%B4%D9%87%D8%B1%D8%B3%D8%AA%D8%A7%D9%86+%D9%85%D8%B1%D8%A7%D8%BA%D9%87";
		$Service['logic1']="div .third-news ul li.clearfix h3 a";
		$Service['url2']="http://www.mehrnews.com";
		$Service['logic2']="div .item-body .full-text";//main
		$Service['logic3']="div.item-body span.intro-text";//summary
		
		
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
		$html=sweet_file_get_html($url);
//echo $html;
		$logic=$Service['logic1'];
		$Elements=$html->find($logic);
// 		
		for($i=0;$i<count($Elements) && $i<$this->MaxPosts;$i++)
		{
			$titles[$i]=$Elements[$i]->plaintext;
			$titles[$i]=str_ireplace("<span class='IconNormal'></span>", "", $titles[$i]);
			$links[$i]=$Service['url2'] . $Elements[$i]->href;
$beforePersianUrl=strpos($links[$i],"/");
$beforePersianUrl=strpos($links[$i],"/",$beforePersianUrl+1);
$beforePersianUrl=strpos($links[$i],"/",$beforePersianUrl+1);
$beforePersianUrl=strpos($links[$i],"/",$beforePersianUrl+1);
$beforePersianUrl=strpos($links[$i],"/",$beforePersianUrl+1);
$end=substr($links[$i],$beforePersianUrl+1,(strlen($links[$i])-$beforePersianUrl)+1);
$links[$i]=substr($links[$i],0,$beforePersianUrl+1);
$links[$i].=urlencode($end);
echo  "<a href='" . $links[$i] . "'>" . $titles[$i] . "</a><br>";
		}

		$postsCount=$i;
		//***********Title***********//
// 		echo "getting Contents:";
		$contents=array();
		$imageContainers=array();
		$images=array();
		for($i=0;$i<$postsCount;$i++)
		{
			$postdata = array();
			$response=sweet_file_get_html($links[$i]);
			//$response=$this->getURLHTML($links[$i]);
			$html=str_get_html($response);
			$logic=$Service['logic2'];
			$element=$html->find($logic,0);
			$Summaryelement=$html->find($Service['logic3'],0);
			$contents[$i]=$element->innertext;
			$imageContainers[$i]=$html->find("div.inner .large-image",0);
			$images[$i]=$html->find("div.inner .large-image img",0);
			$images[$i]=$images[$i]->src;
			$contents[$i]=$imageContainers[$i]->innertext . $contents[$i];
//echo $images[$i];
//die();
			$summary[$i]=$Summaryelement->innertext;
		}
		$result=array("titles"=>$titles,"contents"=>$contents,"summary"=>$summary,"links"=>$links,"description"=>$summary,"thumbnails"=>$images);
// 		echo "Title:" . $result['titles'][0];
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