<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_servicetypegroupEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_servicetypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-13 - 2018-04-02 02:04
*@lastUpdate 1397-01-13 - 2018-04-02 02:04
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class servicetypelistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$servicetypegroupEntityObject=new itsap_servicetypegroupEntity($DBAccessor);
		$result['servicetypegroup_fid']=$servicetypegroupEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(itsap_servicetypeEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$servicetypeEnt=new itsap_servicetypeEntity($DBAccessor);
		$result['servicetype']=$servicetypeEnt;
		$allcount=$servicetypeEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$servicetypeEnt->FindAll($QueryLogic);
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
		$servicetypeEnt=new itsap_servicetypeEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$title,$priority,$servicetypegroup_fid,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$servicetypeEnt=new itsap_servicetypeEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("title","%$title%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("priority","%$priority%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("servicetypegroup_fid","%$servicetypegroup_fid%",LogicalOperator::LIKE));
		$sortByField=$servicetypeEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>