<?php
namespace Modules\users\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\users\Entity\role_menuitemEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-09 - 2017-10-01 01:08
*@lastUpdate 1396-07-09 - 2017-10-01 01:08
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managemenuitemsController extends Controller {
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
		$menuitemEnt=new role_menuitemEntity($DBAccessor);
		$result['menuitem']=$menuitemEnt;
		$q=new QueryLogic();
				if($UserID!=null)
            $q->addCondition(new FieldCondition(role_menuitemEntity::$ROLE_SYSTEMUSER_FID,$UserID));		
$q->addOrderBy("id",true);
		$allcount=$menuitemEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$menuitemEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function Search($PageNum,$latintitle,$module,$page,$parameters)
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
		$menuitemEnt=new role_menuitemEntity($DBAccessor);
		$result['menuitem']=$menuitemEnt;
		$q=new QueryLogic();		
$q->addCondition(new FieldCondition("latintitle","%$latintitle%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("module","%$module%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("page","%$page%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("parameters","%$parameters%",LogicalOperator::LIKE));		
$q->addOrderBy($sortby,$isdesc);
		$allcount=$menuitemEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$menuitemEnt->FindAll($q);
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
		$menuitemEnt=new role_menuitemEntity($DBAccessor);
		$menuitemEnt->setId($ID);
		if($menuitemEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $menuitemEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$menuitemEnt->Remove();
		return $this->load(-1);
		$DBAccessor->close_connection();
	}
}
?>