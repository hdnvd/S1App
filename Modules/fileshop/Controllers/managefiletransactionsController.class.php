<?php
namespace Modules\fileshop\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\fileshop\Entity\fileshop_filetransactionEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-09 - 2017-11-30 16:35
*@lastUpdate 1396-09-09 - 2017-11-30 16:35
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managefiletransactionsController extends filetransactionlistController {
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
		$filetransactionEnt=new fileshop_filetransactionEntity($DBAccessor);
		$filetransactionEnt->setId($ID);
		if($filetransactionEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $filetransactionEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$filetransactionEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>