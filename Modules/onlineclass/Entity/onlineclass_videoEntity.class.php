<?php
namespace Modules\onlineclass\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-30 - 2017-10-22 00:49
*@lastUpdate 1396-07-30 - 2017-10-22 00:49
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class onlineclass_videoEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("onlineclass_video");
		$this->setTableTitle("onlineclass_video");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("title");
		$this->setFieldInfo(onlineclass_videoEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',onlineclass_videoEntity::$TITLE);

		/******** hold_date ********/
		$Hold_dateInfo=new FieldInfo();
		$Hold_dateInfo->setTitle("hold_date");
		$this->setFieldInfo(onlineclass_videoEntity::$HOLD_DATE,$Hold_dateInfo);
		$this->addTableField('2',onlineclass_videoEntity::$HOLD_DATE);

		/******** course_fid ********/
		$Course_fidInfo=new FieldInfo();
		$Course_fidInfo->setTitle("course_fid");
		$this->setFieldInfo(onlineclass_videoEntity::$COURSE_FID,$Course_fidInfo);
		$this->addTableField('3',onlineclass_videoEntity::$COURSE_FID);

		/******** hdvideo_flu ********/
		$Hdvideo_fluInfo=new FieldInfo();
		$Hdvideo_fluInfo->setTitle("hdvideo_flu");
		$this->setFieldInfo(onlineclass_videoEntity::$HDVIDEO_FLU,$Hdvideo_fluInfo);
		$this->addTableField('4',onlineclass_videoEntity::$HDVIDEO_FLU);

		/******** sdvideo_flu ********/
		$Sdvideo_fluInfo=new FieldInfo();
		$Sdvideo_fluInfo->setTitle("sdvideo_flu");
		$this->setFieldInfo(onlineclass_videoEntity::$SDVIDEO_FLU,$Sdvideo_fluInfo);
		$this->addTableField('5',onlineclass_videoEntity::$SDVIDEO_FLU);

		/******** voice_flu ********/
		$Voice_fluInfo=new FieldInfo();
		$Voice_fluInfo->setTitle("voice_flu");
		$this->setFieldInfo(onlineclass_videoEntity::$VOICE_FLU,$Voice_fluInfo);
		$this->addTableField('6',onlineclass_videoEntity::$VOICE_FLU);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(onlineclass_videoEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(onlineclass_videoEntity::$TITLE,$Title);
	}
	public static $HOLD_DATE="hold_date";
	/**
	 * @return mixed
	 */
	public function getHold_date(){
		return $this->getField(onlineclass_videoEntity::$HOLD_DATE);
	}
	/**
	 * @param mixed $Hold_date
	 */
	public function setHold_date($Hold_date){
		$this->setField(onlineclass_videoEntity::$HOLD_DATE,$Hold_date);
	}
	public static $COURSE_FID="course_fid";
	/**
	 * @return mixed
	 */
	public function getCourse_fid(){
		return $this->getField(onlineclass_videoEntity::$COURSE_FID);
	}
	/**
	 * @param mixed $Course_fid
	 */
	public function setCourse_fid($Course_fid){
		$this->setField(onlineclass_videoEntity::$COURSE_FID,$Course_fid);
	}
	public static $HDVIDEO_FLU="hdvideo_flu";
	/**
	 * @return mixed
	 */
	public function getHdvideo_flu(){
		return $this->getField(onlineclass_videoEntity::$HDVIDEO_FLU);
	}
	/**
	 * @param mixed $Hdvideo_flu
	 */
	public function setHdvideo_flu($Hdvideo_flu){
		$this->setField(onlineclass_videoEntity::$HDVIDEO_FLU,$Hdvideo_flu);
	}
	public static $SDVIDEO_FLU="sdvideo_flu";
	/**
	 * @return mixed
	 */
	public function getSdvideo_flu(){
		return $this->getField(onlineclass_videoEntity::$SDVIDEO_FLU);
	}
	/**
	 * @param mixed $Sdvideo_flu
	 */
	public function setSdvideo_flu($Sdvideo_flu){
		$this->setField(onlineclass_videoEntity::$SDVIDEO_FLU,$Sdvideo_flu);
	}
	public static $VOICE_FLU="voice_flu";
	/**
	 * @return mixed
	 */
	public function getVoice_flu(){
		return $this->getField(onlineclass_videoEntity::$VOICE_FLU);
	}
	/**
	 * @param mixed $Voice_flu
	 */
	public function setVoice_flu($Voice_flu){
		$this->setField(onlineclass_videoEntity::$VOICE_FLU,$Voice_flu);
	}
}
?>