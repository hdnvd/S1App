<?php
namespace Modules\wc\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\common\Entity\common_cityEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\wc\Entity\wc_wcEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-16 - 2017-10-08 14:43
*@lastUpdate 1396-07-16 - 2017-10-08 14:43
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managewcController extends Controller {
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
		$wcEntityObject=new wc_wcEntity($DBAccessor);
			$common_cityEntityObject=new common_cityEntity($DBAccessor);
			$result['common_city_fid']=$common_cityEntityObject->FindAll(new QueryLogic());
		$result['wc']=$wcEntityObject;
		if($ID!=-1){
			$wcEntityObject->setId($ID);
			if($wcEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $wcEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['wc']=$wcEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$latitude,$longitude,$common_city_fid,$isfarangi,$isnormal,$register_time,$ispublished,$opentimes,$placetitle,$isfree)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$wcEntityObject=new wc_wcEntity($DBAccessor);
		$this->ValidateFieldArray([$latitude,$longitude,$common_city_fid,$isfarangi,$isnormal,$register_time,$ispublished,$opentimes,$placetitle,$isfree],[$wcEntityObject->getFieldInfo(wc_wcEntity::$LATITUDE),$wcEntityObject->getFieldInfo(wc_wcEntity::$LONGITUDE),$wcEntityObject->getFieldInfo(wc_wcEntity::$COMMON_CITY_FID),$wcEntityObject->getFieldInfo(wc_wcEntity::$ISFARANGI),$wcEntityObject->getFieldInfo(wc_wcEntity::$ISNORMAL),$wcEntityObject->getFieldInfo(wc_wcEntity::$REGISTER_TIME),$wcEntityObject->getFieldInfo(wc_wcEntity::$ISPUBLISHED),$wcEntityObject->getFieldInfo(wc_wcEntity::$OPENTIMES),$wcEntityObject->getFieldInfo(wc_wcEntity::$PLACETITLE),$wcEntityObject->getFieldInfo(wc_wcEntity::$ISFREE)]);
		if($ID==-1){
			$wcEntityObject->setLatitude($latitude);
			$wcEntityObject->setLongitude($longitude);
			$wcEntityObject->setCommon_city_fid($common_city_fid);
			$wcEntityObject->setIsfarangi($isfarangi);
			$wcEntityObject->setIsnormal($isnormal);
			$wcEntityObject->setRegister_time($register_time);
			$wcEntityObject->setIspublished($ispublished);
			$wcEntityObject->setOpentimes($opentimes);
			$wcEntityObject->setPlacetitle($placetitle);
			$wcEntityObject->setIsfree($isfree);
			$wcEntityObject->Save();
		}
		else{
			$wcEntityObject->setId($ID);
			if($wcEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $wcEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$wcEntityObject->setLatitude($latitude);
			$wcEntityObject->setLongitude($longitude);
			$wcEntityObject->setCommon_city_fid($common_city_fid);
			$wcEntityObject->setIsfarangi($isfarangi);
			$wcEntityObject->setIsnormal($isnormal);
			$wcEntityObject->setRegister_time($register_time);
			$wcEntityObject->setIspublished($ispublished);
			$wcEntityObject->setOpentimes($opentimes);
			$wcEntityObject->setPlacetitle($placetitle);
			$wcEntityObject->setIsfree($isfree);
			$wcEntityObject->Save();
		}
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>