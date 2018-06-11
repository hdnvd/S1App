<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_shifttypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-17 - 2018-04-06 21:17
*@lastUpdate 1397-01-17 - 2018-04-06 21:17
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageshifttypeController extends Controller {
	private $adminMode=true;
    public function getAdminMode()
    {
        return $this->adminMode;
    }
        /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$shifttypeEntityObject=new shift_shifttypeEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('shifttype_fid',$ID));
		$result['shifttype']=$shifttypeEntityObject;
		if($ID!=-1){
			$shifttypeEntityObject->setId($ID);
			if($shifttypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $shifttypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['shifttype']=$shifttypeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$valueinminutes,$abbreviation,$latinabbreviation,$isvisible,$holidayfactor)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$shifttypeEntityObject=new shift_shifttypeEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$valueinminutes,$abbreviation,$latinabbreviation,$isvisible,$holidayfactor],[$shifttypeEntityObject->getFieldInfo(shift_shifttypeEntity::$TITLE),$shifttypeEntityObject->getFieldInfo(shift_shifttypeEntity::$VALUEINMINUTES),$shifttypeEntityObject->getFieldInfo(shift_shifttypeEntity::$ABBREVIATION),$shifttypeEntityObject->getFieldInfo(shift_shifttypeEntity::$LATINABBREVIATION),$shifttypeEntityObject->getFieldInfo(shift_shifttypeEntity::$ISVISIBLE),$shifttypeEntityObject->getFieldInfo(shift_shifttypeEntity::$HOLIDAYFACTOR)]);
		if($ID==-1){
			$shifttypeEntityObject->setTitle($title);
			$shifttypeEntityObject->setValueinminutes($valueinminutes);
			$shifttypeEntityObject->setAbbreviation($abbreviation);
			$shifttypeEntityObject->setLatinabbreviation($latinabbreviation);
			$shifttypeEntityObject->setIsvisible($isvisible);
			$shifttypeEntityObject->setHolidayfactor($holidayfactor);
			$shifttypeEntityObject->Save();
			$ID=$shifttypeEntityObject->getId();
		}
		else{
			$shifttypeEntityObject->setId($ID);
			if($shifttypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $shifttypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$shifttypeEntityObject->setTitle($title);
			$shifttypeEntityObject->setValueinminutes($valueinminutes);
			$shifttypeEntityObject->setAbbreviation($abbreviation);
			$shifttypeEntityObject->setLatinabbreviation($latinabbreviation);
			$shifttypeEntityObject->setIsvisible($isvisible);
			$shifttypeEntityObject->setHolidayfactor($holidayfactor);
			$shifttypeEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('shifttype_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>