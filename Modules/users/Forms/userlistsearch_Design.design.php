<?php
namespace Modules\users\Forms;
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
*@creationDate 1396-11-15 - 2018-02-04 12:42
*@lastUpdate 1396-11-15 - 2018-02-04 12:42
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class userlistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $name;
	/**
	 * @return textbox
	 */
	public function getName()
	{
		return $this->name;
	}
	/** @var textbox */
	private $family;
	/**
	 * @return textbox
	 */
	public function getFamily()
	{
		return $this->family;
	}
	/** @var textbox */
	private $mail;
	/**
	 * @return textbox
	 */
	public function getMail()
	{
		return $this->mail;
	}
	/** @var textbox */
	private $mobile;
	/**
	 * @return textbox
	 */
	public function getMobile()
	{
		return $this->mobile;
	}
	/** @var combobox */
	private $ismale;
	/**
	 * @return combobox
	 */
	public function getIsmale()
	{
		return $this->ismale;
	}
	/** @var textbox */
	private $profilepicture;
	/**
	 * @return textbox
	 */
	public function getProfilepicture()
	{
		return $this->profilepicture;
	}
	/** @var textbox */
	private $additionalfield1;
	/**
	 * @return textbox
	 */
	public function getAdditionalfield1()
	{
		return $this->additionalfield1;
	}
	/** @var textbox */
	private $additionalfield2;
	/**
	 * @return textbox
	 */
	public function getAdditionalfield2()
	{
		return $this->additionalfield2;
	}
	/** @var textbox */
	private $additionalfield3;
	/**
	 * @return textbox
	 */
	public function getAdditionalfield3()
	{
		return $this->additionalfield3;
	}
	/** @var textbox */
	private $additionalfield4;
	/**
	 * @return textbox
	 */
	public function getAdditionalfield4()
	{
		return $this->additionalfield4;
	}
	/** @var textbox */
	private $additionalfield5;
	/**
	 * @return textbox
	 */
	public function getAdditionalfield5()
	{
		return $this->additionalfield5;
	}
	/** @var textbox */
	private $additionalfield6;
	/**
	 * @return textbox
	 */
	public function getAdditionalfield6()
	{
		return $this->additionalfield6;
	}
	/** @var textbox */
	private $additionalfield7;
	/**
	 * @return textbox
	 */
	public function getAdditionalfield7()
	{
		return $this->additionalfield7;
	}
	/** @var textbox */
	private $additionalfield8;
	/**
	 * @return textbox
	 */
	public function getAdditionalfield8()
	{
		return $this->additionalfield8;
	}
	/** @var textbox */
	private $additionalfield9;
	/**
	 * @return textbox
	 */
	public function getAdditionalfield9()
	{
		return $this->additionalfield9;
	}
	/** @var DatePicker */
	private $signup_time_from;
	/**
	 * @return DatePicker
	 */
	public function getSignup_time_from()
	{
		return $this->signup_time_from;
	}
	/** @var DatePicker */
	private $signup_time_to;
	/**
	 * @return DatePicker
	 */
	public function getSignup_time_to()
	{
		return $this->signup_time_to;
	}
	/** @var combobox */
	private $sortby;
	/**
	 * @return combobox
	 */
	public function getSortby()
	{
		return $this->sortby;
	}
	/** @var combobox */
	private $isdesc;
	/**
	 * @return combobox
	 */
	public function getIsdesc()
	{
		return $this->isdesc;
	}
	/** @var SweetButton */
	private $search;
	public function __construct()
	{
		parent::__construct();

		/******* name *******/
		$this->name= new textbox("name");
		$this->name->setClass("form-control");

		/******* family *******/
		$this->family= new textbox("family");
		$this->family->setClass("form-control");

		/******* mail *******/
		$this->mail= new textbox("mail");
		$this->mail->setClass("form-control");

		/******* mobile *******/
		$this->mobile= new textbox("mobile");
		$this->mobile->setClass("form-control");

		/******* ismale *******/
		$this->ismale= new combobox("ismale");
		$this->ismale->setClass("form-control");

		/******* profilepicture *******/
		$this->profilepicture= new textbox("profilepicture");
		$this->profilepicture->setClass("form-control");

		/******* additionalfield1 *******/
		$this->additionalfield1= new textbox("additionalfield1");
		$this->additionalfield1->setClass("form-control");

		/******* additionalfield2 *******/
		$this->additionalfield2= new textbox("additionalfield2");
		$this->additionalfield2->setClass("form-control");

		/******* additionalfield3 *******/
		$this->additionalfield3= new textbox("additionalfield3");
		$this->additionalfield3->setClass("form-control");

		/******* additionalfield4 *******/
		$this->additionalfield4= new textbox("additionalfield4");
		$this->additionalfield4->setClass("form-control");

		/******* additionalfield5 *******/
		$this->additionalfield5= new textbox("additionalfield5");
		$this->additionalfield5->setClass("form-control");

		/******* additionalfield6 *******/
		$this->additionalfield6= new textbox("additionalfield6");
		$this->additionalfield6->setClass("form-control");

		/******* additionalfield7 *******/
		$this->additionalfield7= new textbox("additionalfield7");
		$this->additionalfield7->setClass("form-control");

		/******* additionalfield8 *******/
		$this->additionalfield8= new textbox("additionalfield8");
		$this->additionalfield8->setClass("form-control");

		/******* additionalfield9 *******/
		$this->additionalfield9= new textbox("additionalfield9");
		$this->additionalfield9->setClass("form-control");

		/******* signup_time_from *******/
		$this->signup_time_from= new DatePicker("signup_time_from");
		$this->signup_time_from->setClass("form-control");

		/******* signup_time_to *******/
		$this->signup_time_to= new DatePicker("signup_time_to");
		$this->signup_time_to->setClass("form-control");

		/******* sortby *******/
		$this->sortby= new combobox("sortby");
		$this->sortby->setClass("form-control");

		/******* isdesc *******/
		$this->isdesc= new combobox("isdesc");
		$this->isdesc->setClass("form-control");

		/******* search *******/
		$this->search= new SweetButton(true,"جستجو");
		$this->search->setAction("search");
		$this->search->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->search->setClass("btn btn-primary");
	}
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("users_userlist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['user']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->mail,$this->getFieldCaption('mail'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->mobile,$this->getFieldCaption('mobile'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismale,$this->getFieldCaption('ismale'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->profilepicture,$this->getFieldCaption('profilepicture'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield1,$this->getFieldCaption('additionalfield1'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield2,$this->getFieldCaption('additionalfield2'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield3,$this->getFieldCaption('additionalfield3'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield4,$this->getFieldCaption('additionalfield4'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield5,$this->getFieldCaption('additionalfield5'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield6,$this->getFieldCaption('additionalfield6'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield7,$this->getFieldCaption('additionalfield7'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield8,$this->getFieldCaption('additionalfield8'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield9,$this->getFieldCaption('additionalfield9'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->signup_time_from,$this->getFieldCaption('signup_time_from'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->signup_time_to,$this->getFieldCaption('signup_time_to'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->sortby,$this->getFieldCaption('sortby'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isdesc,$this->getFieldCaption('isdesc'),null,'',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->search));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{
			$this->ismale->addOption("", "مهم نیست");
			$this->ismale->addOption(1,'مرد');
			$this->ismale->addOption(0,'زن');
		if (key_exists("user", $this->Data)){

			/******** name ********/
			$this->name->setValue($this->Data['user']->getName());
			$this->setFieldCaption('name',$this->Data['user']->getFieldInfo('name')->getTitle());

			/******** family ********/
			$this->family->setValue($this->Data['user']->getFamily());
			$this->setFieldCaption('family',$this->Data['user']->getFieldInfo('family')->getTitle());

			/******** mail ********/
			$this->mail->setValue($this->Data['user']->getMail());
			$this->setFieldCaption('mail',$this->Data['user']->getFieldInfo('mail')->getTitle());

			/******** mobile ********/
			$this->mobile->setValue($this->Data['user']->getMobile());
			$this->setFieldCaption('mobile',$this->Data['user']->getFieldInfo('mobile')->getTitle());

			/******** ismale ********/
			$this->ismale->setSelectedValue($this->Data['user']->getIsmale());
			$this->setFieldCaption('ismale',$this->Data['user']->getFieldInfo('ismale')->getTitle());

			/******** profilepicture ********/
			$this->profilepicture->setValue($this->Data['user']->getProfilepicture());
			$this->setFieldCaption('profilepicture',$this->Data['user']->getFieldInfo('profilepicture')->getTitle());

			/******** additionalfield1 ********/
			$this->additionalfield1->setValue($this->Data['user']->getAdditionalfield1());
			$this->setFieldCaption('additionalfield1',$this->Data['user']->getFieldInfo('additionalfield1')->getTitle());

			/******** additionalfield2 ********/
			$this->additionalfield2->setValue($this->Data['user']->getAdditionalfield2());
			$this->setFieldCaption('additionalfield2',$this->Data['user']->getFieldInfo('additionalfield2')->getTitle());

			/******** additionalfield3 ********/
			$this->additionalfield3->setValue($this->Data['user']->getAdditionalfield3());
			$this->setFieldCaption('additionalfield3',$this->Data['user']->getFieldInfo('additionalfield3')->getTitle());

			/******** additionalfield4 ********/
			$this->additionalfield4->setValue($this->Data['user']->getAdditionalfield4());
			$this->setFieldCaption('additionalfield4',$this->Data['user']->getFieldInfo('additionalfield4')->getTitle());

			/******** additionalfield5 ********/
			$this->additionalfield5->setValue($this->Data['user']->getAdditionalfield5());
			$this->setFieldCaption('additionalfield5',$this->Data['user']->getFieldInfo('additionalfield5')->getTitle());

			/******** additionalfield6 ********/
			$this->additionalfield6->setValue($this->Data['user']->getAdditionalfield6());
			$this->setFieldCaption('additionalfield6',$this->Data['user']->getFieldInfo('additionalfield6')->getTitle());

			/******** additionalfield7 ********/
			$this->additionalfield7->setValue($this->Data['user']->getAdditionalfield7());
			$this->setFieldCaption('additionalfield7',$this->Data['user']->getFieldInfo('additionalfield7')->getTitle());

			/******** additionalfield8 ********/
			$this->additionalfield8->setValue($this->Data['user']->getAdditionalfield8());
			$this->setFieldCaption('additionalfield8',$this->Data['user']->getFieldInfo('additionalfield8')->getTitle());

			/******** additionalfield9 ********/
			$this->additionalfield9->setValue($this->Data['user']->getAdditionalfield9());
			$this->setFieldCaption('additionalfield9',$this->Data['user']->getFieldInfo('additionalfield9')->getTitle());

			/******** signup_time_from ********/
			$this->signup_time_from->setTime($this->Data['user']->getSignup_time_from());
			$this->setFieldCaption('signup_time_from',$this->Data['user']->getFieldInfo('signup_time_from')->getTitle());

			/******** signup_time_to ********/
			$this->signup_time_to->setTime($this->Data['user']->getSignup_time_to());
			$this->setFieldCaption('signup_time_to',$this->Data['user']->getFieldInfo('signup_time_to')->getTitle());
			$this->setFieldCaption('signup_time',$this->Data['user']->getFieldInfo('signup_time')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** name ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('name'),$this->getFieldCaption('name'));
		if(isset($_GET['name']))
			$this->name->setValue($_GET['name']);

		/******** family ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('family'),$this->getFieldCaption('family'));
		if(isset($_GET['family']))
			$this->family->setValue($_GET['family']);

		/******** mail ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('mail'),$this->getFieldCaption('mail'));
		if(isset($_GET['mail']))
			$this->mail->setValue($_GET['mail']);

		/******** mobile ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('mobile'),$this->getFieldCaption('mobile'));
		if(isset($_GET['mobile']))
			$this->mobile->setValue($_GET['mobile']);

		/******** ismale ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('ismale'),$this->getFieldCaption('ismale'));
		if(isset($_GET['ismale']))
			$this->ismale->setSelectedValue($_GET['ismale']);

		/******** profilepicture ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('profilepicture'),$this->getFieldCaption('profilepicture'));
		if(isset($_GET['profilepicture']))
			$this->profilepicture->setValue($_GET['profilepicture']);

		/******** additionalfield1 ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('additionalfield1'),$this->getFieldCaption('additionalfield1'));
		if(isset($_GET['additionalfield1']))
			$this->additionalfield1->setValue($_GET['additionalfield1']);

		/******** additionalfield2 ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('additionalfield2'),$this->getFieldCaption('additionalfield2'));
		if(isset($_GET['additionalfield2']))
			$this->additionalfield2->setValue($_GET['additionalfield2']);

		/******** additionalfield3 ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('additionalfield3'),$this->getFieldCaption('additionalfield3'));
		if(isset($_GET['additionalfield3']))
			$this->additionalfield3->setValue($_GET['additionalfield3']);

		/******** additionalfield4 ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('additionalfield4'),$this->getFieldCaption('additionalfield4'));
		if(isset($_GET['additionalfield4']))
			$this->additionalfield4->setValue($_GET['additionalfield4']);

		/******** additionalfield5 ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('additionalfield5'),$this->getFieldCaption('additionalfield5'));
		if(isset($_GET['additionalfield5']))
			$this->additionalfield5->setValue($_GET['additionalfield5']);

		/******** additionalfield6 ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('additionalfield6'),$this->getFieldCaption('additionalfield6'));
		if(isset($_GET['additionalfield6']))
			$this->additionalfield6->setValue($_GET['additionalfield6']);

		/******** additionalfield7 ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('additionalfield7'),$this->getFieldCaption('additionalfield7'));
		if(isset($_GET['additionalfield7']))
			$this->additionalfield7->setValue($_GET['additionalfield7']);

		/******** additionalfield8 ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('additionalfield8'),$this->getFieldCaption('additionalfield8'));
		if(isset($_GET['additionalfield8']))
			$this->additionalfield8->setValue($_GET['additionalfield8']);

		/******** additionalfield9 ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('additionalfield9'),$this->getFieldCaption('additionalfield9'));
		if(isset($_GET['additionalfield9']))
			$this->additionalfield9->setValue($_GET['additionalfield9']);

		/******** signup_time_from ********/

		/******** signup_time_to ********/
		$this->sortby->addOption($this->Data['user']->getTableFieldID('signup_time'),$this->getFieldCaption('signup_time'));

		/******** sortby ********/
		if(isset($_GET['sortby']))
			$this->sortby->setSelectedValue($_GET['sortby']);

		/******** isdesc ********/
		if(isset($_GET['isdesc']))
			$this->isdesc->setSelectedValue($_GET['isdesc']);

		/******** search ********/
	}
}
?>