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
use Modules\shift\Entity\shift_personelEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-28 - 2018-01-18 17:32
*@lastUpdate 1396-10-28 - 2018-01-18 17:32
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managepersonelsController extends personellistController {
	private $PAGESIZE=30;
	public function DeleteItem($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$personelEnt=new shift_personelEntity($DBAccessor);
		$personelEnt->setId($ID);
		if($personelEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $personelEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$personelEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>