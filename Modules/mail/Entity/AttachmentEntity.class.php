<?php

namespace Modules\mail\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;

/**
 *
 * @author nahavandi
 *        
 */
class AttachmentEntity extends EntityClass {
	private $Database,$TableName;
	public function __construct()
	{
		$this->Database=new dbquery();
		$this->TableName="mail_attachment";
	}
	public function Insert($FileUrl,$MailID)
	{
		$Query=$this->Database->InsertInto($this->TableName)
		->Set("mail_fid", $MailID)
		->Set("fileurl", $FileUrl);
		$Query->Execute();
		return $Query->getInsertedId();
	}
	public function Find($ID,$FileUrl,$MailID)
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
		if(!is_null($FileUrl))
		{
			if($first)
				$Query=$Query->Where();
			else
				$Query=$Query->AndLogic();
			$Query=$Query->Equal("fileurl", $FileUrl);
			$first=false;
		}
		if(!is_null($MailID))
		{
			if($first)
				$Query=$Query->Where();
			else
				$Query=$Query->AndLogic();
			$Query=$Query->Like("mail_fid", $MailID);
			$first=false;
		}
		return $Query->ExecuteAssociated();
	}
}

?>