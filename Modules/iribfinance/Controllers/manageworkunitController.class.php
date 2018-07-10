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
use Modules\iribfinance\Entity\iribfinance_workunitEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageworkunitController extends Controller {
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
		$workunitEntityObject=new iribfinance_workunitEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('workunit_fid',$ID));
		$result['workunit']=$workunitEntityObject;
		if($ID!=-1){
			$workunitEntityObject->setId($ID);
			if($workunitEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $workunitEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['workunit']=$workunitEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$minutes)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$workunitEntityObject=new iribfinance_workunitEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$minutes],[$workunitEntityObject->getFieldInfo(iribfinance_workunitEntity::$TITLE),$workunitEntityObject->getFieldInfo(iribfinance_workunitEntity::$MINUTES)]);
		if($ID==-1){
			$workunitEntityObject->setTitle($title);
			$workunitEntityObject->setMinutes($minutes);
			$workunitEntityObject->Save();
			$ID=$workunitEntityObject->getId();
		}
		else{
			$workunitEntityObject->setId($ID);
			if($workunitEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $workunitEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$workunitEntityObject->setTitle($title);
			$workunitEntityObject->setMinutes($minutes);
			$workunitEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('workunit_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>