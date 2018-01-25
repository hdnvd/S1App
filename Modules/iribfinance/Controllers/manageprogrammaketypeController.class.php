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
use Modules\iribfinance\Entity\iribfinance_programmaketypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageprogrammaketypeController extends Controller {
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
		$programmaketypeEntityObject=new iribfinance_programmaketypeEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('programmaketype_fid',$ID));
		$result['programmaketype']=$programmaketypeEntityObject;
		if($ID!=-1){
			$programmaketypeEntityObject->setId($ID);
			if($programmaketypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $programmaketypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['programmaketype']=$programmaketypeEntityObject;
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
		$programmaketypeEntityObject=new iribfinance_programmaketypeEntity($DBAccessor);
		$this->ValidateFieldArray([$title],[$programmaketypeEntityObject->getFieldInfo(iribfinance_programmaketypeEntity::$TITLE)]);
		if($ID==-1){
			$programmaketypeEntityObject->setTitle($title);
			$programmaketypeEntityObject->Save();
			$ID=$programmaketypeEntityObject->getId();
		}
		else{
			$programmaketypeEntityObject->setId($ID);
			if($programmaketypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $programmaketypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$programmaketypeEntityObject->setTitle($title);
			$programmaketypeEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('programmaketype_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>