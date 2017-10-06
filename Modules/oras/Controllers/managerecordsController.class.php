<?php
namespace Modules\oras\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\oras\Entity\oras_recordEntity;
use Modules\oras\Entity\oras_shifttypeEntity;
use Modules\oras\Entity\oras_recordtypeEntity;
use Modules\oras\Entity\oras_employeeEntity;
use Modules\oras\Entity\oras_placeEntity;
use Modules\oras\Entity\oras_file1Entity;
use Modules\oras\Entity\oras_file2Entity;
use Modules\oras\Entity\oras_file3Entity;
use Modules\oras\Entity\oras_file4Entity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 03:03
*@lastUpdate 1396-07-12 - 2017-10-04 03:03
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managerecordsController extends recordlistController {
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
		$recordEnt=new oras_recordEntity($DBAccessor);
		$recordEnt->setId($ID);
		if($recordEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $recordEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$recordEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>