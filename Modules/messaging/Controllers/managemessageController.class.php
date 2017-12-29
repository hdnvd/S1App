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
class managemessageController extends Controller {
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
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$messageEntityObject=new messaging_messageEntity($DBAccessor);
		$sender_role_systemuserEntityObject=new role_systemuserEntity($DBAccessor);
		$result['sender_role_systemuser_fid']=$sender_role_systemuserEntityObject->FindAll(new QueryLogic());
		$receiver_role_systemuserEntityObject=new role_systemuserEntity($DBAccessor);
		$result['receiver_role_systemuser_fid']=$receiver_role_systemuserEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('message_fid',$ID));
		$result['message']=$messageEntityObject;
		if($ID!=-1){
			$messageEntityObject->setId($ID);
			if($messageEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $messageEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['message']=$messageEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$sender_role_systemuser_fid,$receiver_role_systemuser_fid,$send_date,$title,$messagetext)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$messageEntityObject=new messaging_messageEntity($DBAccessor);
		$this->ValidateFieldArray([$sender_role_systemuser_fid,$receiver_role_systemuser_fid,$send_date,$title,$messagetext],[$messageEntityObject->getFieldInfo(messaging_messageEntity::$SENDER_ROLE_SYSTEMUSER_FID),$messageEntityObject->getFieldInfo(messaging_messageEntity::$RECEIVER_ROLE_SYSTEMUSER_FID),$messageEntityObject->getFieldInfo(messaging_messageEntity::$SEND_DATE),$messageEntityObject->getFieldInfo(messaging_messageEntity::$TITLE),$messageEntityObject->getFieldInfo(messaging_messageEntity::$MESSAGETEXT)]);
		if($ID==-1){
			$messageEntityObject->setSender_role_systemuser_fid($sender_role_systemuser_fid);
			$messageEntityObject->setReceiver_role_systemuser_fid($receiver_role_systemuser_fid);
			$messageEntityObject->setSend_date($send_date);
			$messageEntityObject->setTitle($title);
			$messageEntityObject->setMessagetext($messagetext);
			$messageEntityObject->Save();
			$ID=$messageEntityObject->getId();
		}
		else{
			$messageEntityObject->setId($ID);
			if($messageEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $messageEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$messageEntityObject->setSender_role_systemuser_fid($sender_role_systemuser_fid);
			$messageEntityObject->setReceiver_role_systemuser_fid($receiver_role_systemuser_fid);
			$messageEntityObject->setSend_date($send_date);
			$messageEntityObject->setTitle($title);
			$messageEntityObject->setMessagetext($messagetext);
			$messageEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('message_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>