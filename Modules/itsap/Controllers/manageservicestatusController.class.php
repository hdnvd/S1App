<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_servicestatusEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-17 - 2017-12-08 09:41
*@lastUpdate 1396-09-17 - 2017-12-08 09:41
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicestatusController extends Controller {
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
		$servicestatusEntityObject=new itsap_servicestatusEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicestatus_fid',$ID));
		$result['servicestatus']=$servicestatusEntityObject;
		if($ID!=-1){
			$servicestatusEntityObject->setId($ID);
			if($servicestatusEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $servicestatusEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['servicestatus']=$servicestatusEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$iscommited)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$servicestatusEntityObject=new itsap_servicestatusEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$iscommited],[$servicestatusEntityObject->getFieldInfo(itsap_servicestatusEntity::$TITLE),$servicestatusEntityObject->getFieldInfo(itsap_servicestatusEntity::$ISCOMMITED)]);
		if($ID==-1){
			$servicestatusEntityObject->setTitle($title);
			$servicestatusEntityObject->setIscommited($iscommited);
			$servicestatusEntityObject->Save();
			$ID=$servicestatusEntityObject->getId();
		}
		else{
			$servicestatusEntityObject->setId($ID);
			if($servicestatusEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $servicestatusEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$servicestatusEntityObject->setTitle($title);
			$servicestatusEntityObject->setIscommited($iscommited);
			$servicestatusEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicestatus_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>