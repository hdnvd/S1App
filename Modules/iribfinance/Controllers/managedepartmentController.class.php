<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\iribfinance\Entity\iribfinance_regionEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_departmentEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:22
*@lastUpdate 1396-11-05 - 2018-01-25 18:22
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedepartmentController extends Controller {
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
		$departmentEntityObject=new iribfinance_departmentEntity($DBAccessor);
		$regionEntityObject=new iribfinance_regionEntity($DBAccessor);
		$result['region_fid']=$regionEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('department_fid',$ID));
		$result['department']=$departmentEntityObject;
		if($ID!=-1){
			$departmentEntityObject->setId($ID);
			if($departmentEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $departmentEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['department']=$departmentEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$region_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$departmentEntityObject=new iribfinance_departmentEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$region_fid],[$departmentEntityObject->getFieldInfo(iribfinance_departmentEntity::$TITLE),$departmentEntityObject->getFieldInfo(iribfinance_departmentEntity::$REGION_FID)]);
		if($ID==-1){
			$departmentEntityObject->setTitle($title);
			$departmentEntityObject->setRegion_fid($region_fid);
			$departmentEntityObject->Save();
			$ID=$departmentEntityObject->getId();
		}
		else{
			$departmentEntityObject->setId($ID);
			if($departmentEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $departmentEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$departmentEntityObject->setTitle($title);
			$departmentEntityObject->setRegion_fid($region_fid);
			$departmentEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('department_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>