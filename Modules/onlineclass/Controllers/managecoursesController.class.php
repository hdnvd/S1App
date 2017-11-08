<?php
namespace Modules\onlineclass\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\onlineclass\Entity\onlineclass_courseEntity;
use Modules\onlineclass\Entity\onlineclass_tutorEntity;
use Modules\onlineclass\Entity\onlineclass_levelEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 21:18
*@lastUpdate 1396-07-25 - 2017-10-17 21:18
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managecoursesController extends courselistController {
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
		$courseEnt=new onlineclass_courseEntity($DBAccessor);
		$courseEnt->setId($ID);
		if($courseEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $courseEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$courseEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>