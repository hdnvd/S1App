<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Label;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Headers\H1;
use core\CoreClasses\html\Div;
use Modules\common\PublicClasses\AppRooter;


class post_Design extends FormDesign {
	private $LblTitle,$lblLastUpdate,$LblContent,$LblLastUpdateTitle,$LblVisitsTitle,$LblVisits,$linkCategories;
	private $PostLink;
	private $Tags;
	private $ShowExternalLinks;
	private $ExternalLink;
	public function getBodyHTML($command=null)
	{
		
		$Page=new ListTable(1);
		$LblTitle=new H1($this->LblTitle);
		$LblTitle->setClass("posttitle");
		$LinkTitle=new link($this->PostLink, $LblTitle);
		$Page->addElement($LinkTitle);
		
		$LblLastUpdateTitle=new Lable($this->LblLastUpdateTitle);
		$LblLastUpdateTitle->setClass("postlastupdatetitle");
		//$Page->addElement($LblLastUpdateTitle);
		$lblLastUpdate=new Lable($this->lblLastUpdate);
		$lblLastUpdate->setClass("postlastupdate");
		//$Page->addElement($lblLastUpdate);
		
		$LblContent=new Lable($this->LblContent);
		$LblContent->setHtmlContent(false);
		$divContent=new Div();
		$divContent->addElement($LblContent);
		$divContent->setClass("posts_postcontent");
		$Page->addElement($divContent);
		
		$divTags=new Div();
		$divTags->setClass("posts_post_tags");
// 		print_r($this->Tags);
		for($i=0;$i<count($this->Tags);$i++)
		{
		    $tmpLink[$i]=new AppRooter("tags", str_ireplace(" ","-", $this->Tags[$i]));
		    $tmpLink[$i]->setFileFormat(".html");
		    $tmpLinkTag[$i]=new link($tmpLink[$i]->getAbsoluteURL(), new Lable($this->Tags[$i]));
		   
		    $divTags->addElement($tmpLinkTag[$i]);
		    
		}
		if($this->ShowExternalLinks==1)
		{
    		$ExternalLink=new link($this->ExternalLink, new Lable("لینک منبع"));
    		$ExternalLink->setId("posts_externallink");
    		$Page->addElement($ExternalLink);
		}
		$Page->addElement($divTags);
		$LblVisitsTitle=new Lable($this->LblVisitsTitle);
		$LblVisitsTitle->setClass("postvisitstitle");
		//$Page->addElement($LblVisitsTitle);
		
		$LblVisits=new Lable($this->LblVisits);
		$LblVisits->setClass("postvisits");
		//$Page->addElement($LblVisits);
		
		//$linkCategories=new link("", "Cats");
		//$Page->addElement($linkCategories);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getXML()
	{
		$Page=new \SimpleXMLElement("<post></post>");
		$Page->addChild("title",$this->LblTitle);
		$Page->addChild("content",$this->LblContent);
		$Page->addChild("visits",$this->LblVisits);
		return $Page;
	}
	public function setLblTitle($LblTitle)
	{
	    $this->LblTitle = $LblTitle;
	}

	public function setLblLastUpdate($lblLastUpdate)
	{
	    $this->lblLastUpdate = $lblLastUpdate;
	}

	public function setLblContent($LblContent)
	{
	    $this->LblContent = $LblContent;
	}

	public function setLblLastUpdateTitle($LblLastUpdateTitle)
	{
	    $this->LblLastUpdateTitle = $LblLastUpdateTitle;
	}

	public function setLblVisitsTitle($LblVisitsTitle)
	{
	    $this->LblVisitsTitle = $LblVisitsTitle;
	}

	public function setLblVisits($LblVisits)
	{
	    $this->LblVisits = $LblVisits;
	}

	public function setLinkCategories($linkCategories)
	{
	    $this->linkCategories = $linkCategories;
	}

	public function setPostLink($PostLink)
	{
	    $this->PostLink = $PostLink;
	}

	public function setTags($Tags)
	{
	    $this->Tags = $Tags;
	}

	public function setShowExternalLinks($ShowExternalLinks)
	{
	    $this->ShowExternalLinks = $ShowExternalLinks;
	}

	public function setExternalLink($ExternalLink)
	{
	    $this->ExternalLink = $ExternalLink;
	}
}
?>
