<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_servicerequestdeviceEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-16 - 2018-04-05 00:53
*@lastUpdate 1397-01-16 - 2018-04-05 00:53
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicerequestdevicesController extends servicerequestdevicelistController {
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
		$servicerequestdeviceEnt=new itsap_servicerequestdeviceEntity($DBAccessor);
		$servicerequestdeviceEnt->setId($ID);
		if($servicerequestdeviceEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $servicerequestdeviceEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$servicerequestdeviceEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>