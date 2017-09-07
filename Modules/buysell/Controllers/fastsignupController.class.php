<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_userEntity;
use Modules\buysell\Exceptions\nosamepassException;
use Modules\common\Entity\common_cityEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Entity\roleSystemUserEntity;
use Modules\users\Entity\RoleSystemUserRoleEntity;
use Modules\users\Exceptions\UsernameExistsException;

/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-20 - 2017-02-08 16:00
*@lastUpdate 1395-11-20 - 2017-02-08 16:00
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class fastsignupController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $CityEnt=new common_cityEntity($DBAccessor);
		$result['city']=$CityEnt->Select(null,null,null,null,array('title'),array(false),"0,1000");
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSignup($txtName,$txtEmail,$txtMobile,$cmbCity,$txtpassword,$txtpassword2)
	{
	    if($txtpassword!=$txtpassword2)
            throw new nosamepassException();
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $sysUserEnt=new roleSystemUserEntity($DBAccessor);
        $UserEnt=new buysell_userEntity($DBAccessor);
        $DBAccessor->beginTransaction();
        $found=$sysUserEnt->Select(array("username"),array($txtMobile));
        if($found!=null)
            throw new UsernameExistsException();

        $id=$sysUserEnt->Add($txtMobile,$txtpassword);
        $roleEnt=new RoleSystemUserRoleEntity();
        $roleEnt->addUserRole($id,5);
        $UserEnt->setName($txtName);
        $UserEnt->setEmail($txtEmail);
        $UserEnt->setMob($txtMobile);
        $UserEnt->setCommon_city_fid($cmbCity);
        $UserEnt->setRole_systemuser_fid($id);
        $UserEnt->setIsmale(-1);
        $UserEnt->setCarmodel_fid(-1);
        $UserEnt->setSignupdate(time());
        $UserEnt->Save();
        $DBAccessor->commit();
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>