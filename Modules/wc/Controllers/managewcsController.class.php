<?php
namespace Modules\wc\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\wc\Entity\wc_wcEntity;
use Modules\wc\Entity\wc_cityEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-16 - 2017-10-08 14:43
*@lastUpdate 1396-07-16 - 2017-10-08 14:43
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managewcsController extends wclistController {
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
		$wcEnt=new wc_wcEntity($DBAccessor);
		$wcEnt->setId($ID);
		if($wcEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $wcEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$wcEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>