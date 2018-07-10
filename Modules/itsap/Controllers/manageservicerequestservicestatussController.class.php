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
use Modules\itsap\Entity\itsap_servicerequestservicestatusEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-17 - 2017-12-08 09:41
*@lastUpdate 1396-09-17 - 2017-12-08 09:41
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicerequestservicestatussController extends servicerequestservicestatuslistController {
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
		$servicerequestservicestatusEnt=new itsap_servicerequestservicestatusEntity($DBAccessor);
		$servicerequestservicestatusEnt->setId($ID);
		if($servicerequestservicestatusEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $servicerequestservicestatusEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$servicerequestservicestatusEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>