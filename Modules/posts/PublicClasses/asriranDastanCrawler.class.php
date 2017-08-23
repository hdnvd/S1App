<?php

namespace Modules\posts\PublicClasses;

/**
 *
 * @author nahavandi
 *        
 */
class asriranDastanCrawler extends asriranCrawler{
	public function __construct($MaxPosts=5)
	{
		$ArchiveUrl="http://www.asriran.com/fa/archive?sec_id=25";
		$this->setMaxPosts($MaxPosts);
		parent::__construct($ArchiveUrl);
	}
}

?>