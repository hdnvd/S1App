<?php
namespace Modules\sfman\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\sfman\Entity\sfman_pageinfoEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-06 - 2017-09-28 03:52
*@lastUpdate 1396-07-06 - 2017-09-28 03:52
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managepageinfoController extends Controller {    
private $adminMode=true;

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
        if(!$this->adminMode)
            $UserID=$role_systemuser_fid;
		$result=array();
		$pageinfoEntityObject=new sfman_pageinfoEntity($DBAccessor);
		if($ID!=-1){
			$pageinfoEntityObject->setId($ID);
			if($pageinfoEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $pageinfoEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['pageinfo']=$pageinfoEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$description,$keywords,$themepage,$internalurl,$canonicalurl,$sentenceinurl)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->adminMode)
            $UserID=$role_systemuser_fid;
		$result=array();
		if($ID==-1){
			$pageinfoEntityObject=new sfman_pageinfoEntity($DBAccessor);
			$pageinfoEntityObject->setTitle($title);
			$pageinfoEntityObject->setDescription($description);
			$pageinfoEntityObject->setKeywords($keywords);
			$pageinfoEntityObject->setThemepage($themepage);
			$pageinfoEntityObject->setInternalurl($internalurl);
			$pageinfoEntityObject->setCanonicalurl($canonicalurl);
			$pageinfoEntityObject->setSentenceinurl($sentenceinurl);
			$pageinfoEntityObject->Save();
		}
		else{
			$pageinfoEntityObject=new sfman_pageinfoEntity($DBAccessor);
			$pageinfoEntityObject->setId($ID);
			if($pageinfoEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $pageinfoEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$pageinfoEntityObject->setTitle($title);
			$pageinfoEntityObject->setDescription($description);
			$pageinfoEntityObject->setKeywords($keywords);
			$pageinfoEntityObject->setThemepage($themepage);
			$pageinfoEntityObject->setInternalurl($internalurl);
			$pageinfoEntityObject->setCanonicalurl($canonicalurl);
			$pageinfoEntityObject->setSentenceinurl($sentenceinurl);
			$pageinfoEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>