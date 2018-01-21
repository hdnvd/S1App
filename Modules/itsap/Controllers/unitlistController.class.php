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
class unitlistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic,$TopUnitID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();

        $topunitEntityObject=new itsap_topunitEntity($DBAccessor);
        $result['topunit']=$topunitEntityObject;

        if($TopUnitID!=-1){
            $topunitEntityObject->setId($TopUnitID);
            if($topunitEntityObject->getId()==-1)
                throw new DataNotFoundException();
            $result['topunit']=$topunitEntityObject;
            $topunitEntityObject=new itsap_topunitEntity($DBAccessor);
            $topunitEntityObject->SetId($result['topunit']->getTopunit_fid());
            $result['topunit_fid']=$topunitEntityObject;
        }

		$topunitEntityObject2=new itsap_topunitEntity($DBAccessor);
		$result['topunits']=$topunitEntityObject2->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;

        $QueryLogic->addCondition(new FieldCondition(itsap_unitEntity::$TOPUNIT_FID,$TopUnitID));
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(itsap_unitEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$unitEnt=new itsap_unitEntity($DBAccessor);
		$result['unit']=$unitEnt;
		$allcount=$unitEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$unitEnt->FindAll($QueryLogic);
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
	public function load($PageNum,$TopUnitID)
	{
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		return $this->getData($PageNum,$q,$TopUnitID);
	}
	public function Search($PageNum,$topunit_fid,$title,$isfava,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$unitEnt=new itsap_unitEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("topunit_fid","%$topunit_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("title","%$title%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("isfava","%$isfava%",LogicalOperator::LIKE));
		$sortByField=$unitEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>