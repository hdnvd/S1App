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
use Modules\itsap\Entity\itsap_topunitEntity;
use Modules\users\PublicClasses\User;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-17 - 2017-12-08 09:41
*@lastUpdate 1396-09-17 - 2017-12-08 09:41
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managetopunitController extends Controller {
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
		$topunitEntityObject=new itsap_topunitEntity($DBAccessor);
		$topunitEntityObject=new itsap_topunitEntity($DBAccessor);
		$result['topunit_fid']=$topunitEntityObject->FindAll(new QueryLogic());
        $topunit=new itsap_topunitEntity($DBAccessor);
		$topunit->setId(-1);
		$topunit->setTitle("بدون یگان مادر");
        $result['topunit_fid']=array_merge([$topunit],$result['topunit_fid']);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('topunit_fid',$ID));
		$result['topunit']=$topunitEntityObject;
		if($ID!=-1){
			$topunitEntityObject->setId($ID);
			if($topunitEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $topunitEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['topunit']=$topunitEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$topunit_fid,$title)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$topunitEntityObject=new itsap_topunitEntity($DBAccessor);
		$this->ValidateFieldArray([$topunit_fid,$title],[$topunitEntityObject->getFieldInfo(itsap_topunitEntity::$TOPUNIT_FID),$topunitEntityObject->getFieldInfo(itsap_topunitEntity::$TITLE)]);
		if($ID==-1){
			$topunitEntityObject->setTopunit_fid($topunit_fid);
			$topunitEntityObject->setTitle($title);
			$topunitEntityObject->Save();
			$ID=$topunitEntityObject->getId();
            $UserID=User::addUser("topunit".$ID."security","12345678910",$DBAccessor);
            User::setUserRole($UserID,9);
		}
		else{
			$topunitEntityObject->setId($ID);
			if($topunitEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $topunitEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$topunitEntityObject->setTopunit_fid($topunit_fid);
			$topunitEntityObject->setTitle($title);
			$topunitEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('topunit_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>