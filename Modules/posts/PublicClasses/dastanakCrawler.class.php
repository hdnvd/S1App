<?php

namespace Modules\posts\PublicClasses;

/**
 *
 * @author nahavandi
 *        
 */
class dastanakCrawler extends Crawler{
	public function getPostsArray()
	{
		//Dastanak
		$Service['url1']="http://www.dastanak.com/";
		$Service['logic1']=".post div.title";
		$Service['url2']=null;
		$Service['logic2']=".text";
		$requestXML = '<xml><!-- ... the xml you want to post to the server... --></xml>';
		$requestHeaders = array(
				'Content-type: application/x-www-form-urlencoded',
				'Accept: application/xml',
				sprintf('Content-Length: %d', strlen($requestXML))
		);
		
		$context = stream_context_create(array('http' => array(
				'method'  => 'POST',
				'header'  => implode("\r\n", $requestHeaders),
				'content' => $requestXML)));
		$titles=array();
		$links=array();
		$summary=array();
		$contents=array();
		$dposter=new \data_poster();
		$dom=new \simple_html_dom();
		//***********Title***********//
		$url=$Service['url1'];
		$response=file_get_contents($url,null,$context);
		$html=str_get_html($response);
		$logic=$Service['logic1'];
		$logic2=$Service['logic2'];
		$i=0;
	
		foreach($html->find($logic) as $element)
		{
			$titles[$i]=$element->innertext;
			$links[$i]=$Service['url1'];
			$i++;
		}
		//***********Title***********//
		
		$j=0;
		foreach($html->find($logic2) as $element)
		{
			$summary[$j]=$element->innertext;
			$contents[$j]=$summary[$j];
			$j++;
		}
		$postsCount=$i;
		if($i==$j)
			$result=array("titles"=>$titles,"contents"=>$contents,"summary"=>$summary,"links"=>$links,"description"=>"");
		else 
		{
			die("Error!");
			$result=null;
		}
		return $result;
	
	}
}

?>