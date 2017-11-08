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
use Modules\onlineclass\Entity\onlineclass_videoEntity;
use Modules\onlineclass\Entity\onlineclass_courseEntity;
use Modules\onlineclass\Entity\onlineclass_hdvideoEntity;
use Modules\onlineclass\Entity\onlineclass_sdvideoEntity;
use Modules\onlineclass\Entity\onlineclass_voiceEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-08-01 - 2017-10-23 00:42
*@lastUpdate 1396-08-01 - 2017-10-23 00:42
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managevideoController extends Controller {
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
		$videoEntityObject=new onlineclass_videoEntity($DBAccessor);
			$courseEntityObject=new onlineclass_courseEntity($DBAccessor);
			$result['course_fid']=$courseEntityObject->FindAll(new QueryLogic());
		$result['video']=$videoEntityObject;
		if($ID!=-1){
			$videoEntityObject->setId($ID);
			if($videoEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $videoEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['video']=$videoEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$hold_date,$course_fid,$hdvideo_flu,$sdvideo_flu,$voice_flu)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$videoEntityObject=new onlineclass_videoEntity($DBAccessor);
		$hdvideo_fluURL='';
		if($hdvideo_flu!=null && count($hdvideo_flu)>0)
			$hdvideo_fluURL=$hdvideo_flu[0]['url'];
		$sdvideo_fluURL='';
		if($sdvideo_flu!=null && count($sdvideo_flu)>0)
			$sdvideo_fluURL=$sdvideo_flu[0]['url'];
		$voice_fluURL='';
		if($voice_flu!=null && count($voice_flu)>0)
			$voice_fluURL=$voice_flu[0]['url'];
		$this->ValidateFieldArray([$title,$hold_date,$course_fid,$hdvideo_fluURL,$sdvideo_fluURL,$voice_fluURL],[$videoEntityObject->getFieldInfo(onlineclass_videoEntity::$TITLE),$videoEntityObject->getFieldInfo(onlineclass_videoEntity::$HOLD_DATE),$videoEntityObject->getFieldInfo(onlineclass_videoEntity::$COURSE_FID),$videoEntityObject->getFieldInfo(onlineclass_videoEntity::$HDVIDEO_FLU),$videoEntityObject->getFieldInfo(onlineclass_videoEntity::$SDVIDEO_FLU),$videoEntityObject->getFieldInfo(onlineclass_videoEntity::$VOICE_FLU)]);
		if($ID==-1){
			$videoEntityObject->setTitle($title);
			$videoEntityObject->setHold_date($hold_date);
			$videoEntityObject->setCourse_fid($course_fid);
			if($hdvideo_fluURL!='')
			$videoEntityObject->setHdvideo_flu($hdvideo_fluURL);
			if($sdvideo_fluURL!='')
			$videoEntityObject->setSdvideo_flu($sdvideo_fluURL);
			if($voice_fluURL!='')
			$videoEntityObject->setVoice_flu($voice_fluURL);
			$videoEntityObject->Save();
		}
		else{
			$videoEntityObject->setId($ID);
			if($videoEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $videoEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$videoEntityObject->setTitle($title);
			$videoEntityObject->setHold_date($hold_date);
			$videoEntityObject->setCourse_fid($course_fid);
			if($hdvideo_fluURL!='')
			$videoEntityObject->setHdvideo_flu($hdvideo_fluURL);
			if($sdvideo_fluURL!='')
			$videoEntityObject->setSdvideo_flu($sdvideo_fluURL);
			if($voice_fluURL!='')
			$videoEntityObject->setVoice_flu($voice_fluURL);
			$videoEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>