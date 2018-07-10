<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_roleEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-27 - 2018-01-17 15:45
*@lastUpdate 1396-10-27 - 2018-01-17 15:45
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managerolesController extends rolelistController {
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
		$roleEnt=new shift_roleEntity($DBAccessor);
		$roleEnt->setId($ID);
		if($roleEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $roleEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$roleEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>