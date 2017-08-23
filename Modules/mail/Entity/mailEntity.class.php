<?php

namespace Modules\mail\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;

/**
 *
 * @author nahavandi
 *        
 */
class mailEntity extends EntityClass {
	private $Database,$TableName;
	public function  __construct()
	{
		$this->Database=new dbquery();
		$this->TableName="mail_mail";
	}
	public function InserMail($Subject,$Text,$SenderID)
	{
		
		$Query=$this->Database->InsertInto($this->TableName)
		->Set("subject", $Subject)
		->Set("text", $Text)
		->Set("sender_fid", $SenderID);
		$Query->Execute();
		return $Query->getInsertedId();
	}
	public function Select($ID,$Subject,$Text)
	{
		$Query=$this->Database->Select("*")->From($this->TableName);
		
		$first=true;
		if(!is_null($ID))
		{
			if($first)
				$Query=$Query->Where();
			else
				$Query=$Query->AndLogic();
			$Query=$Query->Equal("id", $ID);
			$first=false;
		}
		if(!is_null($Subject))
		{
			if($first)
				$Query=$Query->Where();
			else
				$Query=$Query->AndLogic();
			$Query=$Query->Like("subject", $Subject);
			$first=false;
		}
		if(!is_null($Text))
		{
			if($first)
				$Query=$Query->Where();
			else
				$Query=$Query->AndLogic();
			$Query=$Query->Like("text", $Text);
			$first=false;
		}
// 		echo $Query->getQueryString();
		return $Query->ExecuteAssociated();
	}
}

?>