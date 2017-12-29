<?php
namespace Modules\fileshop\Forms;
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
*@creationDate 1396-09-09 - 2017-11-30 16:33
*@lastUpdate 1396-09-09 - 2017-11-30 16:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class file_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $file_flu;
	/** @var lable */
	private $title;
	/** @var lable */
	private $thumbnail_flu;
	/** @var lable */
	private $add_date;
	/** @var lable */
	private $description;
	/** @var lable */
	private $price;
	/** @var lable */
	private $filecount;
	public function __construct()
	{

		/******* file_flu *******/
		$this->file_flu= new lable("file_flu");

		/******* title *******/
		$this->title= new lable("title");

		/******* thumbnail_flu *******/
		$this->thumbnail_flu= new lable("thumbnail_flu");

		/******* add_date *******/
		$this->add_date= new lable("add_date");

		/******* description *******/
		$this->description= new lable("description");

		/******* price *******/
		$this->price= new lable("price");

		/******* filecount *******/
		$this->filecount= new lable("filecount");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("fileshop_file");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['file']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("file", $this->Data)){
			$this->setFieldCaption('file_flu',$this->Data['file']->getFieldInfo('file_flu')->getTitle());
			$this->file_flu->setText($this->Data['file']->getFile_flu());
			$this->setFieldCaption('title',$this->Data['file']->getFieldInfo('title')->getTitle());
			$this->title->setText($this->Data['file']->getTitle());
			$this->setFieldCaption('thumbnail_flu',$this->Data['file']->getFieldInfo('thumbnail_flu')->getTitle());
			$this->thumbnail_flu->setText($this->Data['file']->getThumbnail_flu());
			$this->setFieldCaption('add_date',$this->Data['file']->getFieldInfo('add_date')->getTitle());
			$add_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$add_date_Text=$add_date_SD->date("l d F Y",$this->Data['file']->getAdd_date());
			$this->add_date->setText($add_date_Text);
			$this->setFieldCaption('description',$this->Data['file']->getFieldInfo('description')->getTitle());
			$this->description->setText($this->Data['file']->getDescription());
			$this->setFieldCaption('price',$this->Data['file']->getFieldInfo('price')->getTitle());
			$this->price->setText($this->Data['file']->getPrice());
			$this->setFieldCaption('filecount',$this->Data['file']->getFieldInfo('filecount')->getTitle());
			$this->filecount->setText($this->Data['file']->getFilecount());
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->file_flu,$this->getFieldCaption('file_flu')));
		$LTable1->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
		$LTable1->addElement($this->getInfoRowCode($this->thumbnail_flu,$this->getFieldCaption('thumbnail_flu')));
		$LTable1->addElement($this->getInfoRowCode($this->add_date,$this->getFieldCaption('add_date')));
		$LTable1->addElement($this->getInfoRowCode($this->description,$this->getFieldCaption('description')));
		$LTable1->addElement($this->getInfoRowCode($this->price,$this->getFieldCaption('price')));
		$LTable1->addElement($this->getInfoRowCode($this->filecount,$this->getFieldCaption('filecount')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("file", $this->Data)){
			$Result=$this->Data['file']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>