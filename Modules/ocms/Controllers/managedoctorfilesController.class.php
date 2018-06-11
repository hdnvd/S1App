<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_doctorfileEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-06 - 2018-03-26 16:43
*@lastUpdate 1397-01-06 - 2018-03-26 16:43
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedoctorfilesController extends doctorfilelistController {
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
		$doctorfileEnt=new ocms_doctorfileEntity($DBAccessor);
		$doctorfileEnt->setId($ID);
        $doctor_fid=managedoctorfileController::getDoctorIDFromSysUserID($DBAccessor,$role_systemuser_fid);

        if($doctorfileEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $doctorfileEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
        if($doctor_fid!=$doctorfileEnt->getDoctor_fid())
            throw new DataNotFoundException();
		$doctorfileEnt->Remove();
		unlink(DEFAULT_PUBLICPATH . $doctorfileEnt->getFile_flu());
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>