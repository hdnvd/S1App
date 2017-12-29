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
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-23 - 2017-12-14 01:18
*@lastUpdate 1396-09-23 - 2017-12-14 01:18
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedoctorplanController extends Controller {
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
		$doctorplanEntityObject=new ocms_doctorplanEntity($DBAccessor);
		$doctorEntityObject=new ocms_doctorEntity($DBAccessor);
		$result['doctor_fid']=$doctorEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('doctorplan_fid',$ID));
		$result['doctorplan']=$doctorplanEntityObject;
		if($ID!=-1){
			$doctorplanEntityObject->setId($ID);
			if($doctorplanEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $doctorplanEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['doctorplan']=$doctorplanEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$start_time,$end_time,$doctor_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$doctorplanEntityObject=new ocms_doctorplanEntity($DBAccessor);
		$this->ValidateFieldArray([$start_time,$end_time,$doctor_fid],[$doctorplanEntityObject->getFieldInfo(ocms_doctorplanEntity::$START_TIME),$doctorplanEntityObject->getFieldInfo(ocms_doctorplanEntity::$END_TIME),$doctorplanEntityObject->getFieldInfo(ocms_doctorplanEntity::$DOCTOR_FID)]);
		if($ID==-1){
			$doctorplanEntityObject->setStart_time($start_time);
			$doctorplanEntityObject->setEnd_time($end_time);
			$doctorplanEntityObject->setDoctor_fid($doctor_fid);
			$doctorplanEntityObject->Save();
			$ID=$doctorplanEntityObject->getId();
		}
		else{
			$doctorplanEntityObject->setId($ID);
			if($doctorplanEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $doctorplanEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$doctorplanEntityObject->setStart_time($start_time);
			$doctorplanEntityObject->setEnd_time($end_time);
			$doctorplanEntityObject->setDoctor_fid($doctor_fid);
			$doctorplanEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('doctorplan_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>