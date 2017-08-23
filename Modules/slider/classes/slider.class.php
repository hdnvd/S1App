<?php
namespace Modules\slider\classes;
use Modules\common\PublicClasses\AppJSLink;
use core\CoreClasses\html\JavascriptLink;
class slider
{
	private $slidecount,$image,$link,$width,$height,$slidetitle;
	public function __construct($Images,$Links,$Width,$Height,$SlideTitle)
	{
		$this->slidecount=count($Images);
		$this->image=$Images;
		$this->link=$Links;
		$this->width=$Width;
		$this->height=$Height;
		$this->slidetitle=$SlideTitle;
		
	}
	public function getSlide()
	{
		$Link=new AppJSLink("slider", "sweetslider");
		$JSLink=new JavascriptLink($Link->getAbsoluteURL());
		$html="<div id='slider'>\n";
		for($i=0;$i<$this->slidecount;$i++)
		{
			$html.="<div id='slidetab" . ($i) . "' class='slidetabitem'><a href='javascript:showSlide($i)'>" . $this->slidetitle[$i] ."</a></div>";
		}
		for($i=0;$i<$this->slidecount;$i++)
		{
			$html.="<div id='slide" . ($i) . "'  class='slideimagediv'><img id='islide" . ($i) . "' src='" . $this->image[$i] ."' width='".$this->width."' height='".$this->height."'/></div>";
		}
		$html.="</div>\n";
		return $html . $JSLink->getHTML();
	}
}

?>
