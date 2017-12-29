<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_topunitEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_unitEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-17 - 2017-12-08 09:41
*@lastUpdate 1396-09-17 - 2017-12-08 09:41
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageunitController extends Controller {
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
		$unitEntityObject=new itsap_unitEntity($DBAccessor);
		$topunitEntityObject=new itsap_topunitEntity($DBAccessor);
		$result['topunit_fid']=$topunitEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('unit_fid',$ID));
		$result['unit']=$unitEntityObject;
		if($ID!=-1){
			$unitEntityObject->setId($ID);
			if($unitEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $unitEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['unit']=$unitEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$topunit_fid,$title,$isfava)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$unitEntityObject=new itsap_unitEntity($DBAccessor);
		$this->ValidateFieldArray([$topunit_fid,$title,$isfava],[$unitEntityObject->getFieldInfo(itsap_unitEntity::$TOPUNIT_FID),$unitEntityObject->getFieldInfo(itsap_unitEntity::$TITLE),$unitEntityObject->getFieldInfo(itsap_unitEntity::$ISFAVA)]);
		if($ID==-1){
			$unitEntityObject->setTopunit_fid($topunit_fid);
			$unitEntityObject->setTitle($title);
			$unitEntityObject->setIsfava($isfava);
			$unitEntityObject->Save();
			$ID=$unitEntityObject->getId();
		}
		else{
			$unitEntityObject->setId($ID);
			if($unitEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $unitEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$unitEntityObject->setTopunit_fid($topunit_fid);
			$unitEntityObject->setTitle($title);
			$unitEntityObject->setIsfava($isfava);
			$unitEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('unit_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>