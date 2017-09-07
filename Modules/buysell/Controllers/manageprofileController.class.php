<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\common\Entity\common_cityEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\buysell\Entity\buysell_userEntity;
use Modules\buysell\Entity\buysell_carmodelEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-16 - 2017-09-07 01:34
*@lastUpdate 1396-06-16 - 2017-09-07 01:34
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageprofileController extends Controller {
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$userEntityObject=new buysell_userEntity($DBAccessor);
			$common_cityEntityObject=new common_cityEntity($DBAccessor);
			$result['common_city_fid']=$common_cityEntityObject->FindAll(new QueryLogic());
			$carmodelEntityObject=new buysell_carmodelEntity($DBAccessor);
			$result['carmodel_fid']=$carmodelEntityObject->FindAll(new QueryLogic());
		    $q=new QueryLogic();
		    $q->addCondition(new FieldCondition(buysell_userEntity::$ROLE_SYSTEMUSER_FID,$role_systemuser_fid,LogicalOperator::Equal));
			$userEntityObject=$userEntityObject->FindOne($q);
			if($userEntityObject==null || $userEntityObject->getId()==-1)
				throw new DataNotFoundException();

			$result['user']=$userEntityObject;

		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($name,$email,$tel,$mob,$postalcode,$ismale,$common_city_fid,$birthday,$ispayed,$signupdate,$photo,$is_info_visible,$carmodel_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
			$userEntityObject=new buysell_userEntity($DBAccessor);
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition(buysell_userEntity::$ROLE_SYSTEMUSER_FID,$role_systemuser_fid,LogicalOperator::Equal));
        $userEntityObject=$userEntityObject->FindOne($q);
        if($userEntityObject==null || $userEntityObject->getId()==-1)
            throw new DataNotFoundException();
			$userEntityObject->setName($name);
			$userEntityObject->setEmail($email);
			$userEntityObject->setTel($tel);
			$userEntityObject->setMob($mob);
			$userEntityObject->setPostalcode($postalcode);
			$userEntityObject->setIsmale($ismale);
			$userEntityObject->setCommon_city_fid($common_city_fid);
			$userEntityObject->setBirthday($birthday);
			$userEntityObject->setIspayed($ispayed);
			$userEntityObject->setSignupdate($signupdate);
			$userEntityObject->setPhoto($photo);
			$userEntityObject->setIs_info_visible($is_info_visible);
			$userEntityObject->setCarmodel_fid($carmodel_fid);
			$userEntityObject->Save();
		$result=$this->load();
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>