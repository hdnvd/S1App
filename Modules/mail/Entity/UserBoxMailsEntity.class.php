<?php

namespace Modules\mail\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\DBField;

/**
 *
 * @author nahavandi
 *        
 */
class UserBoxMailsEntity extends EntityClass {
	private $Database,$TableName;
	public function __construct()
	{
		$this->Database=new dbquery();
		$this->TableName="noTable";
	}
	public function GetUserBoxMails($SystemUserID,$BoxType)
	{
		$Query=$this->Database->Select("mail.*")->From(array("mail_mail mail","mail_box box","mail_boxmail boxmail"))->Where();
		
		$Query2=$Query->Equal("boxmail.mail_fid", new DBField("mail.id",false))->AndLogic()
		->Equal("boxmail.box_fid", new DBField("box.id",false))->AndLogic()
		->Equal("box.boxtype_fid", $BoxType)->AndLogic()
		->Equal("box.user_fid", $SystemUserID);
		$result=$Query2->ExecuteAssociated();
		return $result;
		
	}
}

?>