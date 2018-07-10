<?php
namespace Modules\finance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\finance\Entity\finance_payrequestEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-08 - 2017-11-29 15:33
*@lastUpdate 1396-09-08 - 2017-11-29 15:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managepayrequestsController extends payrequestlistController {
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
		$payrequestEnt=new finance_payrequestEntity($DBAccessor);
		$payrequestEnt->setId($ID);
		if($payrequestEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $payrequestEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$payrequestEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>