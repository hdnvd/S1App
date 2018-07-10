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
use Modules\shift\Entity\shift_morakhasiEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-26 - 2018-01-16 20:22
*@lastUpdate 1396-10-26 - 2018-01-16 20:22
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managemorakhasiController extends Controller {
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
		$morakhasiEntityObject=new shift_morakhasiEntity($DBAccessor);
		$personelEntityObject=new shift_personelEntity($DBAccessor);
		$result['personel_fid']=$personelEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('morakhasi_fid',$ID));
		$result['morakhasi']=$morakhasiEntityObject;
		if($ID!=-1){
			$morakhasiEntityObject->setId($ID);
			if($morakhasiEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $morakhasiEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['morakhasi']=$morakhasiEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$elat,$doctor,$start_time,$end_time,$add_time,$morakhasi_type,$personel_fid,$mahal)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$morakhasiEntityObject=new shift_morakhasiEntity($DBAccessor);
		$this->ValidateFieldArray([$elat,$doctor,$start_time,$end_time,$add_time,$morakhasi_type,$personel_fid,$mahal],[$morakhasiEntityObject->getFieldInfo(shift_morakhasiEntity::$ELAT),$morakhasiEntityObject->getFieldInfo(shift_morakhasiEntity::$DOCTOR),$morakhasiEntityObject->getFieldInfo(shift_morakhasiEntity::$START_TIME),$morakhasiEntityObject->getFieldInfo(shift_morakhasiEntity::$END_TIME),$morakhasiEntityObject->getFieldInfo(shift_morakhasiEntity::$ADD_TIME),$morakhasiEntityObject->getFieldInfo(shift_morakhasiEntity::$MORAKHASI_TYPE),$morakhasiEntityObject->getFieldInfo(shift_morakhasiEntity::$PERSONEL_FID),$morakhasiEntityObject->getFieldInfo(shift_morakhasiEntity::$MAHAL)]);
		if($ID==-1){
			$morakhasiEntityObject->setElat($elat);
			$morakhasiEntityObject->setDoctor($doctor);
			$morakhasiEntityObject->setStart_time($start_time);
			$morakhasiEntityObject->setEnd_time($end_time);
			$morakhasiEntityObject->setAdd_time($add_time);
			$morakhasiEntityObject->setMorakhasi_type($morakhasi_type);
			$morakhasiEntityObject->setPersonel_fid($personel_fid);
			$morakhasiEntityObject->setMahal($mahal);
			$morakhasiEntityObject->Save();
			$ID=$morakhasiEntityObject->getId();
		}
		else{
			$morakhasiEntityObject->setId($ID);
			if($morakhasiEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $morakhasiEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$morakhasiEntityObject->setElat($elat);
			$morakhasiEntityObject->setDoctor($doctor);
			$morakhasiEntityObject->setStart_time($start_time);
			$morakhasiEntityObject->setEnd_time($end_time);
			$morakhasiEntityObject->setAdd_time($add_time);
			$morakhasiEntityObject->setMorakhasi_type($morakhasi_type);
			$morakhasiEntityObject->setPersonel_fid($personel_fid);
			$morakhasiEntityObject->setMahal($mahal);
			$morakhasiEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('morakhasi_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>