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
use Modules\users\Entity\users_userEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-15 - 2018-02-04 12:42
*@lastUpdate 1396-11-15 - 2018-02-04 12:42
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class userlistController extends Controller {
	private $PAGESIZE=10;
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
            $QueryLogic->addCondition(new FieldCondition(users_userEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$userEnt=new users_userEntity($DBAccessor);
		$result['user']=$userEnt;
		$allcount=$userEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$userEnt->FindAll($QueryLogic);
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
		$userEnt=new users_userEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$name,$family,$mail,$mobile,$ismale,$profilepicture,$additionalfield1,$additionalfield2,$additionalfield3,$additionalfield4,$additionalfield5,$additionalfield6,$additionalfield7,$additionalfield8,$additionalfield9,$signup_time_from,$signup_time_to,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$userEnt=new users_userEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("name","%$name%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("family","%$family%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("mail","%$mail%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("mobile","%$mobile%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("ismale","%$ismale%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("profilepicture","%$profilepicture%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("additionalfield1","%$additionalfield1%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("additionalfield2","%$additionalfield2%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("additionalfield3","%$additionalfield3%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("additionalfield4","%$additionalfield4%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("additionalfield5","%$additionalfield5%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("additionalfield6","%$additionalfield6%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("additionalfield7","%$additionalfield7%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("additionalfield8","%$additionalfield8%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("additionalfield9","%$additionalfield9%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("signup_time",$signup_time_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("signup_time",$signup_time_to,LogicalOperator::Smaller));
		$sortByField=$userEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>