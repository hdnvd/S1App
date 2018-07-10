<?php

namespace Modules\gallery\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\TextArea;
use core\CoreClasses\html\FileUploadBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\Image;

/**
 *
 * @author hadi
 *        
 */
class sendphoto_Design extends FormDesign {
	private $lbltitle,$lbldesc,$lblphoto;
	/**
	 * @var DataComboBox
	 */
	private $cmbMotherAlbum;
	
	/**
	 * @var TextBox
	 */
	private $txtHidID,$txttitle,$txtCaptcha;

	/**
	 * @var TextArea
	 */
	private $txtdesc;
	
	/**
	 * @var SweetButton
	 */
	private $btnSave;
	
	/**
	 * @var Image
	 */
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 */
	public function __construct()
	{
		$this->cmbMotherAlbum=new DataComboBox(array());
		$this->txtHidID=new TextBox("hidid");
		$this->txtHidID->setVisible(false);
		$this->btnSave=new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("save");
		$this->txttitle=new TextBox("txttitle");
		$this->txtdesc=new TextArea("txtdesc");
		$this->txtCaptcha=new TextBox("txtcaptcha");
	}
	public function getBodyHTML($command = "load") {
		
		$table=new ListTable(2);
		$lbltitle=new Lable($this->lbltitle);
		$lbldesc=new Lable($this->lbldesc);
		$lblphoto=new Lable($this->lblphoto);
		$lblAlbum=new Lable("آلبوم");
		$filephoto=new FileUploadBox("filephoto");
		$filephoto->setFileTypes(".jpg,.jpeg");

		$table->addElement($this->txtHidID,2);
		$table->addElement($lbltitle);
		$table->addElement($this->txttitle);
		$table->addElement($lbldesc);
		$table->addElement($this->txtdesc);
		$table->addElement($lblphoto);
		$table->addElement($filephoto);
		$table->addElement($lblAlbum);
		$table->addElement($this->cmbMotherAlbum);
		$captcha=new Image(DEFAULT_APPURL . "captcha");
		$table->addElement($captcha,2);
		$table->addElement(new Lable("حروف تصویر"));
		$table->addElement($this->txtCaptcha);
		$table->addElement($this->btnSave,2);
		
		$form=new SweetFrom("", "POST", $table);
		
		return $form;
	}

	public function setLbltitle($lbltitle)
	{
	    $this->lbltitle = $lbltitle;
	}

	public function setLbldesc($lbldesc)
	{
	    $this->lbldesc = $lbldesc;
	}

	public function setLblphoto($lblphoto)
	{
	    $this->lblphoto = $lblphoto;
	}

	public function getCmbMotherAlbum()
	{
	    return $this->cmbMotherAlbum;
	}

	public function getTxtHidID()
	{
	    return $this->txtHidID;
	}

	public function getBtnSave()
	{
	    return $this->btnSave;
	}

	public function getTxttitle()
	{
	    return $this->txttitle;
	}

	public function getTxtdesc()
	{
	    return $this->txtdesc;
	}

	public function getTxtCaptcha()
	{
	    return $this->txtCaptcha;
	}
}

?>