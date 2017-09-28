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
*@creationDate 1396-07-06 - 2017-09-28 19:21
*@lastUpdate 1396-07-06 - 2017-09-28 19:21
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managepageinfosController extends Controller {
	private $PAGESIZE=10;    
private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	public function load($PageNum)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->adminMode)
            $UserID=$role_systemuser_fid;
		$result=array();
		if($PageNum<=0)
			$PageNum=1;
		$pageinfoEnt=new sfman_pageinfoEntity($DBAccessor);
		$q=new QueryLogic();
				if($UserID!=null)
            $q->addCondition(new FieldCondition(sfman_pageinfoEntity::$ROLE_SYSTEMUSER_FID,$UserID));		
$q->addOrderBy("id",true);
		$allcount=$pageinfoEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$pageinfoEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function Search($PageNum,$title,$description,$keywords,$themepage,$internalurl,$canonicalurl,$sentenceinurl)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->adminMode)
            $UserID=$role_systemuser_fid;
		$result=array();
		if($PageNum<=0)
			$PageNum=1;
		$pageinfoEnt=new sfman_pageinfoEntity($DBAccessor);
		$q=new QueryLogic();		
$q->addCondition(new FieldCondition("title","%$title%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("description","%$description%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("keywords","%$keywords%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("themepage","%$themepage%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("internalurl","%$internalurl%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("canonicalurl","%$canonicalurl%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("sentenceinurl","%$sentenceinurl%",LogicalOperator::LIKE));		
$q->addOrderBy($sortby,$isdesc);
		$allcount=$pageinfoEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$pageinfoEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function DeleteItem($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=null;
        if(!$this->adminMode)
            $UserID=$role_systemuser_fid;
		$pageinfoEnt=new sfman_pageinfoEntity($DBAccessor);
		$pageinfoEnt->setId($ID);
		if($pageinfoEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $pageinfoEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$pageinfoEnt->Remove();
		return $this->load(-1);
		$DBAccessor->close_connection();
	}
}
?>