<?php

namespace Modules\posts\Forms;
use core\CoreClasses\html\Image;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Label;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Headers\H1;


class blogposts_Design extends FormDesign {
	private $links,$titles,$posts,$PostCats;
	private $PageCount,$CurrentPage,$PageLink;
	private $displaypostthumbnails,$defaultpostthumbnail;

    /**
     * @param mixed $displaypostthumbnails
     */
    public function setDisplaypostthumbnails($displaypostthumbnails)
    {
        $this->displaypostthumbnails = $displaypostthumbnails;
    }

    /**
     * @param mixed $defaultpostthumbnail
     */
    public function setDefaultpostthumbnail($defaultpostthumbnail)
    {
        $this->defaultpostthumbnail = $defaultpostthumbnail;
    }
	public function getBodyHTML($command=null)
	{
		$Page=new ListTable(1);
		$Page->setId("posts_blogposts");
		$TitlesCount=count($this->titles);
		$Separator=new Div();
		$Separator->setClass("separator");
		for($i=0;$i<$TitlesCount;$i++)
		{
			$this->titles[$i]=new H1($this->titles[$i]);
			$LinkTitle=new link($this->links[$i], $this->titles[$i]);
			$LinkTitle->setClass("posts_postlisttitle");
			
			$FullContentDiv=new Div();
			$FullContentDiv->addElement(new Lable("ادامه مطلب..."));
			$FullContentLink=new link($this->links[$i], $FullContentDiv);
			$FullContentLink->setClass("posts_fullcontentlink");
			$PostDiv=new Div();
			$PostDiv->setClass("posts_postsummary");

            $thumb[$i]=DEFAULT_PUBLICURL . $this->defaultpostthumbnail;
            if(trim($this->posts['thumbnail'][$i])!="")
                $thumb[$i]=trim($this->posts['thumbnail'][$i]);
            $img[$i]=new Image($thumb[$i],$this->titles[$i]);
            $imgDiv[$i]=new Div("thumbnaildiv".$this->posts['id'][$i],"posts_thumbnail");
            $imgDiv[$i]->addElement($img[$i]);
            if($this->displaypostthumbnails=="1")
                $PostDiv->addElement($imgDiv[$i]);

            $l=new Lable($this->posts['summary'][$i]);
            $l->setHtmlContent(false);
            $PostDiv->addElement($l);

			$Page->addElement($LinkTitle);
			$Page->setLastElementClass("posts_blogposttitle");
			$Page->addElement($PostDiv);
			$Page->setLastElementClass("posts_blogpostsummary");
			$Page->addElement($FullContentLink);
			$Page->setLastElementClass("posts_blogpostfooter");
			$Page->addElement($Separator);
		}
		if($this->PageCount>1)
		{
		    $PaginationDiv=new Div();
    		for($i=1;$i<=$this->PageCount;$i++)
    		{
    			$tmpPageLink=new link($this->PageLink . "?pn=$i", $i);
    			$PaginationDiv->addElement($tmpPageLink);
    		}
    		$PaginationDiv->setId("posts_pagination");
    		$Page->addElement($PaginationDiv);
		}
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function setLinks($links)
	{
	    $this->links = $links;
	}
	public function getXML()
	{
		$Page=new \SimpleXMLElement("<posts></posts>");
		$TitlesCount=count($this->titles);
		for($i=0;$i<$TitlesCount;$i++)
		{
			$Page2=$Page->addChild("post");
            $Page2->addChild("id",$this->posts['id'][$i]);
			$Page2->addChild("title",htmlspecialchars(str_replace('"',"'",$this->posts['title'][$i]), ENT_QUOTES));
			$Page2->addChild("content",htmlspecialchars(str_replace('"',"'",$this->posts['content'][$i]), ENT_QUOTES));
			$Page2->addChild("summary",htmlspecialchars(str_replace('"',"'",$this->posts['summary'][$i]), ENT_QUOTES));
		}
		return $Page;
	}
	public function getJSON()
	{
		
		$Page=array();
		$TitlesCount=count($this->titles);
		for($i=0;$i<$TitlesCount;$i++)
		{
			$title=str_replace('"',"'",$this->posts['title'][$i]);
			$content=str_replace('"',"'",$this->posts['content'][$i]);
			$summary=str_replace('"',"'",$this->posts['summary'][$i]);
			$Page[$i]["id"]=$this->posts['id'][$i];
			$Page[$i]["title"]=$title;
			$Page[$i]["content"]=$content;
			$Page[$i]["summary"]="";
			$Page[$i]["isfree"]="0";
			$Page[$i]["category"]=$this->PostCats[$i][0]['id'];
		}
		$fullPage=array("posts"=>$Page);
		$result=str_replace("&lt;","<",json_encode($fullPage));
		$result=str_replace("&gt;", ">", $result);
		return $result;
	}
	public function setTitles($titles)
	{
	    $this->titles = $titles;
	}

	public function setPosts($posts)
	{
	    $this->posts = $posts;
	}

	public function setPostCats($PostCats)
	{
	    $this->PostCats = $PostCats;
	}

	public function setPageCount($PageCount)
	{
	    $this->PageCount = $PageCount;
	}

	public function setCurrentPage($CurrentPage)
	{
	    $this->CurrentPage = $CurrentPage;
	}

	public function setPageLink($PageLink)
	{
	    $this->PageLink = $PageLink;
	}
}
?>
