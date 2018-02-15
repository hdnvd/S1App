<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\shift\Entity\shift_shiftEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_inputfileEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-24 - 2018-02-13 10:17
*@lastUpdate 1396-11-24 - 2018-02-13 10:17
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageinputfilesController extends inputfilelistController {
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
		$inputfileEnt=new shift_inputfileEntity($DBAccessor);
		$inputfileEnt->setId($ID);
		if($inputfileEnt->getId()==-1)
			throw new DataNotFoundException();
		$Shifts=new shift_shiftEntity($DBAccessor);
		$All=$Shifts->FindAll(new QueryLogic([new FieldCondition(shift_shiftEntity::$INPUTFILE_FID,$ID)]));
        $AllCount1 = count($All);
        for ($i = 0; $i < $AllCount1; $i++) {
            $All[$i]->Remove();
        }
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>