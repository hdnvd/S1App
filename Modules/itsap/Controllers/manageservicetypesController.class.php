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
use Modules\itsap\Entity\itsap_servicetypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-07-26 - 2018-10-18 17:12
*@lastUpdate 1397-07-26 - 2018-10-18 17:12
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicetypesController extends servicetypelistController {
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
		$servicetypeEnt=new itsap_servicetypeEntity($DBAccessor);
		$servicetypeEnt->setId($ID);
		if($servicetypeEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $servicetypeEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$servicetypeEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>