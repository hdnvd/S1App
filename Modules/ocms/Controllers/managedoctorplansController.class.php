<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\ocms\Entity\ocms_doctorEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_doctorplanEntity;
use Modules\users\PublicClasses\User;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedoctorplansController extends doctorplanlistController {
	private $PAGESIZE=10;
	public function DeleteItem($ID,$UserName,$Password)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
        $role_systemuser_fid=User::getSystemUserIDFromUserPass($UserName,$Password);
        $UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$doctorplanEnt=new ocms_doctorplanEntity($DBAccessor);
		$doctorplanEnt->setId($ID);
		if($doctorplanEnt->getId()==-1)
			throw new DataNotFoundException();

        $doctorEntityObject=new ocms_doctorEntity($DBAccessor);
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition(ocms_doctorEntity::$ROLE_SYSTEMUSER_FID,$role_systemuser_fid));
        $doctorEntityObject=$doctorEntityObject->FindOne($q);
        if($UserID!=null && $doctorplanEnt->getDoctor_fid()!=$doctorEntityObject->getId())
			throw new DataNotFoundException();
		$doctorplanEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1,$UserName,$Password);
	}
}
?>