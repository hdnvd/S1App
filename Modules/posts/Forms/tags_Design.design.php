<?php

namespace Modules\posts\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\common\PublicClasses\AppRooter;
use core\CoreClasses\html\link;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/02/25 12:57:43
 *@lastUpdate 2015/02/25 12:57:43
 *@SweetFrameworkHelperVersion 1.102
*/


class tags_Design extends FormDesign {
	private $tags;
	/**
	 * @var TextBox
	 */
	
	/**
	 * @var DataComboBox
	 */
	
	/**
	 * @var SweetButton
	 */
	
	public function __construct()
	{
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("posts_tags");
		$Page->addElement(new Lable("کلمات کلیدی سایت"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(1);
		for($i=0;$i<count($this->tags);$i++)
		{
		    $this->tags[$i]=$this->tags[$i]['title'];
		    $tmpLink=new AppRooter("tags", str_ireplace(" ", "-", $this->tags[$i]));
		    $tmpLink->setFileFormat(".html");
		    $tmpLinkTag=new link($tmpLink->getAbsoluteURL(), new Lable($this->tags[$i]));
		    $LTable1->addElement($tmpLinkTag);
		}
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function setTags($tags)
	{
	    $this->tags = $tags;
	}
}
?>
