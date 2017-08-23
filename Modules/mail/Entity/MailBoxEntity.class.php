<?php

namespace Modules\mail\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;

/**
 *
 * @author nahavandi
 *        
 */
class MailBoxEntity extends EntityClass {
	private $Database,$Query,$TableName;
	public function  __construct()
	{
		$this->Database=new dbquery();
		$this->Query=null;
		$this->TableName="mail_boxmail";
	}
	public function Insert($BoxID,$MailID)
	{
		$this->Query=$this->Database->InsertInto($this->TableName)
		->Set("box_fid", $BoxID)
		->Set("mail_fid", $MailID);
		$this->Query->Execute();
		return $this->Query->getInsertedId();
	}
	public function Select($BoxID,$MailID)
	{
		$this->Query=$this->Database->Select("*");
		
		$first=false;
		if(!is_null($BoxID))
		{
			if($first)
				$this->Query=$this->Query->Where();
			else 
				$this->Query=$this->Query->AndLogic();
			$this->Query=$this->Query->Equal("box_fid", $BoxID);
		}
		if(!is_null($MailID))
		{
			if($first)
				$this->Query=$this->Query->Where();
			else
				$this->Query=$this->Query->AndLogic();
			$this->Query=$this->Query->Equal("mail_fid", $MailID);
		}
		return $this->Query->ExecuteAssociated();
	}
}

?>