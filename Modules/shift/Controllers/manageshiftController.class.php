<?php
namespace Modules\shift\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\shift\Entity\shift_inputfileEntity;
use Modules\shift\Entity\shift_personelEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\shift\Entity\shift_shiftEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-28 - 2018-01-18 18:55
*@lastUpdate 1396-10-28 - 2018-01-18 18:55
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageshiftController extends Controller {
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
		$shiftEntityObject=new shift_shiftEntity($DBAccessor);
		$personelEntityObject=new shift_personelEntity($DBAccessor);
		$result['personel_fid']=$personelEntityObject->FindAll(new QueryLogic());
		$inputfileEntityObject=new shift_inputfileEntity($DBAccessor);
		$result['inputfile_fid']=$inputfileEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('shift_fid',$ID));
		$result['shift']=$shiftEntityObject;
		if($ID!=-1){
			$shiftEntityObject->setId($ID);
			if($shiftEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $shiftEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['shift']=$shiftEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$shifttype,$due_date,$register_date,$personel_fid,$inputfile_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$shiftEntityObject=new shift_shiftEntity($DBAccessor);
		$this->ValidateFieldArray([$shifttype,$due_date,$register_date,$personel_fid,$inputfile_fid],[$shiftEntityObject->getFieldInfo(shift_shiftEntity::$SHIFTTYPE),$shiftEntityObject->getFieldInfo(shift_shiftEntity::$DUE_DATE),$shiftEntityObject->getFieldInfo(shift_shiftEntity::$REGISTER_DATE),$shiftEntityObject->getFieldInfo(shift_shiftEntity::$PERSONEL_FID),$shiftEntityObject->getFieldInfo(shift_shiftEntity::$INPUTFILE_FID)]);
		if($ID==-1){
			$shiftEntityObject->setShifttype($shifttype);
			$shiftEntityObject->setDue_date($due_date);
			$shiftEntityObject->setRegister_date($register_date);
			$shiftEntityObject->setPersonel_fid($personel_fid);
			$shiftEntityObject->setInputfile_fid($inputfile_fid);
			$shiftEntityObject->Save();
			$ID=$shiftEntityObject->getId();
		}
		else{
			$shiftEntityObject->setId($ID);
			if($shiftEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $shiftEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$shiftEntityObject->setShifttype($shifttype);
			$shiftEntityObject->setDue_date($due_date);
			$shiftEntityObject->setRegister_date($register_date);
			$shiftEntityObject->setPersonel_fid($personel_fid);
			$shiftEntityObject->setInputfile_fid($inputfile_fid);
			$shiftEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('shift_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>