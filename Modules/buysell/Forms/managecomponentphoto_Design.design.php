<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\Image;
use core\CoreClasses\html\link;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\RadioBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use core\CoreClasses\services\MessageType;
use Modules\buysell\PublicClasses\CarGroups;
use Modules\buysell\PublicClasses\Constants;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;

/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-27 - 2017-02-15 13:42
*@lastUpdate 1395-11-27 - 2017-02-15 13:42
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponentphoto_Design extends FormDesign {
	private $Data;
    private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var FileUploadBox */
	private $flPhoto;
	/**
	 * @return FileUploadBox
	 */
	public function getFlPhoto()
	{
		return $this->flPhoto;
	}
	/** @var SweetButton */
	private $btnAddNew;
	public function __construct()
	{
		$this->flPhoto= new FileUploadBox("flPhoto");
		$this->btnAddNew= new SweetButton(true,"افزودن تصویر جدید");
		$this->btnAddNew->setAction("btnAddNew");
	}
	public function getBodyHTML($command=null)
	{
        $cg=new CarGroups();
        $groupName=$cg->getGroupName($_GET['groupid']);
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("buysell_managecomponentphoto");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
		$PageTitlePart->addElement(new Lable("مدیریت تصاویر قطعه"));
		$Page->addElement($PageTitlePart);


        $LTable1=new ListTable(2);
		$LTable1->addElement(new Lable("تصویر"));
		$LTable1->addElement($this->flPhoto);
		$LTable1->addElement($this->btnAddNew,2);
        $LTable2=new ListTable(count($this->Data['photos']));
        for ($i=0;$i<count($this->Data['photos']);$i++)
        {
            $lb=new Lable("حذف");
            $PhotoPage="managecomponentphoto";
            if(!$this->adminMode)
                $PhotoPage="manageusercomponentphoto";

            $ar=new AppRooter($groupName,$PhotoPage);
            $ar->addParameter(new UrlParameter('photoid',$this->Data['photos'][$i]['id']));
            $ar->addParameter(new UrlParameter('id',$this->Data['id']));
            $ar->addParameter(new UrlParameter('delete',null));
            $li=new link($ar->getAbsoluteURL(),$lb);
            $LTable2->addElement($li);
        }
        for ($i=0;$i<count($this->Data['photos']);$i++)
        {
            $ur=DEFAULT_PUBLICURL . $this->Data['photos'][$i]['url'];
            $im=new Image($ur);
            $im->setClass('componentphoto');
            $li=new link($ur,$im);
            $LTable2->addElement($li);
        }
        $Page->addElement($LTable1);
        $MessagePart=new Div();
        if($this->getMessageType()==MessageType::$ERROR)
            $MessagePart->setClass("sweet_messagepart error");
        else
            $MessagePart->setClass("sweet_messagepart");
        $MessagePart->addElement(new Lable($this->getMessage()));
        $Page->addElement($MessagePart);
        $Page->addElement($LTable2);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>