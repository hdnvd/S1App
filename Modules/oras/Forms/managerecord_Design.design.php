<?php

namespace Modules\oras\Forms;

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
 * @author Hadi AmirNahavandi
 * @creationDate 1396-07-12 - 2017-10-04 03:03
 * @lastUpdate 1396-07-12 - 2017-10-04 03:03
 * @SweetFrameworkHelperVersion 2.002
 * @SweetFrameworkVersion 2.002
 */
class managerecord_Design extends FormDesign
{
    public function getBodyHTML($command = null)
    {
        $this->FillItems();
        $Page = new Div();
        $Page->setClass("sweet_formtitle");
        $Page->setId("oras_managerecord");
        $Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['record']->getTableTitle() . ""));
        if ($this->getMessage() != "")
            $Page->addElement($this->getMessagePart());
        $LTable1 = new Div();
        $LTable1->setClass("formtable");
        $LTable1->addElement($this->getFieldRowCode($this->title, $this->getFieldCaption('title'), null, 'لطفا این فیلد را به طور صحیح وارد کنید', null));
        $LTable1->addElement($this->getFieldRowCode($this->occurance_date, $this->getFieldCaption('occurance_date'), null, 'لطفا این فیلد را به طور صحیح وارد کنید', null));
        $LTable1->addElement($this->getFieldRowCode($this->description, $this->getFieldCaption('description'), null, 'لطفا این فیلد را به طور صحیح وارد کنید', null));
        $LTable1->addElement($this->getFieldRowCode($this->shifttype_fid, $this->getFieldCaption('shifttype_fid'), null, 'لطفا این فیلد را به طور صحیح وارد کنید', null));
        $LTable1->addElement($this->getFieldRowCode($this->recordtype_fid, $this->getFieldCaption('recordtype_fid'), null, 'لطفا این فیلد را به طور صحیح وارد کنید', null));
        if($this->employee_fid->getVisible())
            $LTable1->addElement($this->getFieldRowCode($this->employee_fid, $this->getFieldCaption('employee_fid'), null, 'لطفا این فیلد را به طور صحیح وارد کنید', null));
        if($this->place_fid->getVisible())
            $LTable1->addElement($this->getFieldRowCode($this->place_fid, $this->getFieldCaption('place_fid'), null, 'لطفا این فیلد را به طور صحیح وارد کنید', null));
        $LTable1->addElement($this->getFieldRowCode($this->file1_flu, $this->getFieldCaption('file1_flu'), null, 'لطفا این فیلد را به طور صحیح وارد کنید', null));
        $LTable1->addElement($this->getFieldRowCode($this->file2_flu, $this->getFieldCaption('file2_flu'), null, 'لطفا این فیلد را به طور صحیح وارد کنید', null));
        $LTable1->addElement($this->getFieldRowCode($this->file3_flu, $this->getFieldCaption('file3_flu'), null, 'لطفا این فیلد را به طور صحیح وارد کنید', null));
        $LTable1->addElement($this->getFieldRowCode($this->file4_flu, $this->getFieldCaption('file4_flu'), null, 'لطفا این فیلد را به طور صحیح وارد کنید', null));
        $LTable1->addElement($this->getSingleFieldRowCode($this->btnSave));
        $Page->addElement($LTable1);
        $form = new SweetFrom("", "POST", $Page);
        $form->SetAttribute("novalidate", "novalidate");
        $form->SetAttribute("data-toggle", "validator");
        $form->setClass('form-horizontal');
        return $form->getHTML();
    }

    public function FillItems()
    {

        /******** title ********/
        if (key_exists("record", $this->Data)) {
            $this->title->setValue($this->Data['record']->getTitle());
            $this->setFieldCaption('title', $this->Data['record']->getFieldInfo('title')->getTitle());
            $this->title->setFieldInfo($this->Data['record']->getFieldInfo('title'));
        }

        /******** occurance_date ********/
        if (key_exists("record", $this->Data)) {
            $this->occurance_date->setTime($this->Data['record']->getOccurance_date());
            $this->setFieldCaption('occurance_date', $this->Data['record']->getFieldInfo('occurance_date')->getTitle());
            $this->occurance_date->setFieldInfo($this->Data['record']->getFieldInfo('occurance_date'));
        }

        /******** description ********/
        if (key_exists("record", $this->Data)) {
            $this->description->setValue($this->Data['record']->getDescription());
            $this->setFieldCaption('description', $this->Data['record']->getFieldInfo('description')->getTitle());
            $this->description->setFieldInfo($this->Data['record']->getFieldInfo('description'));
        }

        /******** shifttype_fid ********/
        foreach ($this->Data['shifttype_fid'] as $item)
            $this->shifttype_fid->addOption($item->getID(), $item->getTitleField());
        if (key_exists("record", $this->Data)) {
            $this->shifttype_fid->setSelectedValue($this->Data['record']->getShifttype_fid());
            $this->setFieldCaption('shifttype_fid', $this->Data['record']->getFieldInfo('shifttype_fid')->getTitle());
        }

        /******** recordtype_fid ********/
        foreach ($this->Data['recordtype_fid'] as $item)
            $this->recordtype_fid->addOption($item->getID(), $item->getTitleField());
        if (key_exists("record", $this->Data)) {
            $this->recordtype_fid->setSelectedValue($this->Data['record']->getRecordtype_fid());
            $this->setFieldCaption('recordtype_fid', $this->Data['record']->getFieldInfo('recordtype_fid')->getTitle());
        }

        /******** employee_fid ********/
        if (key_exists('employee_fid', $this->Data))
            $this->employee_fid->setValue($this->Data['employee_fid']->getName() . " " . $this->Data['employee_fid']->getFamily() . "-(" . $this->Data['employee_fid']->getMellicode() . ")");
        else
            $this->employee_fid->setVisible(false);

        /******** place_fid ********/
        if (key_exists('place_fid', $this->Data))
            $this->place_fid->setValue($this->Data['place_fid']->getTitle());
        else
            $this->place_fid->setVisible(false);



        /******** file1_flu ********/
        if (key_exists("record", $this->Data)) {
            $this->setFieldCaption('file1_flu', $this->Data['record']->getFieldInfo('file1_flu')->getTitle());
        }

        /******** file2_flu ********/
        if (key_exists("record", $this->Data)) {
            $this->setFieldCaption('file2_flu', $this->Data['record']->getFieldInfo('file2_flu')->getTitle());
        }

        /******** file3_flu ********/
        if (key_exists("record", $this->Data)) {
            $this->setFieldCaption('file3_flu', $this->Data['record']->getFieldInfo('file3_flu')->getTitle());
        }

        /******** file4_flu ********/
        if (key_exists("record", $this->Data)) {
            $this->setFieldCaption('file4_flu', $this->Data['record']->getFieldInfo('file4_flu')->getTitle());
        }

        /******** btnSave ********/
    }

    public function __construct()
    {
        parent::__construct();

        /******* title *******/
        $this->title = new textbox("title");
        $this->title->setClass("form-control");

        /******* occurance_date *******/
        $this->occurance_date = new DatePicker("occurance_date");
        $this->occurance_date->setClass("form-control");

        /******* description *******/
        $this->description = new textbox("description");
        $this->description->setClass("form-control");

        /******* shifttype_fid *******/
        $this->shifttype_fid = new combobox("shifttype_fid");
        $this->shifttype_fid->setClass("form-control");

        /******* recordtype_fid *******/
        $this->recordtype_fid = new combobox("recordtype_fid");
        $this->recordtype_fid->setClass("form-control");

        /******* employee_fid *******/
        $this->employee_fid = new textbox("employee_fid");
        $this->employee_fid->setReadonly(true);
		$this->employee_fid->setClass("form-control");

		/******* place_fid *******/
		$this->place_fid = new textbox("place_fid");
        $this->place_fid->setReadonly(true);
		$this->place_fid->setClass("form-control");

		/******* file1_flu *******/
		$this->file1_flu = new FileUploadBox("file1_flu");
		$this->file1_flu->setClass("form-control-file");

		/******* file2_flu *******/
		$this->file2_flu = new FileUploadBox("file2_flu");
		$this->file2_flu->setClass("form-control-file");

		/******* file3_flu *******/
		$this->file3_flu = new FileUploadBox("file3_flu");
		$this->file3_flu->setClass("form-control-file");

		/******* file4_flu *******/
		$this->file4_flu = new FileUploadBox("file4_flu");
		$this->file4_flu->setClass("form-control-file");

		/******* btnSave *******/
		$this->btnSave = new SweetButton(true, "ذخیره");
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

    private $adminMode = true;

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
    private $title;

    /**
     * @return textbox
     */
    public function getTitle()
    {
        return $this->title;
    }

    /** @var DatePicker */
    private $occurance_date;

    /**
     * @return DatePicker
     */
    public function getOccurance_date()
    {
        return $this->occurance_date;
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

    /** @var combobox */
    private $shifttype_fid;

    /**
     * @return combobox
     */
    public function getShifttype_fid()
    {
        return $this->shifttype_fid;
    }

    /** @var combobox */
    private $recordtype_fid;

    /**
     * @return combobox
     */
    public function getRecordtype_fid()
    {
        return $this->recordtype_fid;
    }

    /** @var combobox */
    private $employee_fid;

    /**
     * @return combobox
     */
    public function getEmployee_fid()
    {
        return $this->employee_fid;
    }

    /** @var combobox */
    private $place_fid;

    /**
     * @return combobox
     */
    public function getPlace_fid()
    {
        return $this->place_fid;
    }



    /** @var FileUploadBox */
    private $file1_flu;

    /**
     * @return FileUploadBox
     */
    public function getFile1_flu()
    {
        return $this->file1_flu;
    }

    /** @var FileUploadBox */
    private $file2_flu;

    /**
     * @return FileUploadBox
     */
    public function getFile2_flu()
    {
        return $this->file2_flu;
    }

    /** @var FileUploadBox */
    private $file3_flu;

    /**
     * @return FileUploadBox
     */
    public function getFile3_flu()
    {
        return $this->file3_flu;
    }

    /** @var FileUploadBox */
    private $file4_flu;

    /**
     * @return FileUploadBox
     */
    public function getFile4_flu()
    {
        return $this->file4_flu;
    }

    /** @var SweetButton */
    private $btnSave;
}

?>