<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\iribfinance\Entity\iribfinance_taxtypeEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_activityEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageactivityController extends Controller {
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
		$activityEntityObject=new iribfinance_activityEntity($DBAccessor);
		$taxtypeEntityObject=new iribfinance_taxtypeEntity($DBAccessor);
		$result['taxtype_fid']=$taxtypeEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('activity_fid',$ID));
		$result['activity']=$activityEntityObject;
		if($ID!=-1){
			$activityEntityObject->setId($ID);
			if($activityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $activityEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['activity']=$activityEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$paycenter_type,$planingcode,$taxtype_fid,$alalhesab,$isactive)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$activityEntityObject=new iribfinance_activityEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$paycenter_type,$planingcode,$taxtype_fid,$alalhesab,$isactive],[$activityEntityObject->getFieldInfo(iribfinance_activityEntity::$TITLE),$activityEntityObject->getFieldInfo(iribfinance_activityEntity::$PAYCENTER_TYPE),$activityEntityObject->getFieldInfo(iribfinance_activityEntity::$PLANINGCODE),$activityEntityObject->getFieldInfo(iribfinance_activityEntity::$TAXTYPE_FID),$activityEntityObject->getFieldInfo(iribfinance_activityEntity::$ALALHESAB),$activityEntityObject->getFieldInfo(iribfinance_activityEntity::$ISACTIVE)]);
		if($ID==-1){
			$activityEntityObject->setTitle($title);
			$activityEntityObject->setPaycenter_type($paycenter_type);
			$activityEntityObject->setPlaningcode($planingcode);
			$activityEntityObject->setTaxtype_fid($taxtype_fid);
			$activityEntityObject->setAlalhesab($alalhesab);
			$activityEntityObject->setIsactive($isactive);
			$activityEntityObject->Save();
			$ID=$activityEntityObject->getId();
		}
		else{
			$activityEntityObject->setId($ID);
			if($activityEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $activityEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$activityEntityObject->setTitle($title);
			$activityEntityObject->setPaycenter_type($paycenter_type);
			$activityEntityObject->setPlaningcode($planingcode);
			$activityEntityObject->setTaxtype_fid($taxtype_fid);
			$activityEntityObject->setAlalhesab($alalhesab);
			$activityEntityObject->setIsactive($isactive);
			$activityEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('activity_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>