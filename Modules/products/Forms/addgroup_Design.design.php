<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\paragraph;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\Button;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\form;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\Div;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class addgroup_Design extends FormDesign {
	/**
	 * @var Lable
	 */
	private $Message;
	
	/**
	 * @var TextBox
	 */
	private $txtLatinTitle,$txtTitle,$txtHidGroupID;
	private $MotherGroupID;
	/**
	 * @var SweetButton
	 */
	private $btnSave;
	private $LblGroupLatinName,$LblGroupName,$LblMotherGroup,$selMotherGroup,$groupid;
	
	public function __construct()
	{
		$this->Message=new Lable("");
		$this->txtLatinTitle=new TextBox("latintitle");
		$this->txtHidGroupID=new TextBox("groupid");
		$this->txtHidGroupID->setVisible(false);
		$this->txtTitle=new TextBox("title");
		$this->btnSave=new SweetButton();
	}
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 */
	public function getBodyHTML($command = "load") {
		$table=new ListTable(2);
		$LblGroupLatinName=new Lable($this->LblGroupLatinName);
		$LblGroupName=new Lable($this->LblGroupName);
		$LblMotherGroup=new Lable($this->LblMotherGroup);
		$selMotherGroup=new DataComboBox($this->selMotherGroup,"mothergroup");
		$selMotherGroup->setIDField("id");
		$selMotherGroup->setTextField("title");
		$selMotherGroup->setSelectedID($this->MotherGroupID);
		$MessageDiv=new Div();
		$MessageDiv->setClass("products_message");
		$MessageDiv->addElement($this->Message);
		$table->addElement($this->txtHidGroupID,2);
		$table->addElement($MessageDiv,2);
		$table->addElement($LblGroupLatinName);
		$table->addElement($this->txtLatinTitle);
		$table->addElement($LblGroupName);
		$table->addElement($this->txtTitle);
		$table->addElement($LblMotherGroup);
		$table->addElement($selMotherGroup);
		$table->addElement($this->btnSave,2);
		$form=new SweetFrom("", "post", $table);
		return $form;
		
	}

	public function setLblGroupLatinName($LblGroupLatinName)
	{
	    $this->LblGroupLatinName = $LblGroupLatinName;
	}

	public function setLblMotherGroup($LblMotherGroup)
	{
	    $this->LblMotherGroup = $LblMotherGroup;
	}


	public function setSelMotherGroup($selMotherGroup)
	{
	    $this->selMotherGroup = $selMotherGroup;
	}


	public function setGroupid($groupid)
	{
	    $this->groupid = $groupid;
	}

	public function setLblGroupName($LblGroupName)
	{
	    $this->LblGroupName = $LblGroupName;
	}

	public function getMessage()
	{
	    return $this->Message;
	}

	public function getTxtLatinTitle()
	{
	    return $this->txtLatinTitle;
	}

	public function getTxtTitle()
	{
	    return $this->txtTitle;
	}

	public function setMotherGroupID($MotherGroupID)
	{
	    $this->MotherGroupID = $MotherGroupID;
	}

	public function getTxtHidGroupID()
	{
	    return $this->txtHidGroupID;
	}

	public function getBtnSave()
	{
	    return $this->btnSave;
	}
}

?>