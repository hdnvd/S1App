<?php

namespace Modules\posts\PublicClasses;

/**
 *
 * @author nahavandi
 *        
 */
class irnaMaraghehCrawler extends irnaCrawler{
    public function __construct($MaxPosts=10)
	{
		$ArchiveUrl="http://www3.as.irna.ir/fa/NewsPage.aspx?action=as&all=&exact=مراغه%20-%20ایرنا&one=&nt=چاراویماق%20هشترود%20عجب%20شیر&from=2/2/2014&to=1/27/2020&kind=-1&area=3&type=-1&ps=10&of=titr&archive=f";
		$this->setMaxPosts($MaxPosts);
		parent::__construct($ArchiveUrl);
	}
}

?>