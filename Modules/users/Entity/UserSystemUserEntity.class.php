<?php

namespace Modules\users\Entity;

use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\Sweet2DArray;

/**
 *
 * @author nahavandi
 *        
 */
class UserSystemUserEntity extends EntityClass {
	private $Database;
	public function __construct()
	{
		$this->Database=new dbquery();
	}
	public function	getUsersBySystemUser($SystemUserID)
	{
		$Query=$this->Database->Select("id")->From("user")->Where()->Equal("role_systemuser_fid", $SystemUserID);
		$result=$Query->ExecuteAssociated();
		if(!is_null($result) && count($result)>0)
		{
			$result=Sweet2DArray::array_filp($result);
			return $result['id'];
		}
		else
			return -1;
	}
	public function getSystemUserByUser($UserID)
	{
		$Query=$this->Database->Select("role_systemuser_fid as id")->From("user")->Where()->Equal("id", $UserID);
		$result=$Query->ExecuteAssociated();
		if(!is_null($result) && count($result)>0)
			return $result[0]['id'];
		else
			return -1;
	}
}

?>