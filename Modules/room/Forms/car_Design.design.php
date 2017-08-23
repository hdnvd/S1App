<?php
namespace Modules\room\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
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
*@creationDate 1396-05-25 - 2017-08-16 01:15
*@lastUpdate 1396-05-25 - 2017-08-16 01:15
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class car_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $details;
	/** @var lable */
	private $price;
	/** @var lable */
	private $adddate;
	/** @var lable */
	private $body_carcolor_fid;
	/** @var lable */
	private $inner_carcolor_fid;
	/** @var lable */
	private $paytype_fid;
	/** @var lable */
	private $cartype_fid;
	/** @var lable */
	private $usagecount;
	/** @var lable */
	private $wheretodate;
	/** @var lable */
	private $carbodystatus_fid;
	/** @var lable */
	private $makedate;
	/** @var lable */
	private $carstatus_fid;
	/** @var lable */
	private $shasitype_fid;
	/** @var lable */
	private $isautogearbox;
	/** @var lable */
	private $carmodel_fid;
	/** @var lable */
	private $cartagtype_fid;
	/** @var lable */
	private $carentitytype_fid;
	public function __construct()
	{
		$this->details= new lable("details");
		$this->price= new lable("price");
		$this->adddate= new lable("adddate");
		$this->body_carcolor_fid= new lable("body_carcolor_fid");
		$this->inner_carcolor_fid= new lable("inner_carcolor_fid");
		$this->paytype_fid= new lable("paytype_fid");
		$this->cartype_fid= new lable("cartype_fid");
		$this->usagecount= new lable("usagecount");
		$this->wheretodate= new lable("wheretodate");
		$this->carbodystatus_fid= new lable("carbodystatus_fid");
		$this->makedate= new lable("makedate");
		$this->carstatus_fid= new lable("carstatus_fid");
		$this->shasitype_fid= new lable("shasitype_fid");
		$this->isautogearbox= new lable("isautogearbox");
		$this->carmodel_fid= new lable("carmodel_fid");
		$this->cartagtype_fid= new lable("cartagtype_fid");
		$this->carentitytype_fid= new lable("carentitytype_fid");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("room_car");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("car"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		if (key_exists("car", $this->Data)){
			$this->details->setText($this->Data['car']->getDetails());
		}
		if (key_exists("car", $this->Data)){
			$this->price->setText($this->Data['car']->getPrice());
		}
		if (key_exists("car", $this->Data)){
			$this->adddate->setText($this->Data['car']->getAdddate());
		}
		if (key_exists("body_carcolor_fid", $this->Data)){
			$this->body_carcolor_fid->setText($this->Data['body_carcolor_fid']->getID());
		}
		if (key_exists("inner_carcolor_fid", $this->Data)){
			$this->inner_carcolor_fid->setText($this->Data['inner_carcolor_fid']->getID());
		}
		if (key_exists("paytype_fid", $this->Data)){
			$this->paytype_fid->setText($this->Data['paytype_fid']->getID());
		}
		if (key_exists("cartype_fid", $this->Data)){
			$this->cartype_fid->setText($this->Data['cartype_fid']->getID());
		}
		if (key_exists("car", $this->Data)){
			$this->usagecount->setText($this->Data['car']->getUsagecount());
		}
		if (key_exists("car", $this->Data)){
			$this->wheretodate->setText($this->Data['car']->getWheretodate());
		}
		if (key_exists("carbodystatus_fid", $this->Data)){
			$this->carbodystatus_fid->setText($this->Data['carbodystatus_fid']->getID());
		}
		if (key_exists("car", $this->Data)){
			$this->makedate->setText($this->Data['car']->getMakedate());
		}
		if (key_exists("carstatus_fid", $this->Data)){
			$this->carstatus_fid->setText($this->Data['carstatus_fid']->getID());
		}
		if (key_exists("shasitype_fid", $this->Data)){
			$this->shasitype_fid->setText($this->Data['shasitype_fid']->getID());
		}
		if (key_exists("carmodel_fid", $this->Data)){
			$this->carmodel_fid->setText($this->Data['carmodel_fid']->getID());
		}
		if (key_exists("cartagtype_fid", $this->Data)){
			$this->cartagtype_fid->setText($this->Data['cartagtype_fid']->getID());
		}
		if (key_exists("carentitytype_fid", $this->Data)){
			$this->carentitytype_fid->setText($this->Data['carentitytype_fid']->getID());
		}
		$LTable1=new ListTable(2);
		$LTable1->setClass("formtable");
		$LTable1->addElement(new Lable("details"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->details);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("price"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->price);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("adddate"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->adddate);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("body_carcolor_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->body_carcolor_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("inner_carcolor_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->inner_carcolor_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("paytype_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->paytype_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("cartype_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->cartype_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("usagecount"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->usagecount);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("wheretodate"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->wheretodate);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("carbodystatus_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->carbodystatus_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("makedate"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->makedate);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("carstatus_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->carstatus_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("shasitype_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->shasitype_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("isautogearbox"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->isautogearbox);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("carmodel_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->carmodel_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("cartagtype_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->cartagtype_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$LTable1->addElement(new Lable("carentitytype_fid"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->carentitytype_fid);
		$LTable1->setLastElementClass('form_item_datalabel');
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>