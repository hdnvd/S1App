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
use Modules\shift\Entity\shift_dateEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-27 - 2018-01-17 00:24
*@lastUpdate 1396-10-27 - 2018-01-17 00:24
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedateController extends Controller {
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
		$dateEntityObject=new shift_dateEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('date_fid',$ID));
		$result['date']=$dateEntityObject;
		if($ID!=-1){
			$dateEntityObject->setId($ID);
			if($dateEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $dateEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['date']=$dateEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$day_date,$score)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$dateEntityObject=new shift_dateEntity($DBAccessor);
		$this->ValidateFieldArray([$day_date,$score],[$dateEntityObject->getFieldInfo(shift_dateEntity::$DAY_DATE),$dateEntityObject->getFieldInfo(shift_dateEntity::$SCORE)]);
		if($ID==-1){
			$dateEntityObject->setDay_date($day_date);
			$dateEntityObject->setScore($score);
			$dateEntityObject->Save();
			$ID=$dateEntityObject->getId();
		}
		else{
			$dateEntityObject->setId($ID);
			if($dateEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $dateEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$dateEntityObject->setDay_date($day_date);
			$dateEntityObject->setScore($score);
			$dateEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('date_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>