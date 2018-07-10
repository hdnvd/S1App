<?php
namespace Modules\shift\Forms;
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
*@creationDate 1396-10-27 - 2018-01-17 15:25
*@lastUpdate 1396-10-27 - 2018-01-17 15:25
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class personel_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $childcount;
	/** @var lable */
	private $address;
	/** @var lable */
	private $fathername;
	/** @var lable */
	private $priority;
	/** @var lable */
	private $employment_date;
	/** @var lable */
	private $personelcode;
	/** @var lable */
	private $sanavat;
	/** @var lable */
	private $shhesab;
	/** @var lable */
	private $bakhsh_fid;
	/** @var lable */
	private $madrak_fid;
	/** @var lable */
	private $name;
	/** @var lable */
	private $family;
	/** @var lable */
	private $tel;
	/** @var lable */
	private $born_date;
	/** @var lable */
	private $is_male;
	/** @var lable */
	private $extrasanavat;
	/** @var lable */
	private $monthsanavat;
	/** @var lable */
	private $eshteghal_fid;
	/** @var lable */
	private $zarib;
	/** @var lable */
	private $semat_fid;
	/** @var lable */
	private $shsh;
	/** @var lable */
	private $computercode;
	/** @var lable */
	private $mellicode;
	/** @var lable */
	private $is_married;
	public function __construct()
	{

		/******* childcount *******/
		$this->childcount= new lable("childcount");

		/******* address *******/
		$this->address= new lable("address");

		/******* fathername *******/
		$this->fathername= new lable("fathername");

		/******* priority *******/
		$this->priority= new lable("priority");

		/******* employment_date *******/
		$this->employment_date= new lable("employment_date");

		/******* personelcode *******/
		$this->personelcode= new lable("personelcode");

		/******* sanavat *******/
		$this->sanavat= new lable("sanavat");

		/******* shhesab *******/
		$this->shhesab= new lable("shhesab");

		/******* bakhsh_fid *******/
		$this->bakhsh_fid= new lable("bakhsh_fid");

		/******* madrak_fid *******/
		$this->madrak_fid= new lable("madrak_fid");

		/******* name *******/
		$this->name= new lable("name");

		/******* family *******/
		$this->family= new lable("family");

		/******* tel *******/
		$this->tel= new lable("tel");

		/******* born_date *******/
		$this->born_date= new lable("born_date");

		/******* is_male *******/
		$this->is_male= new lable("is_male");

		/******* extrasanavat *******/
		$this->extrasanavat= new lable("extrasanavat");

		/******* monthsanavat *******/
		$this->monthsanavat= new lable("monthsanavat");

		/******* eshteghal_fid *******/
		$this->eshteghal_fid= new lable("eshteghal_fid");

		/******* zarib *******/
		$this->zarib= new lable("zarib");

		/******* semat_fid *******/
		$this->semat_fid= new lable("semat_fid");

		/******* shsh *******/
		$this->shsh= new lable("shsh");

		/******* computercode *******/
		$this->computercode= new lable("computercode");

		/******* mellicode *******/
		$this->mellicode= new lable("mellicode");

		/******* is_married *******/
		$this->is_married= new lable("is_married");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_personel");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['personel']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("personel", $this->Data)){
			$this->setFieldCaption('childcount',$this->Data['personel']->getFieldInfo('childcount')->getTitle());
			$this->childcount->setText($this->Data['personel']->getChildcount());
			$this->setFieldCaption('address',$this->Data['personel']->getFieldInfo('address')->getTitle());
			$this->address->setText($this->Data['personel']->getAddress());
			$this->setFieldCaption('fathername',$this->Data['personel']->getFieldInfo('fathername')->getTitle());
			$this->fathername->setText($this->Data['personel']->getFathername());
			$this->setFieldCaption('priority',$this->Data['personel']->getFieldInfo('priority')->getTitle());
			$this->priority->setText($this->Data['personel']->getPriority());
			$this->setFieldCaption('employment_date',$this->Data['personel']->getFieldInfo('employment_date')->getTitle());
			$employment_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$employment_date_Text=$employment_date_SD->date("l d F Y",$this->Data['personel']->getEmployment_date());
			$this->employment_date->setText($employment_date_Text);
			$this->setFieldCaption('personelcode',$this->Data['personel']->getFieldInfo('personelcode')->getTitle());
			$this->personelcode->setText($this->Data['personel']->getPersonelcode());
			$this->setFieldCaption('sanavat',$this->Data['personel']->getFieldInfo('sanavat')->getTitle());
			$this->sanavat->setText($this->Data['personel']->getSanavat());
			$this->setFieldCaption('shhesab',$this->Data['personel']->getFieldInfo('shhesab')->getTitle());
			$this->shhesab->setText($this->Data['personel']->getShhesab());
			$this->setFieldCaption('bakhsh_fid',$this->Data['personel']->getFieldInfo('bakhsh_fid')->getTitle());
			$this->bakhsh_fid->setText($this->Data['bakhsh_fid']->getID());
			$this->setFieldCaption('madrak_fid',$this->Data['personel']->getFieldInfo('madrak_fid')->getTitle());
			$this->madrak_fid->setText($this->Data['madrak_fid']->getID());
			$this->setFieldCaption('name',$this->Data['personel']->getFieldInfo('name')->getTitle());
			$this->name->setText($this->Data['personel']->getName());
			$this->setFieldCaption('family',$this->Data['personel']->getFieldInfo('family')->getTitle());
			$this->family->setText($this->Data['personel']->getFamily());
			$this->setFieldCaption('tel',$this->Data['personel']->getFieldInfo('tel')->getTitle());
			$this->tel->setText($this->Data['personel']->getTel());
			$this->setFieldCaption('born_date',$this->Data['personel']->getFieldInfo('born_date')->getTitle());
			$born_date_SD=new SweetDate(true, true, 'Asia/Tehran');
			$born_date_Text=$born_date_SD->date("l d F Y",$this->Data['personel']->getBorn_date());
			$this->born_date->setText($born_date_Text);
			$this->setFieldCaption('is_male',$this->Data['personel']->getFieldInfo('is_male')->getTitle());
			$is_maleTitle='No';
			if($this->Data['personel']->getIs_male()==1)
				$is_maleTitle='Yes';
			$this->is_male->setText($is_maleTitle);
			$this->setFieldCaption('extrasanavat',$this->Data['personel']->getFieldInfo('extrasanavat')->getTitle());
			$this->extrasanavat->setText($this->Data['personel']->getExtrasanavat());
			$this->setFieldCaption('monthsanavat',$this->Data['personel']->getFieldInfo('monthsanavat')->getTitle());
			$this->monthsanavat->setText($this->Data['personel']->getMonthsanavat());
			$this->setFieldCaption('eshteghal_fid',$this->Data['personel']->getFieldInfo('eshteghal_fid')->getTitle());
			$this->eshteghal_fid->setText($this->Data['eshteghal_fid']->getID());
			$this->setFieldCaption('zarib',$this->Data['personel']->getFieldInfo('zarib')->getTitle());
			$this->zarib->setText($this->Data['personel']->getZarib());
			$this->setFieldCaption('semat_fid',$this->Data['personel']->getFieldInfo('semat_fid')->getTitle());
			$this->semat_fid->setText($this->Data['semat_fid']->getID());
			$this->setFieldCaption('shsh',$this->Data['personel']->getFieldInfo('shsh')->getTitle());
			$this->shsh->setText($this->Data['personel']->getShsh());
			$this->setFieldCaption('computercode',$this->Data['personel']->getFieldInfo('computercode')->getTitle());
			$this->computercode->setText($this->Data['personel']->getComputercode());
			$this->setFieldCaption('mellicode',$this->Data['personel']->getFieldInfo('mellicode')->getTitle());
			$this->mellicode->setText($this->Data['personel']->getMellicode());
			$this->setFieldCaption('is_married',$this->Data['personel']->getFieldInfo('is_married')->getTitle());
			$is_marriedTitle='No';
			if($this->Data['personel']->getIs_married()==1)
				$is_marriedTitle='Yes';
			$this->is_married->setText($is_marriedTitle);
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->childcount,$this->getFieldCaption('childcount')));
		$LTable1->addElement($this->getInfoRowCode($this->address,$this->getFieldCaption('address')));
		$LTable1->addElement($this->getInfoRowCode($this->fathername,$this->getFieldCaption('fathername')));
		$LTable1->addElement($this->getInfoRowCode($this->priority,$this->getFieldCaption('priority')));
		$LTable1->addElement($this->getInfoRowCode($this->employment_date,$this->getFieldCaption('employment_date')));
		$LTable1->addElement($this->getInfoRowCode($this->personelcode,$this->getFieldCaption('personelcode')));
		$LTable1->addElement($this->getInfoRowCode($this->sanavat,$this->getFieldCaption('sanavat')));
		$LTable1->addElement($this->getInfoRowCode($this->shhesab,$this->getFieldCaption('shhesab')));
		$LTable1->addElement($this->getInfoRowCode($this->bakhsh_fid,$this->getFieldCaption('bakhsh_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->madrak_fid,$this->getFieldCaption('madrak_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->name,$this->getFieldCaption('name')));
		$LTable1->addElement($this->getInfoRowCode($this->family,$this->getFieldCaption('family')));
		$LTable1->addElement($this->getInfoRowCode($this->tel,$this->getFieldCaption('tel')));
		$LTable1->addElement($this->getInfoRowCode($this->born_date,$this->getFieldCaption('born_date')));
		$LTable1->addElement($this->getInfoRowCode($this->is_male,$this->getFieldCaption('is_male')));
		$LTable1->addElement($this->getInfoRowCode($this->extrasanavat,$this->getFieldCaption('extrasanavat')));
		$LTable1->addElement($this->getInfoRowCode($this->monthsanavat,$this->getFieldCaption('monthsanavat')));
		$LTable1->addElement($this->getInfoRowCode($this->eshteghal_fid,$this->getFieldCaption('eshteghal_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->zarib,$this->getFieldCaption('zarib')));
		$LTable1->addElement($this->getInfoRowCode($this->semat_fid,$this->getFieldCaption('semat_fid')));
		$LTable1->addElement($this->getInfoRowCode($this->shsh,$this->getFieldCaption('shsh')));
		$LTable1->addElement($this->getInfoRowCode($this->computercode,$this->getFieldCaption('computercode')));
		$LTable1->addElement($this->getInfoRowCode($this->mellicode,$this->getFieldCaption('mellicode')));
		$LTable1->addElement($this->getInfoRowCode($this->is_married,$this->getFieldCaption('is_married')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("personel", $this->Data)){
			$Result=$this->Data['personel']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>