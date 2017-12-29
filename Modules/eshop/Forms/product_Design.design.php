<?php
namespace Modules\eshop\Forms;
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
*@creationDate 1396-08-28 - 2017-11-19 00:39
*@lastUpdate 1396-08-28 - 2017-11-19 00:39
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class product_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $title;
	/** @var lable */
	private $latintitle;
	/** @var lable */
	private $description;
	/** @var lable */
	private $pic1_flu;
	/** @var lable */
	private $pic2_flu;
	/** @var lable */
	private $pic3_flu;
	/** @var lable */
	private $pic4_flu;
	/** @var lable */
	private $price;
	/** @var lable */
	private $code;
	/** @var lable */
	private $adddate;
	/** @var lable */
	private $visitcount;
	/** @var lable */
	private $is_exists;
	public function __construct()
	{

		/******* title *******/
		$this->title= new lable("title");

		/******* latintitle *******/
		$this->latintitle= new lable("latintitle");

		/******* description *******/
		$this->description= new lable("description");

		/******* pic1_flu *******/
		$this->pic1_flu= new lable("pic1_flu");

		/******* pic2_flu *******/
		$this->pic2_flu= new lable("pic2_flu");

		/******* pic3_flu *******/
		$this->pic3_flu= new lable("pic3_flu");

		/******* pic4_flu *******/
		$this->pic4_flu= new lable("pic4_flu");

		/******* price *******/
		$this->price= new lable("price");

		/******* code *******/
		$this->code= new lable("code");

		/******* adddate *******/
		$this->adddate= new lable("adddate");

		/******* visitcount *******/
		$this->visitcount= new lable("visitcount");

		/******* is_exists *******/
		$this->is_exists= new lable("is_exists");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("eshop_product");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['product']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("product", $this->Data)){
			$this->setFieldCaption('title',$this->Data['product']->getFieldInfo('title')->getTitle());
			$this->title->setText($this->Data['product']->getTitle());
			$this->setFieldCaption('latintitle',$this->Data['product']->getFieldInfo('latintitle')->getTitle());
			$this->latintitle->setText($this->Data['product']->getLatintitle());
			$this->setFieldCaption('description',$this->Data['product']->getFieldInfo('description')->getTitle());
			$this->description->setText($this->Data['product']->getDescription());
			$this->setFieldCaption('pic1_flu',$this->Data['product']->getFieldInfo('pic1_flu')->getTitle());
			$this->pic1_flu->setText($this->Data['product']->getPic1_flu());
			$this->setFieldCaption('pic2_flu',$this->Data['product']->getFieldInfo('pic2_flu')->getTitle());
			$this->pic2_flu->setText($this->Data['product']->getPic2_flu());
			$this->setFieldCaption('pic3_flu',$this->Data['product']->getFieldInfo('pic3_flu')->getTitle());
			$this->pic3_flu->setText($this->Data['product']->getPic3_flu());
			$this->setFieldCaption('pic4_flu',$this->Data['product']->getFieldInfo('pic4_flu')->getTitle());
			$this->pic4_flu->setText($this->Data['product']->getPic4_flu());
			$this->setFieldCaption('price',$this->Data['product']->getFieldInfo('price')->getTitle());
			$this->price->setText($this->Data['product']->getPrice());
			$this->setFieldCaption('code',$this->Data['product']->getFieldInfo('code')->getTitle());
			$this->code->setText($this->Data['product']->getCode());
			$this->setFieldCaption('adddate',$this->Data['product']->getFieldInfo('adddate')->getTitle());
			$this->adddate->setText($this->Data['product']->getAdddate());
			$this->setFieldCaption('visitcount',$this->Data['product']->getFieldInfo('visitcount')->getTitle());
			$this->visitcount->setText($this->Data['product']->getVisitcount());
			$this->setFieldCaption('is_exists',$this->Data['product']->getFieldInfo('is_exists')->getTitle());
			$is_existsTitle='No';
			if($this->Data['product']->getIs_exists()==1)
				$is_existsTitle='Yes';
			$this->is_exists->setText($is_existsTitle);
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
		$LTable1->addElement($this->getInfoRowCode($this->latintitle,$this->getFieldCaption('latintitle')));
		$LTable1->addElement($this->getInfoRowCode($this->description,$this->getFieldCaption('description')));
		$LTable1->addElement($this->getInfoRowCode($this->pic1_flu,$this->getFieldCaption('pic1_flu')));
		$LTable1->addElement($this->getInfoRowCode($this->pic2_flu,$this->getFieldCaption('pic2_flu')));
		$LTable1->addElement($this->getInfoRowCode($this->pic3_flu,$this->getFieldCaption('pic3_flu')));
		$LTable1->addElement($this->getInfoRowCode($this->pic4_flu,$this->getFieldCaption('pic4_flu')));
		$LTable1->addElement($this->getInfoRowCode($this->price,$this->getFieldCaption('price')));
		$LTable1->addElement($this->getInfoRowCode($this->code,$this->getFieldCaption('code')));
		$LTable1->addElement($this->getInfoRowCode($this->adddate,$this->getFieldCaption('adddate')));
		$LTable1->addElement($this->getInfoRowCode($this->visitcount,$this->getFieldCaption('visitcount')));
		$LTable1->addElement($this->getInfoRowCode($this->is_exists,$this->getFieldCaption('is_exists')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("product", $this->Data)){
			$Result=$this->Data['product']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>