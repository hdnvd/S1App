<?php
namespace Modules\posts\Forms;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Label;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\html\link;
use core\CoreClasses\services\WidgetDesign;
use core\CoreClasses\html\UList;
use core\CoreClasses\html\UListElement;
use core\CoreClasses\html\Div;


class postswidget_Design extends WidgetDesign {
	private $links,$titles;
	public function getBodyHTML($command=null)
	{
		$PageFull=new Div();
		$PageFull->setId("posts_postswidget");
		$PageFull->setClass("scroll-text");
		$Page=new UList();
		
		
		$TitlesCount=count($this->titles);
		for($i=0;$i<$TitlesCount;$i++)
		{
			$LinkTitle=new link($this->links[$i], $this->titles[$i]);
			$LinkTitle->setClass("posts_postswidgettitle");
			$Li=new UListElement($LinkTitle);
			$Page->addElement($Li);
		}
		$PageFull->addElement($Page);
		$form=new SweetFrom("", "POST", $PageFull);
		return $form->getHTML();
	}

	public function setLinks($links)
	{
	    $this->links = $links;
	}
	
	public function setTitles($titles)
	{
	    $this->titles = $titles;
	}
}
?>
