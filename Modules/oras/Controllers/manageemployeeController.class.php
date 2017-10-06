<?php
namespace Modules\oras\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\oras\Entity\oras_employeeEntity;
use Modules\oras\Entity\oras_photoEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 16:08
*@lastUpdate 1396-07-12 - 2017-10-04 16:08
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageemployeeController extends Controller {
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
		$employeeEntityObject=new oras_employeeEntity($DBAccessor);
		$result['employee']=$employeeEntityObject;
		if($ID!=-1){
			$employeeEntityObject->setId($ID);
			if($employeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $employeeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['employee']=$employeeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$mellicode,$name,$family,$ismale,$phonenumber,$photo_flu)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$employeeEntityObject=new oras_employeeEntity($DBAccessor);
		$photo_fluURL='';
		if($photo_flu!=null && count($photo_flu)>0)
			$photo_fluURL=$photo_flu[0]['url'];
		$this->ValidateFieldArray([$mellicode,$name,$family,$ismale,$phonenumber,$photo_fluURL],[$employeeEntityObject->getFieldInfo(oras_employeeEntity::$MELLICODE),$employeeEntityObject->getFieldInfo(oras_employeeEntity::$NAME),$employeeEntityObject->getFieldInfo(oras_employeeEntity::$FAMILY),$employeeEntityObject->getFieldInfo(oras_employeeEntity::$ISMALE),$employeeEntityObject->getFieldInfo(oras_employeeEntity::$PHONENUMBER),$employeeEntityObject->getFieldInfo(oras_employeeEntity::$PHOTO_FLU)]);
		if($ID==-1){
			$employeeEntityObject->setMellicode($mellicode);
			$employeeEntityObject->setName($name);
			$employeeEntityObject->setFamily($family);
			$employeeEntityObject->setIsmale($ismale);
			$employeeEntityObject->setPhonenumber($phonenumber);
			$employeeEntityObject->setPhoto_flu($photo_fluURL);
			$employeeEntityObject->Save();
		}
		else{
			$employeeEntityObject->setId($ID);
			if($employeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $employeeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$employeeEntityObject->setMellicode($mellicode);
			$employeeEntityObject->setName($name);
			$employeeEntityObject->setFamily($family);
			$employeeEntityObject->setIsmale($ismale);
			$employeeEntityObject->setPhonenumber($phonenumber);
			if($photo_fluURL!="")
			    $employeeEntityObject->setPhoto_flu($photo_fluURL);
			$employeeEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>