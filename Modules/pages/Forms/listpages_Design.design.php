<?php

namespace Modules\pages\Forms;


use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\link;
use core\CoreClasses\html\elementGroup;
/**
 *
 * @author hadi
 *        
 */
class listpages_Design extends FormDesign{
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 */
	public function getBodyHTML($command = "load") {
		
		$result=$this->pages;
		$html="";
		$eGroup=new elementGroup();
		for($i=0;$i<count($result);$i++)
		{
			$link="?module=pages&page=showpage&pageid=" . $result[$i]['id'];
			$link=new link($link, $result[$i]['title']);
			$eGroup->addElement($link);
		}
		return $eGroup->getHTML();
	}
}

?>