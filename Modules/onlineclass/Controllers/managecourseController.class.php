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
class managecourseController extends Controller {
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
		$courseEntityObject=new onlineclass_courseEntity($DBAccessor);
			$tutorEntityObject=new onlineclass_tutorEntity($DBAccessor);
			$result['tutor_fid']=$tutorEntityObject->FindAll(new QueryLogic());
			$levelEntityObject=new onlineclass_levelEntity($DBAccessor);
			$result['level_fid']=$levelEntityObject->FindAll(new QueryLogic());
		$result['course']=$courseEntityObject;
		if($ID!=-1){
			$courseEntityObject->setId($ID);
			if($courseEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $courseEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['course']=$courseEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$start_date,$end_date,$tutor_fid,$price,$description,$level_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$courseEntityObject=new onlineclass_courseEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$start_date,$end_date,$tutor_fid,$price,$description,$level_fid],[$courseEntityObject->getFieldInfo(onlineclass_courseEntity::$TITLE),$courseEntityObject->getFieldInfo(onlineclass_courseEntity::$START_DATE),$courseEntityObject->getFieldInfo(onlineclass_courseEntity::$END_DATE),$courseEntityObject->getFieldInfo(onlineclass_courseEntity::$TUTOR_FID),$courseEntityObject->getFieldInfo(onlineclass_courseEntity::$PRICE),$courseEntityObject->getFieldInfo(onlineclass_courseEntity::$DESCRIPTION),$courseEntityObject->getFieldInfo(onlineclass_courseEntity::$LEVEL_FID)]);
		if($ID==-1){
			$courseEntityObject->setTitle($title);
			$courseEntityObject->setStart_date($start_date);
			$courseEntityObject->setEnd_date($end_date);
			$courseEntityObject->setTutor_fid($tutor_fid);
			$courseEntityObject->setPrice($price);
			$courseEntityObject->setDescription($description);
			$courseEntityObject->setLevel_fid($level_fid);
			$courseEntityObject->Save();
		}
		else{
			$courseEntityObject->setId($ID);
			if($courseEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $courseEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$courseEntityObject->setTitle($title);
			$courseEntityObject->setStart_date($start_date);
			$courseEntityObject->setEnd_date($end_date);
			$courseEntityObject->setTutor_fid($tutor_fid);
			$courseEntityObject->setPrice($price);
			$courseEntityObject->setDescription($description);
			$courseEntityObject->setLevel_fid($level_fid);
			$courseEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>