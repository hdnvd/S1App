<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/08
*/
namespace Modules\users\PublicClasses;
use Modules\users\Entity\userEntity;
use Modules\users\Entity\roleSystemUserEntity;
use core\CoreClasses\Forms\FormInfo;
use Modules\users\Entity\RoleSystemUserRoleEntity;
class sessionuser
{
	private $systemuserEntity=null;
	private $User;
	public function __construct()
	{
		$this->systemuserEntity=new roleSystemUserEntity();
		$this->User=new User($this->getSystemUserID());
	}
	public function getUserType()
	{
		return $this->User->getSystemUserRole();
	}
	
	public function getUserInfo($info)
	{
		return $this->User->getUserInfo($info);
	}
	public function getUserAccess(FormInfo $Form)
	{
		$id=$this->getSystemUserID();
		$AC=new AccessController();
		return $AC->getUserAccess($id, $Form->getModule(), $Form->getPage(), $Form->getAction()) ;
	}
	public function check_session_user()
	{
		if(session_id() == '')
			session_start();
		$user=$_SESSION['username'];
		$pass=$_SESSION['password'];
		return($this->systemuserEntity->checkUserPass($user,$pass));
	}
	public function getSystemUserID()
	{
		if(isset($_SESSION['username']))
		{
			$uname=$_SESSION['username'];
			return $this->systemuserEntity->getUserId($uname);
		}
		else
			return null;
	}
}

?>
