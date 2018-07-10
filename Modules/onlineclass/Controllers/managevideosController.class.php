<?php
namespace Modules\onlineclass\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\onlineclass\Entity\onlineclass_videoEntity;
use Modules\onlineclass\Entity\onlineclass_courseEntity;
use Modules\onlineclass\Entity\onlineclass_hdvideoEntity;
use Modules\onlineclass\Entity\onlineclass_sdvideoEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 15:59
*@lastUpdate 1396-07-25 - 2017-10-17 15:59
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managevideosController extends videolistController {
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
		$videoEnt=new onlineclass_videoEntity($DBAccessor);
		$videoEnt->setId($ID);
		if($videoEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $videoEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$videoEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>