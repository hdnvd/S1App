<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_visatypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:18
*@lastUpdate 1396-11-05 - 2018-01-25 18:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managevisatypesController extends visatypelistController {
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
		$visatypeEnt=new iribfinance_visatypeEntity($DBAccessor);
		$visatypeEnt->setId($ID);
		if($visatypeEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $visatypeEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$visatypeEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>