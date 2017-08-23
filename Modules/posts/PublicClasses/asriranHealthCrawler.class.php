<?php

namespace Modules\posts\PublicClasses;

/**
 *
 * @author nahavandi
 *        
 */
class asriranHealthCrawler extends asriranCrawler{
	//@Override
	public function __construct($MaxPosts=5)
	{
		$ArchiveUrl="http://www.asriran.com/fa/archive?service_id=1&sec_id=120";
		$this->setMaxPosts($MaxPosts);
		parent::__construct($ArchiveUrl);
	}
	//@Override
	public function getPostsArray()
	{
	    $result=parent::getPostsArray();
	    $Contents=$result['contents'];
	    for($i=0;$i<count($Contents);$i++)
	    {
	        $Contents[$i]=str_ireplace('<a href="http://www.asriran.com/#Health" target="_blank">برای خواندن سایر مطالب سلامت اینجا کلیک کنید</a>', "", $Contents[$i]);
	        $Contents[$i]=str_ireplace("برای خواندن سایر مطالب سلامت اینجا کلیک کنید", "", $Contents[$i]);
	        $Contents[$i]=str_ireplace("<a", "<p", $Contents[$i]);
	        $Contents[$i]=str_ireplace("</a", "</p", $Contents[$i]);
	        $Contents[$i]=str_ireplace("< a", "<p", $Contents[$i]);
	        $Contents[$i]=str_ireplace("</ a", "</p", $Contents[$i]);
	        $Contents[$i]=str_ireplace("</a ", "</p", $Contents[$i]);
	    }
	    $result['contents']=$Contents;
	    return $result;
	}
}

?>