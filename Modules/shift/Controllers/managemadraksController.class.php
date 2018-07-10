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
use Modules\shift\Entity\shift_madrakEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-26 - 2018-01-16 20:27
*@lastUpdate 1396-10-26 - 2018-01-16 20:27
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managemadraksController extends madraklistController {
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
		$madrakEnt=new shift_madrakEntity($DBAccessor);
		$madrakEnt->setId($ID);
		if($madrakEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $madrakEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$madrakEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>