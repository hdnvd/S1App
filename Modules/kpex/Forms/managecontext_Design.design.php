<?php
namespace Modules\kpex\Forms;
use core\CoreClasses\html\TextArea;
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
*@creationDate 1397-03-24 - 2018-06-14 03:29
*@lastUpdate 1397-03-24 - 2018-06-14 03:29
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managecontext_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("kpex_managecontext");
		$Page->addElement($this->getPageTitlePart("تعریف " . $this->Data['context']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->url,$this->getFieldCaption('url'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->content,$this->getFieldCaption('content'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->words,$this->getFieldCaption('words'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->btnSave));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		$form->SetAttribute("novalidate","novalidate");
		$form->SetAttribute("data-toggle","validator");
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{
		if (key_exists("context", $this->Data)){

			/******** url ********/
			$this->url->setValue($this->Data['context']->getUrl());
			$this->setFieldCaption('url',$this->Data['context']->getFieldInfo('url')->getTitle());
			$this->url->setFieldInfo($this->Data['context']->getFieldInfo('url'));

			/******** title ********/
			$this->title->setValue($this->Data['context']->getTitle());
			$this->setFieldCaption('title',$this->Data['context']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['context']->getFieldInfo('title'));

			/******** content ********/
			$this->content->setValue($this->Data['context']->getContent());
			$this->setFieldCaption('content',$this->Data['context']->getFieldInfo('content')->getTitle());
//			$this->content->setFieldInfo($this->Data['context']->getFieldInfo('content'));

			/******** words ********/
			$this->words->setValue($this->Data['context']->getWords());
			$this->setFieldCaption('words',$this->Data['context']->getFieldInfo('words')->getTitle());
			$this->words->setFieldInfo($this->Data['context']->getFieldInfo('words'));

			/******** btnSave ********/
		}
	}
	public function __construct()
	{
		parent::__construct();

		/******* url *******/
		$this->url= new textbox("url");
		$this->url->setClass("form-control");

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* content *******/
		$this->content= new TextArea("content");
		$this->content->setClass("form-control");

		/******* words *******/
		$this->words= new textbox("words");
		$this->words->setClass("form-control");

		/******* btnSave *******/
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
		$this->btnSave->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->btnSave->setClass("btn btn-primary");
	}
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	private $adminMode=true;
    public function getAdminMode()
    {
        return $this->adminMode;
    }
        /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	/** @var textbox */
	private $url;
	/**
	 * @return textbox
	 */
	public function getUrl()
	{
		return $this->url;
	}
	/** @var textbox */
	private $title;
	/**
	 * @return textbox
	 */
	public function getTitle()
	{
		return $this->title;
	}
	/** @var TextArea */
	private $content;
	/**
	 * @return TextArea
	 */
	public function getContent()
	{
		return $this->content;
	}
	/** @var textbox */
	private $words;
	/**
	 * @return textbox
	 */
	public function getWords()
	{
		return $this->words;
	}
	/** @var SweetButton */
	private $btnSave;
    public function getJSON()
    {
       parent::getJSON();
       $Result=['message'=>$this->getMessage(),'messagetype'=>$this->getMessageType()];
       return json_encode($Result);
    }
}
?>