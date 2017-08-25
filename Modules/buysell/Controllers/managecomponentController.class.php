<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_carmakerEntity;
use Modules\buysell\Entity\buysell_carmodelEntity;
use Modules\buysell\Entity\buysell_componentcarmodelEntity;
use Modules\buysell\Entity\buysell_componentEntity;
use Modules\buysell\Entity\buysell_componentgroupEntity;
use Modules\buysell\Entity\buysell_componentphotoEntity;
use Modules\buysell\Exceptions\ProductNotFoundException;
use Modules\common\Entity\common_countryEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;

/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-26 - 2017-02-14 14:56
*@lastUpdate 1395-11-26 - 2017-02-14 14:56
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponentController extends Controller {
	public function load($ID,$GroupID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
        $result=array();
//		$carcol=new buysell_carcolor2Entity($DBAccessor);
//		$q=new QueryLogic();
//		$q->addCondition(new FieldCondition(buysell_carcolorEntity::$ID,2,LogicalOperator::Bigger));
//		$carcols=$carcol->FindAll($q);
//
//
//		$result['cols']=$carcols;
        $carmakerEntityObject=new buysell_carmakerEntity($DBAccessor);
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition("cargroup_fid",$GroupID));
        $result['carmaker_fid']=$carmakerEntityObject->FindAll($q);
        $CountEnt=new common_countryEntity($DBAccessor);
        $CarModelEnt=new buysell_carmodelEntity($DBAccessor);
        $CompCarModelEnt=new buysell_componentcarmodelEntity($DBAccessor);
        $CompGroupEnt=new buysell_componentgroupEntity($DBAccessor);
        $carmakEnt=new buysell_carmakerEntity($DBAccessor);
        $compEnt=new buysell_componentEntity($DBAccessor);
        $su=new sessionuser();

		if($ID!=-1){

            $result['component']=$compEnt->Select(null,null,null,null,null,$su->getSystemUserID(),null,null,null,null,null,array('id'),array(false),"0,1");
            if($result['component']==null || count($result['component'])<=0)
                throw new ProductNotFoundException();
            $result['component'][0]['carmodels']=$CompCarModelEnt->Select(null,$result['component'][0]['id'],null,array(),array(),"0,10");

            $cmd=$result['component'][0]['carmodels'][0]['carmodel_fid'];
            $carmodelEntityObject=new buysell_carmodelEntity($DBAccessor);
            $carmodelEntityObject->setId($cmd);
            $makerID=$carmodelEntityObject->getCarmaker_fid();
            $result['selectedcarmaker_fid']=$makerID;
            $q=new QueryLogic();
            $q->addCondition(new FieldCondition("carmaker_fid",$makerID));
            $result['carmodel_fid']=$carmodelEntityObject->FindAll($q);
		}
		$result['countries']=$CountEnt->Select(null,null,null,array('name'),array(false),"0,200");
        $result['carmodels']=$CarModelEnt->Select(null,null,null,null,-1,array('carmaker_fid','title'),array(false,false),"0,3000");
        for ($i=0;$i<count($result['carmodels']);$i++)
        {

            $result['carmodels'][$i]['carmakertitle']=$carmakEnt->Select($result['carmodels'][$i]['carmaker_fid'],null,null,null,array(),array(),"0,1")[0]['title'];
        }
        $result['componentgroups']=$CompGroupEnt->Select(null,null,null,null,null,array('title'),array(false),"0,1000");
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$txtTitle,$cmbComponentGroup,$txtprice,$cmbUseStatus,$cmbCountry,$cmbCarModel,$txtDetails,$GroupID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $compEnt=new buysell_componentEntity($DBAccessor);
        $CarModelEnt=new buysell_componentcarmodelEntity($DBAccessor);
        $photoEnt=new buysell_componentphotoEntity($DBAccessor);
        $sysUser=new sessionuser();

		if($ID==-1){
			$compid=$compEnt->Insert($txtTitle,$txtprice,$cmbUseStatus,$sysUser->getSystemUserID(),$cmbCountry,$cmbComponentGroup,time(),$txtDetails,"-1");
            $CarModelEnt->Insert($compid,$cmbCarModel);
            $ID=$compid;
		}
		else{
            $cmp=$compEnt->Select($ID,null,null,null,null,$sysUser->getSystemUserID(),null,null,null,null,null,array(),array(),"0,1");
            if($cmp==null || count($cmp)<=0)
                throw new ProductNotFoundException();
                $compEnt->Update($ID,$txtTitle,$txtprice,$cmbUseStatus,$sysUser->getSystemUserID(),$cmbCountry,$cmbComponentGroup,time(),$txtDetails,"-1");

                $carmods=$CarModelEnt->Select(null,$ID,null,array(),array(),"0,10000");
                for($i=0;$i<count($carmods);$i++)
                    $CarModelEnt->Delete($carmods[$i]['id']);
            $CarModelEnt->Insert($ID,$cmbCarModel);




		}

		$DBAccessor->close_connection();
        $result=$this->load($ID,$GroupID);
        $result['id']=$ID;
		return $result;
	}
}
?>