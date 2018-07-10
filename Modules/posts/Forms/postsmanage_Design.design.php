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
use core\CoreClasses\html\link;
use Modules\common\PublicClasses\AppRooter;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\Div;


class postsmanage_Design extends FormDesign {
	private $PostLinks,$PostTitles,$DeleteLinks,$DeleteCaption;
	private $PublishLinks,$PublishTexts;
	public function getBodyHTML($command=null)
	{
		$Page=new ListTable(3);
		$Page->setId("posts_postsmanage_list");
		$addnewLink=new AppRooter("posts", "postmanage");
		$addnewH=new link($addnewLink->getAbsoluteURL(), new Lable("افزودن مطلب جدید"));
		$addnew=new Div();
		$addnew->addElement($addnewH);
		$addnew->setId("posts_postsmanage_addnewlink");
		$Page->addElement($addnew,3);
		for($i=0;$i<count($this->PostTitles);$i++)
		{
			if($this->PostTitles[$i]=="")
				$this->PostTitles[$i]="--بدون عنوان--";
			$Page->addElement(new link($this->PostLinks[$i], $this->PostTitles[$i]));
			$Page->setLastElementClass("poststitle");
			$Page->addElement(new link($this->DeleteLinks[$i], $this->DeleteCaption));
			$Page->setLastElementClass("delete");
			$Page->addElement(new link($this->PublishLinks[$i], $this->PublishTexts[$i]));
			$Page->setLastElementClass("changepublish");
		}
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function setPostLinks($PostLinks)
	{
	    $this->PostLinks = $PostLinks;
	}

	public function setPostTitles($PostTitles)
	{
	    $this->PostTitles = $PostTitles;
	}

	public function setDeleteLinks($DeleteLinks)
	{
	    $this->DeleteLinks = $DeleteLinks;
	}

	public function setDeleteCaption($DeleteCaption)
	{
	    $this->DeleteCaption = $DeleteCaption;
	}

	public function setPublishLinks($PublishLinks)
	{
	    $this->PublishLinks = $PublishLinks;
	}

	public function setPublishTexts($PublishTexts)
	{
	    $this->PublishTexts = $PublishTexts;
	}
}
?>
