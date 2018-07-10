<?php

namespace Modules\posts\PublicClasses;

use core\CoreClasses\SweetDate;
/**
 *
 * @author nahavandi
 *        
 */
class farsnewsCrawler extends Crawler{
	private $ArchiveUrl;
	private $MaxPosts=10;
	private $SearchText;
	public function __construct()
	{
	}
	public function getPostsArray()
	{
		//Asriran Dastan
		$Service['url1']="http://search.farsnews.com/s/?q=" . urlencode($this->SearchText);
		$Service['logic1']="h1 a";
		$Service['url2']="";
		$Service['logic2']="#ctl00_bodyHolder_newstextDetail_nwstxtBodyPane";
		$Service['logic2alternative1']="#nwstxtBodyPane";
		$Service['logic3']="#photoframe div h2";
		
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
		$logic=$Service['logic1'];
		$Elements=$html->find($logic);
		for($i=0;$i<count($Elements) && $i<$this->MaxPosts;$i++)
		{
			$titles[$i]=$Elements[$i]->plaintext;
			$links[$i]=$Service['url2'] . $Elements[$i]->href;
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
			if($element==null)
			{
			    $logic=$Service['logic2alternative1'];
			    $element=$html->find($logic,0);
			}
			$Summaryelement=$html->find($Service['logic3'],0);
			$contents[$i]=$element->innertext;
			$summary[$i]=$Summaryelement->innertext;
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