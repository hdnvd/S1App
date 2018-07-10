<?php
namespace Modules\itsap\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\services\baseHTMLElement;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\UList;
use core\CoreClasses\html\FormLabel;
use core\CoreClasses\html\UListElement;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DatePicker;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\Button;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\RadioBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use core\CoreClasses\SweetDate;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-08 - 2017-11-29 16:57
*@lastUpdate 1396-09-08 - 2017-11-29 16:57
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class topunit_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $topunit_fid;
	/** @var lable */
	private $title;
	public function __construct()
	{

		/******* topunit_fid *******/
		$this->topunit_fid= new lable("topunit_fid");

		/******* title *******/
		$this->title= new lable("title");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("itsap_topunit");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['topunit']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("topunit", $this->Data)){
			$this->setFieldCaption('topunit_fid',$this->Data['topunit']->getFieldInfo('topunit_fid')->getTitle());
			if($this->Data['topunit_fid']->getId()>0)
			    $this->topunit_fid->setText($this->Data['topunit_fid']->getTitle());
			else
                $this->topunit_fid->setText("ندارد");
			$this->setFieldCaption('title',$this->Data['topunit']->getFieldInfo('title')->getTitle());
			$this->title->setText($this->Data['topunit']->getTitle());
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->topunit_fid,$this->getFieldCaption('topunit_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("topunit", $this->Data)){
			$Result=$this->Data['topunit']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>