<?php
namespace Modules\kpex\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\kpex\Entity\kpex_contextEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-03-24 - 2018-06-14 03:29
*@lastUpdate 1397-03-24 - 2018-06-14 03:29
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managecontextController extends Controller {
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
		$contextEntityObject=new kpex_contextEntity($DBAccessor);
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('context_fid',$ID));
		$result['context']=$contextEntityObject;
		if($ID!=-1){
			$contextEntityObject->setId($ID);
			if($contextEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $contextEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['context']=$contextEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$url,$title,$content,$words)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $words=str_replace("-",",",$words);
        $words=str_replace("_",",",$words);
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$contextEntityObject=new kpex_contextEntity($DBAccessor);
		$this->ValidateFieldArray([$url,$title,$content,$words],[$contextEntityObject->getFieldInfo(kpex_contextEntity::$URL),$contextEntityObject->getFieldInfo(kpex_contextEntity::$TITLE),$contextEntityObject->getFieldInfo(kpex_contextEntity::$CONTENT),$contextEntityObject->getFieldInfo(kpex_contextEntity::$WORDS)]);
		if($ID==-1){
			$contextEntityObject->setUrl($url);
			$contextEntityObject->setTitle($title);
			$contextEntityObject->setContent($content);
			$contextEntityObject->setWords($words);
			$contextEntityObject->setCreated_at(time());
			$contextEntityObject->Save();
			$ID=$contextEntityObject->getId();
		}
		else{
			$contextEntityObject->setId($ID);
			if($contextEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $contextEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$contextEntityObject->setUrl($url);
			$contextEntityObject->setTitle($title);
			$contextEntityObject->setContent($content);
			$contextEntityObject->setWords($words);
			$contextEntityObject->setUpdated_at(time());
			$contextEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('context_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>