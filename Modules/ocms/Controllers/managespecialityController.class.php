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
use Modules\ocms\Entity\ocms_specialityEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-30 - 2017-12-21 18:36
*@lastUpdate 1396-09-30 - 2017-12-21 18:36
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managespecialityController extends Controller {
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
		$specialityEntityObject=new ocms_specialityEntity($DBAccessor);
		$specialityEntityObject=new ocms_specialityEntity($DBAccessor);
		$result['speciality_fid']=$specialityEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('speciality_fid',$ID));
		$result['speciality']=$specialityEntityObject;
		if($ID!=-1){
			$specialityEntityObject->setId($ID);
			if($specialityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $specialityEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['speciality']=$specialityEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$speciality_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$specialityEntityObject=new ocms_specialityEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$speciality_fid],[$specialityEntityObject->getFieldInfo(ocms_specialityEntity::$TITLE),$specialityEntityObject->getFieldInfo(ocms_specialityEntity::$SPECIALITY_FID)]);
		if($ID==-1){
			$specialityEntityObject->setTitle($title);
			$specialityEntityObject->setSpeciality_fid($speciality_fid);
			$specialityEntityObject->Save();
			$ID=$specialityEntityObject->getId();
		}
		else{
			$specialityEntityObject->setId($ID);
			if($specialityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $specialityEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$specialityEntityObject->setTitle($title);
			$specialityEntityObject->setSpeciality_fid($speciality_fid);
			$specialityEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('speciality_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>