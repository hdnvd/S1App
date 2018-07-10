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
class manageuser_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("users_manageuser");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['user']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->name,$this->getFieldCaption('name'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->family,$this->getFieldCaption('family'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->mail,$this->getFieldCaption('mail'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->mobile,$this->getFieldCaption('mobile'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->ismale,$this->getFieldCaption('ismale'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->profilepicture,$this->getFieldCaption('profilepicture'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield1,$this->getFieldCaption('additionalfield1'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield2,$this->getFieldCaption('additionalfield2'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield3,$this->getFieldCaption('additionalfield3'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield4,$this->getFieldCaption('additionalfield4'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield5,$this->getFieldCaption('additionalfield5'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield6,$this->getFieldCaption('additionalfield6'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield7,$this->getFieldCaption('additionalfield7'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield8,$this->getFieldCaption('additionalfield8'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->additionalfield9,$this->getFieldCaption('additionalfield9'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
		$LTable1->addElement($this->getFieldRowCode($this->signup_time,$this->getFieldCaption('signup_time'),null,'لطفا این فیلد را به طور صحیح وارد کنید',null));
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
			$this->ismale->addOption(1,'مرد');
			$this->ismale->addOption(0,'زن');
		if (key_exists("user", $this->Data)){

			/******** name ********/
			$this->name->setValue($this->Data['user']->getName());
			$this->setFieldCaption('name',$this->Data['user']->getFieldInfo('name')->getTitle());
			$this->name->setFieldInfo($this->Data['user']->getFieldInfo('name'));

			/******** family ********/
			$this->family->setValue($this->Data['user']->getFamily());
			$this->setFieldCaption('family',$this->Data['user']->getFieldInfo('family')->getTitle());
			$this->family->setFieldInfo($this->Data['user']->getFieldInfo('family'));

			/******** mail ********/
			$this->mail->setValue($this->Data['user']->getMail());
			$this->setFieldCaption('mail',$this->Data['user']->getFieldInfo('mail')->getTitle());
			$this->mail->setFieldInfo($this->Data['user']->getFieldInfo('mail'));

			/******** mobile ********/
			$this->mobile->setValue($this->Data['user']->getMobile());
			$this->setFieldCaption('mobile',$this->Data['user']->getFieldInfo('mobile')->getTitle());
			$this->mobile->setFieldInfo($this->Data['user']->getFieldInfo('mobile'));

			/******** ismale ********/
			$this->ismale->setSelectedValue($this->Data['user']->getIsmale());
			$this->setFieldCaption('ismale',$this->Data['user']->getFieldInfo('ismale')->getTitle());

			/******** profilepicture ********/
			$this->profilepicture->setValue($this->Data['user']->getProfilepicture());
			$this->setFieldCaption('profilepicture',$this->Data['user']->getFieldInfo('profilepicture')->getTitle());
			$this->profilepicture->setFieldInfo($this->Data['user']->getFieldInfo('profilepicture'));

			/******** additionalfield1 ********/
			$this->additionalfield1->setValue($this->Data['user']->getAdditionalfield1());
			$this->setFieldCaption('additionalfield1',$this->Data['user']->getFieldInfo('additionalfield1')->getTitle());
			$this->additionalfield1->setFieldInfo($this->Data['user']->getFieldInfo('additionalfield1'));

			/******** additionalfield2 ********/
			$this->additionalfield2->setValue($this->Data['user']->getAdditionalfield2());
			$this->setFieldCaption('additionalfield2',$this->Data['user']->getFieldInfo('additionalfield2')->getTitle());
			$this->additionalfield2->setFieldInfo($this->Data['user']->getFieldInfo('additionalfield2'));

			/******** additionalfield3 ********/
			$this->additionalfield3->setValue($this->Data['user']->getAdditionalfield3());
			$this->setFieldCaption('additionalfield3',$this->Data['user']->getFieldInfo('additionalfield3')->getTitle());
			$this->additionalfield3->setFieldInfo($this->Data['user']->getFieldInfo('additionalfield3'));

			/******** additionalfield4 ********/
			$this->additionalfield4->setValue($this->Data['user']->getAdditionalfield4());
			$this->setFieldCaption('additionalfield4',$this->Data['user']->getFieldInfo('additionalfield4')->getTitle());
			$this->additionalfield4->setFieldInfo($this->Data['user']->getFieldInfo('additionalfield4'));

			/******** additionalfield5 ********/
			$this->additionalfield5->setValue($this->Data['user']->getAdditionalfield5());
			$this->setFieldCaption('additionalfield5',$this->Data['user']->getFieldInfo('additionalfield5')->getTitle());
			$this->additionalfield5->setFieldInfo($this->Data['user']->getFieldInfo('additionalfield5'));

			/******** additionalfield6 ********/
			$this->additionalfield6->setValue($this->Data['user']->getAdditionalfield6());
			$this->setFieldCaption('additionalfield6',$this->Data['user']->getFieldInfo('additionalfield6')->getTitle());
			$this->additionalfield6->setFieldInfo($this->Data['user']->getFieldInfo('additionalfield6'));

			/******** additionalfield7 ********/
			$this->additionalfield7->setValue($this->Data['user']->getAdditionalfield7());
			$this->setFieldCaption('additionalfield7',$this->Data['user']->getFieldInfo('additionalfield7')->getTitle());
			$this->additionalfield7->setFieldInfo($this->Data['user']->getFieldInfo('additionalfield7'));

			/******** additionalfield8 ********/
			$this->additionalfield8->setValue($this->Data['user']->getAdditionalfield8());
			$this->setFieldCaption('additionalfield8',$this->Data['user']->getFieldInfo('additionalfield8')->getTitle());
			$this->additionalfield8->setFieldInfo($this->Data['user']->getFieldInfo('additionalfield8'));

			/******** additionalfield9 ********/
			$this->additionalfield9->setValue($this->Data['user']->getAdditionalfield9());
			$this->setFieldCaption('additionalfield9',$this->Data['user']->getFieldInfo('additionalfield9')->getTitle());
			$this->additionalfield9->setFieldInfo($this->Data['user']->getFieldInfo('additionalfield9'));

			/******** signup_time ********/
			$this->signup_time->setTime($this->Data['user']->getSignup_time());
			$this->setFieldCaption('signup_time',$this->Data['user']->getFieldInfo('signup_time')->getTitle());
			$this->signup_time->setFieldInfo($this->Data['user']->getFieldInfo('signup_time'));

			/******** btnSave ********/
		}
	}
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

		/******* signup_time *******/
		$this->signup_time= new DatePicker("signup_time");
		$this->signup_time->setClass("form-control");

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
	private $signup_time;
	/**
	 * @return DatePicker
	 */
	public function getSignup_time()
	{
		return $this->signup_time;
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