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
        $ArchiveUrl="http://www.irna.ir/eazarbaijan/fa/zone/100066/%D8%AF%D9%81%D8%AA%D8%B1_%D9%85%D8%B1%D8%A7%D8%BA%D9%87";
        $this->setMaxPosts($MaxPosts);
        parent::__construct($ArchiveUrl);
    }
}

?>