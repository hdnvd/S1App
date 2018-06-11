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
use Modules\itsap\Entity\itsap_servicetypegroupEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-13 - 2018-04-02 01:58
*@lastUpdate 1397-01-13 - 2018-04-02 01:58
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicetypegroupsController extends servicetypegrouplistController {
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
		$servicetypegroupEnt=new itsap_servicetypegroupEntity($DBAccessor);
		$servicetypegroupEnt->setId($ID);
		if($servicetypegroupEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $servicetypegroupEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$servicetypegroupEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>