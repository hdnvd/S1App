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
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
/**
 *@author Hadi AmirNahavandi
 *@creationDate 1396-06-16 - 2017-09-07 01:34
 *@lastUpdate 1396-06-16 - 2017-09-07 01:34
 *@SweetFrameworkHelperVersion 2.002
 *@SweetFrameworkVersion 2.002
 */
class manageuser_Design extends FormDesign {
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
    private $email;
    /**
     * @return textbox
     */
    public function getEmail()
    {
        return $this->email;
    }
    /** @var textbox */
    private $tel;
    /**
     * @return textbox
     */
    public function getTel()
    {
        return $this->tel;
    }
    /** @var textbox */
    private $mob;
    /**
     * @return textbox
     */
    public function getMob()
    {
        return $this->mob;
    }
    /** @var textbox */
    private $postalcode;
    /**
     * @return textbox
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }
    /** @var ComboBox */
    private $ismale;
    /**
     * @return ComboBox
     */
    public function getIsmale()
    {
        return $this->ismale;
    }
    /** @var combobox */
    private $common_city_fid;
    /**
     * @return combobox
     */
    public function getCommon_city_fid()
    {
        return $this->common_city_fid;
    }
    /** @var textbox */
    private $birthday;
    /**
     * @return textbox
     */
    public function getBirthday()
    {
        return $this->birthday;
    }
    /** @var CheckBox */
    private $ispayed;
    /**
     * @return CheckBox
     */
    public function getIspayed()
    {
        return $this->ispayed;
    }
    /** @var textbox */
    private $signupdate;
    /**
     * @return textbox
     */
    public function getSignupdate()
    {
        return $this->signupdate;
    }
    /** @var textbox */
    private $photo;
    /**
     * @return textbox
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    /** @var CheckBox */
    private $is_info_visible;
    /**
     * @return CheckBox
     */
    public function getIs_info_visible()
    {
        return $this->is_info_visible;
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
    /** @var SweetButton */
    private $btnSave;
    public function __construct()
    {
        $this->name= new textbox("name");
        $this->email= new textbox("email");
        $this->tel= new textbox("tel");
        $this->mob= new textbox("mob");
        $this->postalcode= new textbox("postalcode");
        $this->ismale= new ComboBox("ismale");
        $this->common_city_fid= new combobox("common_city_fid");
        $this->birthday= new textbox("birthday");
        $this->ispayed= new CheckBox("ispayed");
        $this->signupdate= new textbox("signupdate");
        $this->photo= new textbox("photo");
        $this->is_info_visible= new CheckBox("is_info_visible");
        $this->carmodel_fid= new combobox("carmodel_fid");
        $this->btnSave= new SweetButton(true,"ذخیره");
        $this->btnSave->setAction("btnSave");
    }
    public function getBodyHTML($command=null)
    {
        if (key_exists("user", $this->Data))
            $this->name->setValue($this->Data['user']->getName());
        if (key_exists("user", $this->Data))
            $this->email->setValue($this->Data['user']->getEmail());
        if (key_exists("user", $this->Data))
            $this->tel->setValue($this->Data['user']->getTel());
        if (key_exists("user", $this->Data))
            $this->mob->setValue($this->Data['user']->getMob());
        if (key_exists("user", $this->Data))
            $this->postalcode->setValue($this->Data['user']->getPostalcode());
        $this->ismale->addOption("1","آقا");
        $this->ismale->addOption("0","خانم");
        if (key_exists("user", $this->Data))
            $this->ismale->setSelectedValue($this->Data['user']->getIsmale());
        foreach ($this->Data['common_city_fid'] as $item)
            $this->common_city_fid->addOption($item->getID(), $item->getTitle());
        if (key_exists("user", $this->Data))
            $this->common_city_fid->setSelectedValue($this->Data['user']->getCommon_city_fid());
        if (key_exists("user", $this->Data))
            $this->birthday->setValue($this->Data['user']->getBirthday());
        $this->ispayed->addOption("ispayed","1");
        if (key_exists("user", $this->Data))
            $this->ispayed->addSelectedValue($this->Data['user']->getIspayed());
        if (key_exists("user", $this->Data))
            $this->signupdate->setValue($this->Data['user']->getSignupdate());
        if (key_exists("user", $this->Data))
            $this->photo->setValue($this->Data['user']->getPhoto());
        $this->is_info_visible->addOption("نمایش اطلاعات تماس شما","1");
        if (key_exists("user", $this->Data))
            $this->is_info_visible->addSelectedValue($this->Data['user']->getIs_info_visible());
        foreach ($this->Data['carmodel_fid'] as $item)
            $this->carmodel_fid->addOption($item->getID(), $item->getTitle());
        if (key_exists("user", $this->Data))
            $this->carmodel_fid->setSelectedValue($this->Data['user']->getCarmodel_fid());
        $Page=new Div();
        $Page->setClass("sweet_formtitle");
        $Page->setId("buysell_manageprofile");
        $PageTitlePart=new Div();
        $PageTitlePart->setClass("sweet_pagetitlepart");
        $PageTitlePart->addElement(new Lable("مدیریت پروفایل"));
        $Page->addElement($PageTitlePart);
        $MessagePart=new Div();
        $MessagePart->setClass("sweet_messagepart");
        $MessagePart->addElement(new Lable($this->getMessage()));
        $Page->addElement($MessagePart);
        $LTable1=new ListTable(2);
        $LTable1->setClass("formtable");
        $LTable1->addElement(new Lable("نام و نام خانوادگی"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->name);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("ایمیل"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->email);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("تلفن"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->tel);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("تلفن همراه"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->mob);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("کد پستی"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->postalcode);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("جنسیت"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->ismale);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement(new Lable("شهر"));
        $LTable1->setLastElementClass('form_item_caption');
        $LTable1->addElement($this->common_city_fid);
        $LTable1->setLastElementClass('form_item_field');
        $LTable1->addElement($this->btnSave,2);
        $LTable1->setLastElementClass('form_item_sweetbutton');
        $Page->addElement($LTable1);
        $form=new SweetFrom("", "POST", $Page);
        return $form->getHTML();
    }
}
?>