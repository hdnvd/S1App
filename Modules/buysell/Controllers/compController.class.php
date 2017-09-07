<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_carmodelEntity;
use Modules\buysell\Entity\buysell_componentcarmodelEntity;
use Modules\buysell\Entity\buysell_componentEntity;
use Modules\buysell\Entity\buysell_componentgroupEntity;
use Modules\buysell\Entity\buysell_componentphotoEntity;
use Modules\buysell\Entity\buysell_userEntity;
use Modules\buysell\PublicClasses\Constants;
use Modules\common\Entity\common_countryEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-12-07 - 2017-02-25 18:45
*@lastUpdate 1395-12-07 - 2017-02-25 18:45
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class compController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		if($ID!=-1){
			$compEnt=new buysell_componentEntity($DBAccessor);
            $compPhotoEnt=new buysell_componentphotoEntity($DBAccessor);
            $CountEnt=new common_countryEntity($DBAccessor);
            $CarModelEnt=new buysell_carmodelEntity($DBAccessor);
            $CarModelComponentEnt=new buysell_componentcarmodelEntity($DBAccessor);
            $user=new buysell_userEntity($DBAccessor);
            $CompGroupEnt=new buysell_componentgroupEntity($DBAccessor);
            $result['component']=$compEnt->FullSelect($ID,null,null,null,null,null,null,null,null,null,null,null,null,null,null,array(),array(),"0,1");
            $result['component']=$result['component'][0];
            $result['component']['photos']=$compPhotoEnt->Select(null,$ID,null,null,array('priority','id'),array(false,false),"0,".Constants::$MAXPHOTOCOUNT);
            $result['component']['country']=$CountEnt->Select($result['component']['country_fid'],null,null,array(),array(),"0,1")[0];
//            $result['component']['carmodel']=$CountEnt->Select($result['component']['country_fid'],null,null,array(),array(),"0,1")[0];
            $carModelID=$CarModelComponentEnt->Select(null,$ID,null,array(),array(),"0,1");
            $result['component']['carmodels']=$CarModelEnt->Select($carModelID[0]['carmodel_fid'],null,null,null,null,array('title'),array(false),"0,100");
            $q=new QueryLogic();
            $q->addCondition(new FieldCondition(buysell_userEntity::$ROLE_SYSTEMUSER_FID,$result['component']['role_systemuser_fid'],LogicalOperator::Equal));
            $result['component']['user']=$user->FindOne($q);
//            $result['component']['componentgroups']=$CompGroupEnt->Select(null,null,null,null,null,array('title'),array(false),"0,1000");
		}
		$DBAccessor->close_connection();
		return $result;
	}
}
?>