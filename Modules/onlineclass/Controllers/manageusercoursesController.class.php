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
use Modules\onlineclass\Entity\onlineclass_usercourseEntity;
use Modules\onlineclass\Entity\onlineclass_userEntity;
use Modules\onlineclass\Entity\onlineclass_courseEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-26 - 2017-10-18 16:38
*@lastUpdate 1396-07-26 - 2017-10-18 16:38
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageusercoursesController extends usercourselistController {
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
		$usercourseEnt=new onlineclass_usercourseEntity($DBAccessor);
		$usercourseEnt->setId($ID);
		if($usercourseEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $usercourseEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$usercourseEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>