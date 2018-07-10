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
use Modules\users\Entity\users_menuitemEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-17 - 2018-04-06 23:29
*@lastUpdate 1397-01-17 - 2018-04-06 23:29
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class menuitemlistController extends Controller {
	private $PAGESIZE=30;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(users_menuitemEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$QueryLogic->addOrderBy(users_menuitemEntity::$PRIORITY,true);
		$menuitemEnt=new users_menuitemEntity($DBAccessor);
		$result['menuitem']=$menuitemEnt;
		$allcount=$menuitemEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$menuitemEnt->FindAll($QueryLogic);
		$DBAccessor->close_connection();
		return $result;
	}
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
	public function load($PageNum)
	{
		$DBAccessor=new dbaccess();
		$menuitemEnt=new users_menuitemEntity($DBAccessor);
		$q=new QueryLogic();
//		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$latintitle,$module,$page,$parameters,$priority,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$menuitemEnt=new users_menuitemEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("latintitle","%$latintitle%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("module","%$module%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("page","%$page%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("parameters","%$parameters%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("priority","%$priority%",LogicalOperator::LIKE));
		$sortByField=$menuitemEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>