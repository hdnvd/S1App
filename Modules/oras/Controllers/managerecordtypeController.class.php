<?php
namespace Modules\oras\Controllers;
use core\CoreClasses\Exception\InvalidParameterException;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\oras\Entity\oras_recordtypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 03:02
*@lastUpdate 1396-07-12 - 2017-10-04 03:02
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managerecordtypeController extends Controller {
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
		$recordtypeEntityObject=new oras_recordtypeEntity($DBAccessor);
		$result['recordtype']=$recordtypeEntityObject;
		if($ID!=-1){
			$recordtypeEntityObject->setId($ID);
			if($recordtypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $recordtypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['recordtype']=$recordtypeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$points,$isbad)
	{
	    if(($isbad==1 && $points>0) ||($isbad==0 && $points<0) )
        {
            throw new InvalidParameterException();
        }
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$recordtypeEntityObject=new oras_recordtypeEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$points,$isbad],[$recordtypeEntityObject->getFieldInfo(oras_recordtypeEntity::$TITLE),$recordtypeEntityObject->getFieldInfo(oras_recordtypeEntity::$POINTS),$recordtypeEntityObject->getFieldInfo(oras_recordtypeEntity::$ISBAD)]);
		if($ID==-1){
			$recordtypeEntityObject->setTitle($title);
			$recordtypeEntityObject->setPoints($points);
			$recordtypeEntityObject->setIsbad($isbad);
			$recordtypeEntityObject->Save();
		}
		else{
			$recordtypeEntityObject->setId($ID);
			if($recordtypeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $recordtypeEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$recordtypeEntityObject->setTitle($title);
			$recordtypeEntityObject->setPoints($points);
			$recordtypeEntityObject->setIsbad($isbad);
			$recordtypeEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>