<?php
namespace Modules\users\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\users\Entity\users_menuitemEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-17 - 2018-04-06 23:29
*@lastUpdate 1397-01-17 - 2018-04-06 23:29
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managemenuitemsController extends menuitemlistController {
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
		$menuitemEnt=new users_menuitemEntity($DBAccessor);
		$menuitemEnt->setId($ID);
		if($menuitemEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $menuitemEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$menuitemEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
    public function Move($ID,$Place,$isUp)
    {
        if($Place=='')
            $Place=0;
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
        $menuitemEnt=new users_menuitemEntity($DBAccessor);
        $menuitemEnt->setId($ID);
        if($menuitemEnt->getId()==-1)
            throw new DataNotFoundException();
        if($UserID!=null && $menuitemEnt->getRole_systemuser_fid()!=$UserID)
            throw new DataNotFoundException();
        $MyPriority=$menuitemEnt->getPriority();
        $AllItems=$menuitemEnt->FindAll(new QueryLogic([],[users_menuitemEntity::$PRIORITY],[true]));
        if($isUp)
            $NextItem=$AllItems[$Place-1];
        else
            $NextItem=$AllItems[$Place+1];
        $NextItemPriority=$NextItem->GetPriority();
        if($NextItemPriority!=$MyPriority)
        {
            $menuitemEnt->setPriority($NextItemPriority);
            $NextItem->setPriority($MyPriority);
            $NextItem->Save();
        }
        else
        {
            if($isUp)
                $menuitemEnt->setPriority($MyPriority-1);
            else
                $menuitemEnt->setPriority($MyPriority+1);
        }
        $menuitemEnt->Save();
//        $menuitemEnt->Remove();
        $DBAccessor->close_connection();
        return $this->load(-1);
    }
}
?>