<?php
namespace Modules\iribfinance\Forms;
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
*@creationDate 1396-11-05 - 2018-01-25 18:01
*@lastUpdate 1396-11-05 - 2018-01-25 18:01
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class activity_Design extends FormDesign {
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
	private $paycenter_type;
	/** @var lable */
	private $planingcode;
	/** @var lable */
	private $taxtype_fid;
	/** @var lable */
	private $alalhesab;
	/** @var lable */
	private $isactive;
	public function __construct()
	{

		/******* title *******/
		$this->title= new lable("title");

		/******* paycenter_type *******/
		$this->paycenter_type= new lable("paycenter_type");

		/******* planingcode *******/
		$this->planingcode= new lable("planingcode");

		/******* taxtype_fid *******/
		$this->taxtype_fid= new lable("taxtype_fid");

		/******* alalhesab *******/
		$this->alalhesab= new lable("alalhesab");

		/******* isactive *******/
		$this->isactive= new lable("isactive");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_activity");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['activity']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("activity", $this->Data)){
			$this->setFieldCaption('title',$this->Data['activity']->getFieldInfo('title')->getTitle());
			$this->title->setText($this->Data['activity']->getTitle());
			$this->setFieldCaption('paycenter_type',$this->Data['activity']->getFieldInfo('paycenter_type')->getTitle());
			$this->paycenter_type->setText($this->Data['activity']->getPaycenter_type());
			$this->setFieldCaption('planingcode',$this->Data['activity']->getFieldInfo('planingcode')->getTitle());
			$this->planingcode->setText($this->Data['activity']->getPlaningcode());
			$this->setFieldCaption('taxtype_fid',$this->Data['activity']->getFieldInfo('taxtype_fid')->getTitle());
			$this->taxtype_fid->setText($this->Data['taxtype_fid']->getID());
			$this->setFieldCaption('alalhesab',$this->Data['activity']->getFieldInfo('alalhesab')->getTitle());
			$this->alalhesab->setText($this->Data['activity']->getAlalhesab());
			$this->setFieldCaption('isactive',$this->Data['activity']->getFieldInfo('isactive')->getTitle());
			$isactiveTitle='No';
			if($this->Data['activity']->getIsactive()==1)
				$isactiveTitle='Yes';
			$this->isactive->setText($isactiveTitle);
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
		$LTable1->addElement($this->getInfoRowCode($this->paycenter_type,$this->getFieldCaption('paycenter_type')));
		$LTable1->addElement($this->getInfoRowCode($this->planingcode,$this->getFieldCaption('planingcode')));
		$LTable1->addElement($this->getInfoRowCode($this->taxtype_fid,$this->getFieldCaption('taxtype_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->alalhesab,$this->getFieldCaption('alalhesab')));
		$LTable1->addElement($this->getInfoRowCode($this->isactive,$this->getFieldCaption('isactive')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("activity", $this->Data)){
			$Result=$this->Data['activity']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>