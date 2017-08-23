<?php
namespace Modules\buysell\Forms;
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
use Modules\buysell\PublicClasses\CarGroups;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-25 - 2017-06-15 02:03
*@lastUpdate 1396-03-25 - 2017-06-15 02:03
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecars_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var textbox */
	private $details;
	/**
	 * @return textbox
	 */
	public function getDetails()
	{
		return $this->details;
	}
	/** @var textbox */
	private $price;
	/**
	 * @return textbox
	 */
	public function getPrice()
	{
		return $this->price;
	}
	/** @var textbox */
	private $adddate;
	/**
	 * @return textbox
	 */
	public function getAdddate()
	{
		return $this->adddate;
	}
	/** @var combobox */
	private $body_carcolor_fid;
	/**
	 * @return combobox
	 */
	public function getBody_carcolor_fid()
	{
		return $this->body_carcolor_fid;
	}
	/** @var combobox */
	private $inner_carcolor_fid;
	/**
	 * @return combobox
	 */
	public function getInner_carcolor_fid()
	{
		return $this->inner_carcolor_fid;
	}
	/** @var combobox */
	private $paytype_fid;
	/**
	 * @return combobox
	 */
	public function getPaytype_fid()
	{
		return $this->paytype_fid;
	}
	/** @var combobox */
	private $cartype_fid;
	/**
	 * @return combobox
	 */
	public function getCartype_fid()
	{
		return $this->cartype_fid;
	}
	/** @var textbox */
	private $usagecount;
	/**
	 * @return textbox
	 */
	public function getUsagecount()
	{
		return $this->usagecount;
	}
	/** @var textbox */
	private $wheretodate;
	/**
	 * @return textbox
	 */
	public function getWheretodate()
	{
		return $this->wheretodate;
	}
	/** @var combobox */
	private $carbodystatus_fid;
	/**
	 * @return combobox
	 */
	public function getCarbodystatus_fid()
	{
		return $this->carbodystatus_fid;
	}
	/** @var textbox */
	private $makedate;
	/**
	 * @return textbox
	 */
	public function getMakedate()
	{
		return $this->makedate;
	}
	/** @var combobox */
	private $carstatus_fid;
	/**
	 * @return combobox
	 */
	public function getCarstatus_fid()
	{
		return $this->carstatus_fid;
	}
	/** @var combobox */
	private $shasitype_fid;
	/**
	 * @return combobox
	 */
	public function getShasitype_fid()
	{
		return $this->shasitype_fid;
	}
	/** @var CheckBox */
	private $isautogearbox;
	/**
	 * @return CheckBox
	 */
	public function getIsautogearbox()
	{
		return $this->isautogearbox;
	}
	/** @var combobox */
	private $carmodel_fid;
	/**
	 * @return combobox
	 */
	public function getCarmodel_fid()
	{
		return $this->carmodel_fid;
	}
	/** @var combobox */
	private $cartagtype_fid;
	/**
	 * @return combobox
	 */
	public function getCartagtype_fid()
	{
		return $this->cartagtype_fid;
	}
	/** @var combobox */
	private $carentitytype_fid;
	/**
	 * @return combobox
	 */
	public function getCarentitytype_fid()
	{
		return $this->carentitytype_fid;
	}
	/** @var SweetButton */
	private $btnSave;
	public function __construct()
	{
		$this->details= new textbox("details");
		$this->price= new textbox("price");
		$this->adddate= new textbox("adddate");
		$this->body_carcolor_fid= new combobox("body_carcolor_fid");
		$this->inner_carcolor_fid= new combobox("inner_carcolor_fid");
		$this->paytype_fid= new combobox("paytype_fid");
		$this->cartype_fid= new combobox("cartype_fid");
		$this->usagecount= new textbox("usagecount");
		$this->wheretodate= new textbox("wheretodate");
		$this->carbodystatus_fid= new combobox("carbodystatus_fid");
		$this->makedate= new textbox("makedate");
		$this->carstatus_fid= new combobox("carstatus_fid");
		$this->shasitype_fid= new combobox("shasitype_fid");
		$this->isautogearbox= new CheckBox("isautogearbox");
		$this->carmodel_fid= new combobox("carmodel_fid");
		$this->cartagtype_fid= new combobox("cartagtype_fid");
		$this->carentitytype_fid= new combobox("carentitytype_fid");
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
	}
	public function getBodyHTML($command=null)
	{

        $cg=new CarGroups();
        $groupName=$cg->getGroupName($this->Data['group']['id']);
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("buysell_managecars");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
        $PageTitlePart->addElement(new Lable("صفحه اصلی > مدیریت خودرو ها"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		$addUrl=new AppRooter($groupName,'managecar');
		$LblAdd=new Lable('افزودن آگهی جدید');
		$lnkAdd=new link($addUrl->getAbsoluteURL(),$LblAdd);
		$lnkAdd->setClass('linkbutton');
		$lnkAdd->setId('addcarlink');
		$Page->addElement($lnkAdd);
		$LTable1=new ListTable(3);
		$LTable1->setClass("managelist");
		$LTable1->addElement(new Lable('#'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عنوان'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عملیات'));
		$LTable1->setLastElementClass("listtitle");
		for($i=0;$i<count($this->Data['data']);$i++){
			$url=new AppRooter($groupName,'managecar');
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));

			$delurl=new AppRooter($groupName,'sell');
			$delurl->setFileFormat(".html");
			$delurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$delurl->addParameter(new UrlParameter('delete',1));

            $Title=$this->Data['cardata'][$i]['brand']->getTitle() . " " . $this->Data['cardata'][$i]['model']->getTitle();
//
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$lbDel[$i]=new Lable('حذف');
			$liDel[$i]=new link($delurl->getAbsoluteURL(),$lbDel[$i]);
			$LTable1->addElement(new Lable($i+1));
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liTit[$i]);
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liDel[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>