<?php
namespace Modules\wc\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\common\Entity\common_cityEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\wc\Entity\wc_wcEntity;
use Modules\wc\Entity\wc_cityEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-16 - 2017-10-08 14:43
*@lastUpdate 1396-07-16 - 2017-10-08 14:43
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class wclistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$common_cityEntityObject=new common_cityEntity($DBAccessor);
		$result['common_city_fid']=$common_cityEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(wc_wcEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$wcEnt=new wc_wcEntity($DBAccessor);
		$result['wc']=$wcEnt;
		$allcount=$wcEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
//		echo "<br>Finding:";
		$result['data']=$wcEnt->FindAll($QueryLogic);
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
		$wcEnt=new wc_wcEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$latitude,$longitude,$common_city_fid,$isfarangi,$isnormal,$register_time_from,$register_time_to,$ispublished,$opentimes,$placetitle,$isfree,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$wcEnt=new wc_wcEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("latitude","%$latitude%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("longitude","%$longitude%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("common_city_fid","%$common_city_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("isfarangi","%$isfarangi%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("isnormal","%$isnormal%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("register_time",$register_time_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("register_time",$register_time_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("ispublished","%$ispublished%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("opentimes","%$opentimes%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("placetitle","%$placetitle%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("isfree","%$isfree%",LogicalOperator::LIKE));
		$sortByField=$wcEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>