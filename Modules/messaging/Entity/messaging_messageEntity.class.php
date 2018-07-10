<?php
namespace Modules\messaging\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-07 - 2017-11-28 18:04
*@lastUpdate 1396-09-07 - 2017-11-28 18:04
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class messaging_messageEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("messaging_message");
		$this->setTableTitle("messaging_message");
		$this->setTitleFieldName("title");

		/******** sender_role_systemuser_fid ********/
		$Sender_role_systemuser_fidInfo=new FieldInfo();
		$Sender_role_systemuser_fidInfo->setTitle("sender_role_systemuser_fid");
		$this->setFieldInfo(messaging_messageEntity::$SENDER_ROLE_SYSTEMUSER_FID,$Sender_role_systemuser_fidInfo);
		$this->addTableField('1',messaging_messageEntity::$SENDER_ROLE_SYSTEMUSER_FID);

		/******** receiver_role_systemuser_fid ********/
		$Receiver_role_systemuser_fidInfo=new FieldInfo();
		$Receiver_role_systemuser_fidInfo->setTitle("receiver_role_systemuser_fid");
		$this->setFieldInfo(messaging_messageEntity::$RECEIVER_ROLE_SYSTEMUSER_FID,$Receiver_role_systemuser_fidInfo);
		$this->addTableField('2',messaging_messageEntity::$RECEIVER_ROLE_SYSTEMUSER_FID);

		/******** send_date ********/
		$Send_dateInfo=new FieldInfo();
		$Send_dateInfo->setTitle("send_date");
		$this->setFieldInfo(messaging_messageEntity::$SEND_DATE,$Send_dateInfo);
		$this->addTableField('3',messaging_messageEntity::$SEND_DATE);

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("title");
		$this->setFieldInfo(messaging_messageEntity::$TITLE,$TitleInfo);
		$this->addTableField('4',messaging_messageEntity::$TITLE);

		/******** messagetext ********/
		$MessagetextInfo=new FieldInfo();
		$MessagetextInfo->setTitle("messagetext");
		$this->setFieldInfo(messaging_messageEntity::$MESSAGETEXT,$MessagetextInfo);
		$this->addTableField('5',messaging_messageEntity::$MESSAGETEXT);
	}
	public static $SENDER_ROLE_SYSTEMUSER_FID="sender_role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getSender_role_systemuser_fid(){
		return $this->getField(messaging_messageEntity::$SENDER_ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Sender_role_systemuser_fid
	 */
	public function setSender_role_systemuser_fid($Sender_role_systemuser_fid){
		$this->setField(messaging_messageEntity::$SENDER_ROLE_SYSTEMUSER_FID,$Sender_role_systemuser_fid);
	}
	public static $RECEIVER_ROLE_SYSTEMUSER_FID="receiver_role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getReceiver_role_systemuser_fid(){
		return $this->getField(messaging_messageEntity::$RECEIVER_ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Receiver_role_systemuser_fid
	 */
	public function setReceiver_role_systemuser_fid($Receiver_role_systemuser_fid){
		$this->setField(messaging_messageEntity::$RECEIVER_ROLE_SYSTEMUSER_FID,$Receiver_role_systemuser_fid);
	}
	public static $SEND_DATE="send_date";
	/**
	 * @return mixed
	 */
	public function getSend_date(){
		return $this->getField(messaging_messageEntity::$SEND_DATE);
	}
	/**
	 * @param mixed $Send_date
	 */
	public function setSend_date($Send_date){
		$this->setField(messaging_messageEntity::$SEND_DATE,$Send_date);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(messaging_messageEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(messaging_messageEntity::$TITLE,$Title);
	}
	public static $MESSAGETEXT="messagetext";
	/**
	 * @return mixed
	 */
	public function getMessagetext(){
		return $this->getField(messaging_messageEntity::$MESSAGETEXT);
	}
	/**
	 * @param mixed $Messagetext
	 */
	public function setMessagetext($Messagetext){
		$this->setField(messaging_messageEntity::$MESSAGETEXT,$Messagetext);
	}
}
?>