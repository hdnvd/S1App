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
use Modules\iribfinance\Entity\iribfinance_regionEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:22
*@lastUpdate 1396-11-05 - 2018-01-25 18:22
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageregionController extends Controller {
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
		$regionEntityObject=new iribfinance_regionEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('region_fid',$ID));
		$result['region']=$regionEntityObject;
		if($ID!=-1){
			$regionEntityObject->setId($ID);
			if($regionEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $regionEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['region']=$regionEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$regionEntityObject=new iribfinance_regionEntity($DBAccessor);
		$this->ValidateFieldArray([$title],[$regionEntityObject->getFieldInfo(iribfinance_regionEntity::$TITLE)]);
		if($ID==-1){
			$regionEntityObject->setTitle($title);
			$regionEntityObject->Save();
			$ID=$regionEntityObject->getId();
		}
		else{
			$regionEntityObject->setId($ID);
			if($regionEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $regionEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$regionEntityObject->setTitle($title);
			$regionEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('region_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>