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
use Modules\shift\Entity\shift_shifttypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-17 - 2018-04-06 21:17
*@lastUpdate 1397-01-17 - 2018-04-06 21:17
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageshifttypesController extends shifttypelistController {
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
		$shifttypeEnt=new shift_shifttypeEntity($DBAccessor);
		$shifttypeEnt->setId($ID);
		if($shifttypeEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $shifttypeEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$shifttypeEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>