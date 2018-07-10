<?php

namespace Modules\users\Controllers;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\services\Controller;
use Modules\users\Entity\users_systemuserEntity;
use Modules\users\Entity\users_userEntity;
use Modules\users\PublicClasses\sessionuser;
use Modules\users\Entity\roleSystemUserEntity;
use Modules\users\Exceptions\CurrentPasswordNotMatched;
use Modules\users\PublicClasses\User;


class changepasswordController extends Controller {
	public function load()
	{
		return null;
	}
	public function changepass($OldPass,$NewPass)
	{
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
        $oldUser=new users_systemuserEntity($DBAccessor);
		$oldUser=$oldUser->FindOne(new QueryLogic([new FieldCondition(users_systemuserEntity::$ID,$su->getSystemUserID())]));
		if($oldUser!=null && $oldUser->getId()>0 && $oldUser->isPasswordTrue($OldPass))
		{
			User::UpdatePassword($oldUser->getId(),$NewPass,$DBAccessor);
            $DBAccessor->close_connection();
		}
		else 
			throw new CurrentPasswordNotMatched();
	}
}
?>
