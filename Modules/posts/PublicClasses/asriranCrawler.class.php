<?php

namespace Modules\posts\PublicClasses;

/**
 *
 * @author nahavandi
 *        
 */
class asriranCrawler extends Crawler{
	private $ArchiveUrl;
	private $MaxPosts=5;
	public function __construct($ArchiveUrl)
	{
		$this->ArchiveUrl=$ArchiveUrl;
	}
	
function getURLHTML( $url,  $debugmode=false ) {
    $curlDefault  = array(
    CURLOPT_PORT => 80, //ignore explicit setting of port 80
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_FOLLOWLOCATION => TRUE,
    CURLOPT_ENCODING => '',
    CURLOPT_HTTPHEADER => array(
'User-Agent: Mozilla/5.0 (Windows NT 6.3; rv:39.0) Gecko/20100101 Firefox/39.0',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
'Accept-Language: en-US,en;q=0.5',
'Accept-Encoding: gzip, deflate',
        'Cookie: __qca=blabla',
        'Connection: Close',
    ),
);
if($debugmode)
{
$curlDefault[CURLOPT_VERBOSE]=TRUE;
$curlDefault[CURLOPT_STDERR]=$verbose = fopen('php://temp', 'rw+');
}
$handle = curl_init($url);
$SetStatus=curl_setopt_array($handle, $curlDefault);

curl_setopt($handle, CURLOPT_HTTPHEADER, array('Expect:'));
curl_setopt($handle, CURLOPT_POSTFIELDS, array());
$html = curl_exec($handle);
if($debugmode)
{
echo $SetStatus;
$urlEndpoint = curl_getinfo($handle, CURLINFO_EFFECTIVE_URL);
echo "Verbose information:\n<pre>", !rewind($verbose), htmlspecialchars(stream_get_contents($verbose)), "</pre>\n";
$curlVersion = curl_version();
echo $curlVersion['version'];
}
curl_close($handle);
return $html;
}


	public function getPostsArray()
	{
		//Asriran Dastan
		$Service['url1']=$this->ArchiveUrl;
		$Service['logic1']="a.title5";
		$Service['url2']="http://www.asriran.com";
		$Service['logic2']="div[class=body]";
		
		
		$titles=array();
		$links=array();
		$summary=array();
		$contents=array();
		$dposter=new \data_poster();
		$dom=new \simple_html_dom();
		
		
		//***********Title***********//
		$url=$Service['url1'];
		$postdata = array();
		$response=$dposter->send_request($url, $postdata);
		$html=str_get_html($response);
		$logic=$Service['logic1'];
		$i=0;
		$Elements=$html->find($logic);
		for($i=0;$i<count($Elements) && $i<$this->MaxPosts;$i++)
		{
			$titles[$i]=$Elements[$i]->plaintext;
			$links[$i]=$Elements[$i]->href;
		}
		$postsCount=$i;
		//***********Title***********//
		$contents=array();
		for($i=0;$i<$postsCount;$i++)
		{
			$urlArray=explode("/", $links[$i]);
			$url=$Service['url2'];
			
				$links[$i]=$url . $links[$i];
			for($urli=1;$urli<5;$urli++)
			{
				if($urli!=4)
					$url.="/" . $urlArray[$urli];
				else
					$url.="/" . urlencode($urlArray[$urli]);
			}

			$links[$i]=$url;
//$url="http://www.asriran.com/fa/news/407760/%D8%A2%D8%A8-%D9%85%D8%B1%D9%88%D8%A7%D8%B1%DB%8C%D8%AF-%D8%AC%D9%88%D8%A7%D9%86-%D9%88-%D9%BE%DB%8C%D8%B1-%D9%86%D9%85%DB%8C%E2%80%8C%D8%B4%D9%86%D8%A7%D8%B3%D8%AF";
//$response=$this->get_fcontent($url);


			//$response=file_get_html($url);
			$html=$this->getURLHTML($url);
			//echo $html;
			//die();
			$html=str_get_html($html);
			$logic=$Service['logic2'];
			$element=$html->find($logic,0);
			$contents[$i]=$element->innertext . "\r\n<p id='sourcelink'>منبع:عصر ایران</p>";
			$summary[$i]=$element->innertext;
		}
		$result=array("titles"=>$titles,"contents"=>$contents,"summary"=>$summary,"links"=>$links,"description"=>"");
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