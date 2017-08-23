<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/08
*/
namespace Modules\users\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\WhereClause;
class userEntity extends EntityClass
{
	
	public static function getUserInfo($userId,$fieldName)
	{
		$Database=new dbquery();
		$Query=$Database->Select("*")->From("user")->Where()->Equal("id", $userId);
		$result=$Query->ExecuteAssociated();
		$info=null;
		if($result!=null)
			$info=$result[0][$fieldName];
		return $info;
	
	}
	public static function FindUserIDFromSystemUser($RoleSystemUserId)
	{
		$Database=new dbquery();
		$Query=$Database->Select("*")->From("user")->Where()->Equal("role_systemuser_fid", $RoleSystemUserId);
		$result=$Query->ExecuteAssociated();
		$info=null;
		if($result!=null)
			$info=$result[0]['id'];
		return $info;
	
	}
	public static function checkUserPass($username,$password)
	{
	
		$sysuser=new roleSystemUserEntity();
		return $sysuser->checkUserPass($username, $password);
	}
	/**
	 * @param Boolean $ismale
	 * @param string $father
	 * @param string $postalcode
	 * @param string $name
	 * @param string $family
	 * @param string $tel
	 * @param string $mobile
	 * @param string $mail
	 * @param string $username
	 * @param string $password
	 * @return number UserID
	 */
	public static function AddUser($RoleSysUserID,$ismale,$name,$family,$mobile,$mail,$username,$password,$profilepictureURL,$AdditionalFields)
	{
		$Database=new dbquery();
		$Query=$Database->InsertInto("user")
		->Set("ismale", $ismale)
		->Set("name",$name)
		->Set("family", $family)
		->Set("mobile", $mobile)
		->Set("mail", $mail)
		->Set("role_systemuser_fid", $RoleSysUserID)
		->Set("profilepicture", $profilepictureURL)
		->Set("signuptime", time());
		$FieldNames=array_keys($AdditionalFields);
		for($i=0;$i<count($FieldNames);$i++)
		    $Query=$Query->Set($FieldNames[$i], $AdditionalFields[$FieldNames[$i]]);
		//echo $Query->getQueryString();
		$Query->Execute();
		return $Query->getInsertedId();
	}
	public function getLevelStudents($LevelID)
	{
		$Database=new dbquery();
		$result=$Database->Select("*")->From("user")->Where()->Equal("studentlevel_fid", $LevelID)->ExecuteAssociated();
		return $result;
	}
	public function getAll()
	{
		$Database=new dbquery();
		$Query=$Database->Select("id as value,CONCAT_WS(name,family) AS text")->From("user");
		$result=$Query->ExecuteAssociated();
		return $result;
	}
	public function Select(array $Fields,$ID,$RoleSysUserID,$ismale,$father,$postalcode,$name,$family,$tel,$mobile,$mail,$profilepictureURL,$LatinName,$LatinFamily,$SignupTime)
	{
	    $Database=new dbquery();
		$Query=$Database->Select($Fields)->From("user")->Where()->Equal("isdeleted", 0);
		if(!is_null($ID))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Equal("id", $ID);
		}
		if(!is_null($RoleSysUserID))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("role_systemuser_fid", $RoleSysUserID);
		}
		if(!is_null($ismale))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Equal("ismale", $ismale);
		}
		if(!is_null($father))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("father", $father);
		}
		if(!is_null($postalcode))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("postalcode", $postalcode);
		}
		if(!is_null($name))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("name", $name);
		}
		if(!is_null($family))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("family", $family);
		}
		if(!is_null($tel))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("tel", $tel);
		}
		if(!is_null($mobile))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("mobile", $mobile);
		}
		if(!is_null($mail))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("mail", $mail);
		}
		if(!is_null($profilepictureURL))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("profilepicture", $profilepictureURL);
		}
		if(!is_null($LatinName))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("latinname", $LatinName);
		}
		if(!is_null($LatinFamily))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("latinfamily", $LatinFamily);
		}
		if(!is_null($SignupTime))
		{
			$Query=$Query->AndLogic();
			$Query=$Query->Like("signuptime", $SignupTime);
		}
		return $Query->ExecuteAssociated();
	
	}

}

?>