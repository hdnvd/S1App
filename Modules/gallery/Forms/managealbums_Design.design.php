<?php

namespace Modules\gallery\Forms;
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
use Modules\common\PublicClasses\UrlParameter;
use core\CoreClasses\html\link;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2014/12/21 13:13:37
 *@lastUpdate 2014/12/21 13:13:37
*/


class managealbums_Design extends FormDesign {
	private $Albums;
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
		$Page->setId("gallery_managealbums");
		$Page->addElement(new Lable("مدیریت آلبوم ها"));
		$LTable1=new ListTable(3);
		for($i=0;$i<count($this->Albums);$i++)
		{
			$EditLink=new AppRooter("gallery", "managealbum");
			$EditLink->addParameter(new UrlParameter("id", $this->Albums[$i]['id']));
			$DeleteLink=new AppRooter("gallery", "managealbum");
			$DeleteLink->addParameter(new UrlParameter("id", $this->Albums[$i]['id']));
			$DeleteLink->addParameter(new UrlParameter("delete", "1"));
			$productTitle[$i]=new link($EditLink->getAbsoluteURL(), new Lable($this->Albums[$i]['title']));
			$Edit[$i]=new link($EditLink->getAbsoluteURL(), new Lable("ویرایش"));
			$Delete[$i]=new link($DeleteLink->getAbsoluteURL(), new Lable("حذف"));
			$LTable1->addElement($productTitle[$i]);
			$LTable1->addElement($Edit[$i]);
			$LTable1->addElement($Delete[$i]);
		}
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}

	public function setAlbums($Albums)
	{
	    $this->Albums = $Albums;
	}
}
?>
