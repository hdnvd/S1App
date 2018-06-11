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
use Modules\ocms\Entity\ocms_doctorfileEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-06 - 2018-03-26 16:43
*@lastUpdate 1397-01-06 - 2018-03-26 16:43
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedoctorfileController extends Controller {
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
        $doctor_fid=$this->getDoctorIDFromSysUserID($DBAccessor,$role_systemuser_fid);
		$doctorfileEntityObject=new ocms_doctorfileEntity($DBAccessor);
		$doctorEntityObject=new ocms_doctorEntity($DBAccessor);
		$result['doctor_fid']=$doctorEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('doctorfile_fid',$ID));
		$result['doctorfile']=$doctorfileEntityObject;
		if($ID!=-1){
			$doctorfileEntityObject->setId($ID);
			if($doctorfileEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $doctorfileEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			if($doctor_fid!=$doctorfileEntityObject->getDoctor_fid())
			    throw new DataNotFoundException();
			$result['doctorfile']=$doctorfileEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public static function getDoctorIDFromSysUserID(dbaccess $DBAccessor,$role_systemuser_fid)
    {
        $doctorEnt=new ocms_doctorEntity($DBAccessor);
        $doctorEnt=$doctorEnt->FindOne(new QueryLogic([new FieldCondition(ocms_doctorEntity::$ROLE_SYSTEMUSER_FID,$role_systemuser_fid)]));
        if($doctorEnt==null || $doctorEnt->getId()<=0)
            throw new DataNotFoundException();
        $doctor_fid=$doctorEnt->getId();
        return $doctor_fid;
    }
	public function BtnSave($ID,$file_flu,$description,$doctor_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
        $doctor_fid=$this->getDoctorIDFromSysUserID($DBAccessor,$role_systemuser_fid);
		$doctorfileEntityObject=new ocms_doctorfileEntity($DBAccessor);
		$file_fluURL='';
		if($file_flu!=null && count($file_flu)>0)
			$file_fluURL=$file_flu[0]['url'];
		$this->ValidateFieldArray([$file_fluURL,$description,$doctor_fid],[$doctorfileEntityObject->getFieldInfo(ocms_doctorfileEntity::$FILE_FLU),$doctorfileEntityObject->getFieldInfo(ocms_doctorfileEntity::$DESCRIPTION),$doctorfileEntityObject->getFieldInfo(ocms_doctorfileEntity::$DOCTOR_FID)]);
		if($ID==-1){
			if($file_fluURL!='')
			$doctorfileEntityObject->setFile_flu($file_fluURL);
			$doctorfileEntityObject->setDescription($description);
			$doctorfileEntityObject->setDoctor_fid($doctor_fid);
			$doctorfileEntityObject->setRole_systemuser_fid($role_systemuser_fid);
			$doctorfileEntityObject->Save();
			$ID=$doctorfileEntityObject->getId();
		}
		else{
			$doctorfileEntityObject->setId($ID);
			if($doctorfileEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $doctorfileEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			if($file_fluURL!='')
			$doctorfileEntityObject->setFile_flu($file_fluURL);
			$doctorfileEntityObject->setDescription($description);
            $doctorfileEntityObject->setRole_systemuser_fid($role_systemuser_fid);
			$doctorfileEntityObject->setDoctor_fid($doctor_fid);
			$doctorfileEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('doctorfile_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>