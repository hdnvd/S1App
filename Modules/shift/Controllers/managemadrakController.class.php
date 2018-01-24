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
use Modules\shift\Entity\shift_madrakEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-26 - 2018-01-16 20:27
*@lastUpdate 1396-10-26 - 2018-01-16 20:27
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managemadrakController extends Controller {
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
		$madrakEntityObject=new shift_madrakEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('madrak_fid',$ID));
		$result['madrak']=$madrakEntityObject;
		if($ID!=-1){
			$madrakEntityObject->setId($ID);
			if($madrakEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $madrakEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['madrak']=$madrakEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$zarib)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$madrakEntityObject=new shift_madrakEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$zarib],[$madrakEntityObject->getFieldInfo(shift_madrakEntity::$TITLE),$madrakEntityObject->getFieldInfo(shift_madrakEntity::$ZARIB)]);
		if($ID==-1){
			$madrakEntityObject->setTitle($title);
			$madrakEntityObject->setZarib($zarib);
			$madrakEntityObject->Save();
			$ID=$madrakEntityObject->getId();
		}
		else{
			$madrakEntityObject->setId($ID);
			if($madrakEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $madrakEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$madrakEntityObject->setTitle($title);
			$madrakEntityObject->setZarib($zarib);
			$madrakEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('madrak_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>