<?php

namespace Modules\mail\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;

/**
 *
 * @author nahavandi
 *        
 */
class BoxEntity extends EntityClass {
	private $Database,$Query,$TableName;
	public function __construct()
	{
		$this->Database=new dbquery();
		$this->Query=null;
		$this->TableName="mail_box";
	}
	public function SelectUserBox($userID, $BoxType)
	{
		$this->Query=$this->Database->Select("id")->From($this->TableName)->Where()
		->Equal("user_fid", $userID)
		->AndLogic()
		->Equal("boxtype_fid", $BoxType);
		return $this->Query->ExecuteAssociated();
	}
	public function Insert($userID, $BoxType)
	{
		$this->Query=$this->Database->InsertInto($this->TableName)
		->Set("user_fid", $userID)
		->Set("boxtype_fid", $BoxType);
		$this->Query->Execute();
		return $this->Query->getInsertedId();
	}
}

?>