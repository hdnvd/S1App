<?php
namespace Modules\eshop\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\eshop\Entity\eshop_colorEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-08-26 - 2017-11-17 21:29
*@lastUpdate 1396-08-26 - 2017-11-17 21:29
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managecolorController extends Controller {
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
		$colorEntityObject=new eshop_colorEntity($DBAccessor);
		$result['color']=$colorEntityObject;
		if($ID!=-1){
			$colorEntityObject->setId($ID);
			if($colorEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $colorEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['color']=$colorEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$latintitle)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$colorEntityObject=new eshop_colorEntity($DBAccessor);
		$this->ValidateFieldArray([$title,$latintitle],[$colorEntityObject->getFieldInfo(eshop_colorEntity::$TITLE),$colorEntityObject->getFieldInfo(eshop_colorEntity::$LATINTITLE)]);
		if($ID==-1){
			$colorEntityObject->setTitle($title);
			$colorEntityObject->setLatintitle($latintitle);
			$colorEntityObject->Save();
		}
		else{
			$colorEntityObject->setId($ID);
			if($colorEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $colorEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$colorEntityObject->setTitle($title);
			$colorEntityObject->setLatintitle($latintitle);
			$colorEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>