<?php
namespace Modules\common\PublicClasses;
use core\CoreClasses\Rooter\RooterLink;
/** 
 * @author nahavandi
 * 
 */
class AppJSLink extends RooterLink {
	private $Module,$Page;
	public function __construct($Module,$Page)
	{
		$this->setModule($Module);
		$this->setPage($Page);
	}
	private static function getLink($Module,$Page,$IsAbsolute=true)
	{
		$link="";
			$link="$Module/$Page.js";
		if($IsAbsolute)
			$link=DEFAULT_APPURL . $link;
		else
			$link="/". $link;
		return $link;
	
	}
	public function getAbsoluteURL()
	{
		return $this->getLink($this->Module, $this->Page,true);
	}
	public function getRelativeURL()
	{
		return $this->getLink($this->Module, $this->Page,false);
	}
	public function setModule($Module)
	{
	    $this->Module = $Module;
	}
	public function setPage($Page)
	{
	    $this->Page = $Page;
	}
}

?>