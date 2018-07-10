<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Label;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\link;


class posts_Design extends FormDesign {
	private $links,$titles,$posts,$PostCats;
	public function getBodyHTML($command=null)
	{
		$Page=new ListTable(1);
		$Page->setId("posts_posts");
		$TitlesCount=count($this->titles);
		for($i=0;$i<$TitlesCount;$i++)
		{
			$LinkTitle=new link($this->links[$i], $this->titles[$i]);
			$LinkTitle->setClass("posts_postlisttitle");
			$Page->addElement($LinkTitle);
			$Page->setLastElementClass("posts_poststitle");
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
			$Page[$i]["date"]=$this->posts['adddate'][$i];
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
}
?>
