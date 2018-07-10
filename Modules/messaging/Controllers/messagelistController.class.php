<?php
namespace Modules\messaging\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\messaging\Entity\messaging_messageEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-08 - 2017-11-29 15:51
*@lastUpdate 1396-09-08 - 2017-11-29 15:51
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class messagelistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$sender_role_systemuserEntityObject=new messaging_systemuserEntity($DBAccessor);
		$result['sender_role_systemuser_fid']=$sender_role_systemuserEntityObject->FindAll(new QueryLogic());
		$receiver_role_systemuserEntityObject=new messaging_systemuserEntity($DBAccessor);
		$result['receiver_role_systemuser_fid']=$receiver_role_systemuserEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(messaging_messageEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$messageEnt=new messaging_messageEntity($DBAccessor);
		$result['message']=$messageEnt;
		$allcount=$messageEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$messageEnt->FindAll($QueryLogic);
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
		$messageEnt=new messaging_messageEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$sender_role_systemuser_fid,$receiver_role_systemuser_fid,$send_date_from,$send_date_to,$title,$messagetext,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$messageEnt=new messaging_messageEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("sender_role_systemuser_fid","%$sender_role_systemuser_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("receiver_role_systemuser_fid","%$receiver_role_systemuser_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("send_date",$send_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("send_date",$send_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("title","%$title%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("messagetext","%$messagetext%",LogicalOperator::LIKE));
		$sortByField=$messageEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>