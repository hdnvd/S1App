<?php
/*
 *@Author:Hadi AmirNahavandi
*@Last Update:2014/5/08
*/
namespace Modules\users\PublicClasses;
use core\CoreClasses\db\dbaccess;
use Modules\users\Entity\roleSystemUserEntity;
use core\CoreClasses\Forms\FormInfo;
class sessionuser
{
	private $User;
	public function __construct()
	{
		$this->User=new User($this->getSystemUserID());
	}
	public function getUserType()
	{
		$roles=$this->User->getSystemUserRoles();
		return $roles[0];
	}

    /**
     * @return \Modules\users\Entity\users_userEntity
     */
    public function getUser()
	{
		return $this->User->getUser();
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
		$dbAccess=new dbaccess();
        $systemuserEntity=new roleSystemUserEntity($dbAccess);
		$res=($systemuserEntity->checkUserPass($user,$pass));
		$dbAccess->close_connection();
		return $dbAccess;
	}
	public function getSystemUserID()
	{
        $dbAccess=new dbaccess();
        $systemuserEntity=new roleSystemUserEntity($dbAccess);
		if(isset($_SESSION['username']))
		{
			$uname=$_SESSION['username'];
			$res= $systemuserEntity->getUserId($uname);
		}
		else
			$res= null;
        $dbAccess->close_connection();
        return $res;
	}
}

?>
