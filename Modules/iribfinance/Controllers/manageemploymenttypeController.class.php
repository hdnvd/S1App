<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_employmenttypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageemploymenttypeController extends Controller {
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
		$employmenttypeEntityObject=new iribfinance_employmenttypeEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('employmenttype_fid',$ID));
		$result['employmenttype']=$employmenttypeEntityObject;
		if($ID!=-1){
			$employmenttypeEntityObject->setId($ID);
			if($employmenttypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $employmenttypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['employmenttype']=$employmenttypeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$taxfactor)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$employmenttypeEntityObject=new iribfinance_employmenttypeEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$taxfactor],[$employmenttypeEntityObject->getFieldInfo(iribfinance_employmenttypeEntity::$TITLE),$employmenttypeEntityObject->getFieldInfo(iribfinance_employmenttypeEntity::$TAXFACTOR)]);
		if($ID==-1){
			$employmenttypeEntityObject->setTitle($title);
			$employmenttypeEntityObject->setTaxfactor($taxfactor);
			$employmenttypeEntityObject->Save();
			$ID=$employmenttypeEntityObject->getId();
		}
		else{
			$employmenttypeEntityObject->setId($ID);
			if($employmenttypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $employmenttypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$employmenttypeEntityObject->setTitle($title);
			$employmenttypeEntityObject->setTaxfactor($taxfactor);
			$employmenttypeEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('employmenttype_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>