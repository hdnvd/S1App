<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\shift\Entity\shift_personelEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_bakhshEntity;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-26 - 2018-01-16 19:13
*@lastUpdate 1396-10-26 - 2018-01-16 19:13
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managebakhshsController extends bakhshlistController {
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
		$bakhshEnt=new shift_bakhshEntity($DBAccessor);
		$bakhshEnt->setId($ID);
		if($bakhshEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $bakhshEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$bakhshEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>