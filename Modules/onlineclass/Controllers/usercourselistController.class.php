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
use Modules\onlineclass\Entity\onlineclass_usercourseEntity;
use Modules\onlineclass\Entity\onlineclass_userEntity;
use Modules\onlineclass\Entity\onlineclass_courseEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-26 - 2017-10-18 16:38
*@lastUpdate 1396-07-26 - 2017-10-18 16:38
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class usercourselistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$userEntityObject=new onlineclass_userEntity($DBAccessor);
		$result['user_fid']=$userEntityObject->FindAll(new QueryLogic());
		$courseEntityObject=new onlineclass_courseEntity($DBAccessor);
		$result['course_fid']=$courseEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(onlineclass_usercourseEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$usercourseEnt=new onlineclass_usercourseEntity($DBAccessor);
		$result['usercourse']=$usercourseEnt;
		$allcount=$usercourseEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$usercourseEnt->FindAll($QueryLogic);
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
		$usercourseEnt=new onlineclass_usercourseEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$user_fid,$course_fid,$add_time_from,$add_time_to,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$usercourseEnt=new onlineclass_usercourseEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("user_fid","%$user_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("course_fid","%$course_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("add_time",$add_time_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("add_time",$add_time_to,LogicalOperator::Smaller));
		$sortByField=$usercourseEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>