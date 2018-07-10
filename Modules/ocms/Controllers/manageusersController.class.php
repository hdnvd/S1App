<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_userEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageusersController extends userlistController {
	private $PAGESIZE=10;
	public function DeleteItem($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$userEnt=new ocms_userEntity($DBAccessor);
		$userEnt->setId($ID);
		if($userEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $userEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$userEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>