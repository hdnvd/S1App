<?php

namespace Modules\posts\PublicClasses;

/**
 *
 * @author nahavandi
 *
 */
class irnaCrawler extends Crawler{
    private $ArchiveUrl;
    private $MaxPosts=10;
    public function __construct($ArchiveUrl)
    {
        $this->ArchiveUrl=$ArchiveUrl;
    }
    public function getPostsArray()
    {
        //Asriran Dastan
        $Service['url1']=$this->ArchiveUrl;
        $Service['logic1']=".DataListContainer a";
        $Service['url2']="http://www.irna.ir";
        $Service['logic2']="#ctl00_ctl00_ContentPlaceHolder_ContentPlaceHolder_NewsContent4_BodyLabel";
        $Service['logic2-5']=".MainImageBox";
        $Service['logic3']="H3#ctl00_ctl00_ContentPlaceHolder_ContentPlaceHolder_NewsContent4_H1";


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
        $logic=$Service['logic1'];
        $Elements=$html->find($logic);
// 		echo $this->MaxPosts;
        for($i=0;$i<count($Elements) && $i<$this->MaxPosts;$i++)
        {
            $titles[$i]=$Elements[$i]->plaintext;
            $titles[$i]=str_ireplace("<span class='IconNormal'></span>", "", $titles[$i]);
            $links[$i]=$Service['url2'] . $Elements[$i]->href;
            $links[$i]=substr($links[$i],0,strlen($links[$i])-1);
        }
        $postsCount=$i;
        //***********Title***********//
// 		echo "getting Contents:";
        $contents=array();
        $Images=[];
        for($i=0;$i<$postsCount;$i++)
        {
            $postdata = array();
            $response=sweet_file_get_html($links[$i]);
            $html=str_get_html($response);
            $logic=$Service['logic2'];
            $element=$html->find($logic,0);
            $Imageelement=$html->find($Service['logic2-5'],0);
            $Summaryelement=$html->find($Service['logic3'],0);
            $contents[$i]= $element->innertext  ;
            if($Imageelement!=null)
                $contents[$i]=$Imageelement->innertext .$contents[$i];
            //echo "text:<br>" . $Summaryelement->innertext;
            //die();
            $summary[$i]=$Summaryelement->innertext;
            $Images[$i]=$this->getAnImageURL($contents[$i]);
        }
        $result=array("titles"=>$titles,"contents"=>$contents,"summary"=>$summary,"links"=>$links,"description"=>$summary,"thumbnails"=>$Images);
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