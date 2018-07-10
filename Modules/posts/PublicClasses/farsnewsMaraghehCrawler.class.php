<?php

namespace Modules\posts\PublicClasses;

/**
 *
 * @author nahavandi
 *        
 */
class farsnewsMaraghehCrawler extends farsnewsCrawler{
    public function __construct($MaxPosts=10)
	{
		$this->setMaxPosts($MaxPosts);
		$this->setSearchText("از مراغه");
		parent::__construct();
	}
}

?>