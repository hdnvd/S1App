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
use Modules\users\Entity\users_menuitemEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-20 - 2018-02-09 00:17
*@lastUpdate 1396-11-20 - 2018-02-09 00:17
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managemenuitemsController extends menuitemlistController {
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
		$menuitemEnt=new users_menuitemEntity($DBAccessor);
		$menuitemEnt->setId($ID);
		if($menuitemEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $menuitemEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$menuitemEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>