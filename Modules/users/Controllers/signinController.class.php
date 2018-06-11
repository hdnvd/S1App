<?php

namespace Modules\users\Controllers;

use core\CoreClasses\db\dbaccess;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\services\Controller;
use Modules\users\Entity\roleSystemUserEntity;
use Modules\parameters\PublicClasses\ParameterManager;
use Modules\users\Entity\users_systemroleEntity;
use Modules\users\Entity\users_systemuserroleEntity;
use Modules\users\Exceptions\UserHasNoRoleException;

/**
 *
 * @author nahavandi
 *        
 */
class signinController extends Controller {
    public function load()
    {
        $result['showsignup']=ParameterManager::getParameter("users_showsignuplink");
        $result['signupmodule']=ParameterManager::getParameter("users_signupmodule");
        $result['signuppage']=ParameterManager::getParameter("users_signuppage");
        if($result['showsignup']==null || $result['showsignup']!=true)
            $result['showsignup']=false;
        return $result;
    }
	public function getUserID($Username,$Password)
	{
        $DBAccessor=new dbaccess();
		$ent=new roleSystemUserEntity($DBAccessor);
		$isTrue=$ent->checkUserPass($Username, $Password);
		if($isTrue)
			$userid=$ent->getUserId($Username);
		else 
			$userid=null;
        $DBAccessor->close_connection();
		return $userid;
	}
	public function getUserIndex($SystemUserID)
	{
        $DBAccessor=new dbaccess();
		$ent1=new users_systemuserroleEntity($DBAccessor);
        $ent1=$ent1->FindOne(new QueryLogic([new FieldCondition(users_systemuserroleEntity::$SYSTEMUSER_FID,$SystemUserID)]));
        if($ent1!=null)
		    $RoleID=$ent1->getSystemrole_fid();
        else
            throw new UserHasNoRoleException();
		$ent=new users_systemroleEntity($DBAccessor);
		//print_r($Userrole);
        $ent->setId($RoleID);

		$result['module']=$ent->getDefaultmodule();
		$result['page']=$ent->getDefaultpage();
		$result['parameters']=$ent->getIndexparameters();
		$DBAccessor->close_connection();
		//print_r($result);
		return $result;
	}
	
}

?>