<?php
namespace Modules\onlineclass\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\onlineclass\Entity\onlineclass_courseEntity;
use Modules\onlineclass\Entity\onlineclass_tutorEntity;
use Modules\onlineclass\Entity\onlineclass_levelEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-25 - 2017-10-17 21:18
*@lastUpdate 1396-07-25 - 2017-10-17 21:18
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class courselistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$tutorEntityObject=new onlineclass_tutorEntity($DBAccessor);
		$result['tutor_fid']=$tutorEntityObject->FindAll(new QueryLogic());
		$levelEntityObject=new onlineclass_levelEntity($DBAccessor);
		$result['level_fid']=$levelEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(onlineclass_courseEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$courseEnt=new onlineclass_courseEntity($DBAccessor);
		$result['course']=$courseEnt;
		$allcount=$courseEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$courseEnt->FindAll($QueryLogic);
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
		$courseEnt=new onlineclass_courseEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$title,$start_date_from,$start_date_to,$end_date_from,$end_date_to,$tutor_fid,$price,$description,$level_fid,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$courseEnt=new onlineclass_courseEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("title","%$title%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("start_date",$start_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("start_date",$start_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("end_date",$end_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("end_date",$end_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("tutor_fid","%$tutor_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("price","%$price%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("description","%$description%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("level_fid","%$level_fid%",LogicalOperator::LIKE));
		$sortByField=$courseEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>