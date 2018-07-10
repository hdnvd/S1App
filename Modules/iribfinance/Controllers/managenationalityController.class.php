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
use Modules\iribfinance\Entity\iribfinance_nationalityEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managenationalityController extends Controller {
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
		$nationalityEntityObject=new iribfinance_nationalityEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('nationality_fid',$ID));
		$result['nationality']=$nationalityEntityObject;
		if($ID!=-1){
			$nationalityEntityObject->setId($ID);
			if($nationalityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $nationalityEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['nationality']=$nationalityEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$flag_flu)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$nationalityEntityObject=new iribfinance_nationalityEntity($DBAccessor);
		$flag_fluURL='';
		if($flag_flu!=null && count($flag_flu)>0)
			$flag_fluURL=$flag_flu[0]['url'];
		$this->ValidateFieldArray([$title,$flag_fluURL],[$nationalityEntityObject->getFieldInfo(iribfinance_nationalityEntity::$TITLE),$nationalityEntityObject->getFieldInfo(iribfinance_nationalityEntity::$FLAG_FLU)]);
		if($ID==-1){
			$nationalityEntityObject->setTitle($title);
			if($flag_fluURL!='')
			$nationalityEntityObject->setFlag_flu($flag_fluURL);
			$nationalityEntityObject->Save();
			$ID=$nationalityEntityObject->getId();
		}
		else{
			$nationalityEntityObject->setId($ID);
			if($nationalityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $nationalityEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$nationalityEntityObject->setTitle($title);
			if($flag_fluURL!='')
			$nationalityEntityObject->setFlag_flu($flag_fluURL);
			$nationalityEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('nationality_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>