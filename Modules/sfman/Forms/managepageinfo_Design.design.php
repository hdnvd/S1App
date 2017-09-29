<?php
namespace Modules\sfman\Forms;
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
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\RadioBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-07 - 2017-09-29 14:25
*@lastUpdate 1396-07-07 - 2017-09-29 14:25
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managepageinfo_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("sfman_managepageinfo");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("مدیریت " . $this->Data['pageinfo']->getTableTitle() . ""));
		$Page->addElement($PageTitlePart);
		if($this->getMessage()!=""){
			$MessagePart=new Div();
			if($this->getMessageType()==MessageType::$ERROR)
				$MessagePart->setClass("sweet_messagepart alert alert-danger");
			else
				$MessagePart->setClass("sweet_messagepart alert alert-success");
			$MessagePart->addElement(new Lable($this->getMessage()));
			$Page->addElement($MessagePart);
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,''));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,''));
		$LTable1->addElement($this->getFieldRowCode($this->keywords,$this->getFieldCaption('keywords'),null,''));
		$LTable1->addElement($this->getFieldRowCode($this->themepage,$this->getFieldCaption('themepage'),null,''));
		$LTable1->addElement($this->getFieldRowCode($this->internalurl,$this->getFieldCaption('internalurl'),null,''));
		$LTable1->addElement($this->getFieldRowCode($this->canonicalurl,$this->getFieldCaption('canonicalurl'),null,''));
		$LTable1->addElement($this->getFieldRowCode($this->sentenceinurl,$this->getFieldCaption('sentenceinurl'),null,''));
		$LTable1->addElement($this->getSingleFieldRowCode($this->btnSave));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		$form->SetAttribute("novalidate","novalidate");
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{

			/******** title ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->title->setValue($this->Data['pageinfo']->getTitle());
			$this->FieldCaptions['title']=$this->Data['pageinfo']->getFieldInfo('title')->getTitle();
			$this->title->setFieldInfo($this->Data['pageinfo']->getFieldInfo('title'));
		}

			/******** description ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->description->setValue($this->Data['pageinfo']->getDescription());
			$this->FieldCaptions['description']=$this->Data['pageinfo']->getFieldInfo('description')->getTitle();
			$this->description->setFieldInfo($this->Data['pageinfo']->getFieldInfo('description'));
		}

			/******** keywords ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->keywords->setValue($this->Data['pageinfo']->getKeywords());
			$this->FieldCaptions['keywords']=$this->Data['pageinfo']->getFieldInfo('keywords')->getTitle();
			$this->keywords->setFieldInfo($this->Data['pageinfo']->getFieldInfo('keywords'));
		}

			/******** themepage ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->themepage->setValue($this->Data['pageinfo']->getThemepage());
			$this->FieldCaptions['themepage']=$this->Data['pageinfo']->getFieldInfo('themepage')->getTitle();
			$this->themepage->setFieldInfo($this->Data['pageinfo']->getFieldInfo('themepage'));
		}

			/******** internalurl ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->internalurl->setValue($this->Data['pageinfo']->getInternalurl());
			$this->FieldCaptions['internalurl']=$this->Data['pageinfo']->getFieldInfo('internalurl')->getTitle();
			$this->internalurl->setFieldInfo($this->Data['pageinfo']->getFieldInfo('internalurl'));
		}

			/******** canonicalurl ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->canonicalurl->setValue($this->Data['pageinfo']->getCanonicalurl());
			$this->FieldCaptions['canonicalurl']=$this->Data['pageinfo']->getFieldInfo('canonicalurl')->getTitle();
			$this->canonicalurl->setFieldInfo($this->Data['pageinfo']->getFieldInfo('canonicalurl'));
		}

			/******** sentenceinurl ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->sentenceinurl->setValue($this->Data['pageinfo']->getSentenceinurl());
			$this->FieldCaptions['sentenceinurl']=$this->Data['pageinfo']->getFieldInfo('sentenceinurl')->getTitle();
			$this->sentenceinurl->setFieldInfo($this->Data['pageinfo']->getFieldInfo('sentenceinurl'));
		}

			/******** btnSave ********/
	}
	public function __construct()
	{
		$this->FieldCaptions=array();

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* description *******/
		$this->description= new textbox("description");
		$this->description->setClass("form-control");

		/******* keywords *******/
		$this->keywords= new textbox("keywords");
		$this->keywords->setClass("form-control");

		/******* themepage *******/
		$this->themepage= new textbox("themepage");
		$this->themepage->setClass("form-control");

		/******* internalurl *******/
		$this->internalurl= new textbox("internalurl");
		$this->internalurl->setClass("form-control");

		/******* canonicalurl *******/
		$this->canonicalurl= new textbox("canonicalurl");
		$this->canonicalurl->setClass("form-control");

		/******* sentenceinurl *******/
		$this->sentenceinurl= new textbox("sentenceinurl");
		$this->sentenceinurl->setClass("form-control");

		/******* btnSave *******/
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
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
	private $FieldCaptions;    
private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
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
	/** @var textbox */
	private $description;
	/**
	 * @return textbox
	 */
	public function getDescription()
	{
		return $this->description;
	}
	/** @var textbox */
	private $keywords;
	/**
	 * @return textbox
	 */
	public function getKeywords()
	{
		return $this->keywords;
	}
	/** @var textbox */
	private $themepage;
	/**
	 * @return textbox
	 */
	public function getThemepage()
	{
		return $this->themepage;
	}
	/** @var textbox */
	private $internalurl;
	/**
	 * @return textbox
	 */
	public function getInternalurl()
	{
		return $this->internalurl;
	}
	/** @var textbox */
	private $canonicalurl;
	/**
	 * @return textbox
	 */
	public function getCanonicalurl()
	{
		return $this->canonicalurl;
	}
	/** @var textbox */
	private $sentenceinurl;
	/**
	 * @return textbox
	 */
	public function getSentenceinurl()
	{
		return $this->sentenceinurl;
	}
	/** @var SweetButton */
	private $btnSave;        


        private function getFieldRowCode($Field,$Title,$PlaceHolder,$InvalidMessage=null)
        {
            if($PlaceHolder==null)
                $PlaceHolder=$Title;
        
            $Group=new Div();
            $Group->setClass('form-group');
            $lblTitle=new FormLabel($Title);
            $lblTitle->SetAttribute("for",$Field->getId());
            $lblTitle->SetClass('control-label col-sm-2');
            $Group->addElement($lblTitle);
            $TitleField=new Div();
            $TitleField->setClass('col-sm-10');
            $Field->SetAttribute('placeholder',$PlaceHolder);
            $TitleField->addElement($Field);
            if($InvalidMessage!=null){
                $InvalidFeedBackDiv=new Div();
                $InvalidFeedBackDiv->setClass('invalid-feedback');
                $InvalidFeedBackDiv->addElement(new Lable($InvalidMessage));
                $TitleField->addElement($InvalidFeedBackDiv);
            }
            $Group->addElement($TitleField);
            return $Group;
        }
        private function getSingleFieldRowCode($Field)
        {
            $Group=new Div();
            $Group->setClass('form-group');
            $FieldDiv=new Div();
            $FieldDiv->setClass('col-sm-offset-2 col-sm-10');
            $FieldDiv->addElement($Field);
            $Group->addElement($FieldDiv);
            return $Group;
       }
        private function getFieldCaption($FieldName)
        {
            if(key_exists($FieldName,$this->FieldCaptions))
                return $this->FieldCaptions[$FieldName];
            else
                return $FieldName;
       }
}
?>