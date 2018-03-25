<?php
namespace Modules\users\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\users\Entity\users_systemtaskEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-24 - 2018-02-13 22:37
*@lastUpdate 1396-11-24 - 2018-02-13 22:37
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managesystemtasksController extends systemtasklistController {
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
		$systemtaskEnt=new users_systemtaskEntity($DBAccessor);
		$systemtaskEnt->setId($ID);
		if($systemtaskEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $systemtaskEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$systemtaskEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>