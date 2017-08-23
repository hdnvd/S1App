<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_carbodystatusEntity;
use Modules\buysell\Entity\buysell_carcolorEntity;
use Modules\buysell\Entity\buysell_carentitytypeEntity;
use Modules\buysell\Entity\buysell_carmakerEntity;
use Modules\buysell\Entity\buysell_carmodelEntity;
use Modules\buysell\Entity\buysell_carphotoEntity;
use Modules\buysell\Entity\buysell_carstatusEntity;
use Modules\buysell\Entity\buysell_cartagtypeEntity;
use Modules\buysell\Entity\buysell_cartypeEntity;
use Modules\buysell\Entity\buysell_paytypeEntity;
use Modules\buysell\Entity\buysell_shasitypeEntity;
use Modules\buysell\Entity\buysell_userEntity;
use Modules\common\Entity\common_cityEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\LogicalOperator;
use Modules\buysell\Entity\buysell_carEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-31 - 2017-06-21 02:02
*@lastUpdate 1396-03-31 - 2017-06-21 02:02
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class carlistController extends Controller {
	private $PAGESIZE=10;
	public function load($PageNum,$GroupID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();

        $body_carcolorEntityObject=new buysell_carcolorEntity($DBAccessor);
        $result['body_carcolor_fid']=$body_carcolorEntityObject->FindAll(new QueryLogic());
        $inner_carcolorEntityObject=new buysell_carcolorEntity($DBAccessor);
        $result['inner_carcolor_fid']=$inner_carcolorEntityObject->FindAll(new QueryLogic());
        $paytypeEntityObject=new buysell_paytypeEntity($DBAccessor);
        $result['paytype_fid']=$paytypeEntityObject->FindAll(new QueryLogic());
        $cartypeEntityObject=new buysell_cartypeEntity($DBAccessor);
        $result['cartype_fid']=$cartypeEntityObject->FindAll(new QueryLogic());
        $carbodystatusEntityObject=new buysell_carbodystatusEntity($DBAccessor);
        $result['carbodystatus_fid']=$carbodystatusEntityObject->FindAll(new QueryLogic());
        $carstatusEntityObject=new buysell_carstatusEntity($DBAccessor);
        $result['carstatus_fid']=$carstatusEntityObject->FindAll(new QueryLogic());
        $shasitypeEntityObject=new buysell_shasitypeEntity($DBAccessor);
        $result['shasitype_fid']=$shasitypeEntityObject->FindAll(new QueryLogic());
        $carmodelEntityObject=new buysell_carmodelEntity($DBAccessor);
        $GroupQ=new QueryLogic();
        $GroupQ->addCondition(new FieldCondition("cargroup_fid",$GroupID));
        $result['carmodel_fid']=$carmodelEntityObject->FindAll($GroupQ);
        $cartagtypeEntityObject=new buysell_cartagtypeEntity($DBAccessor);
        $result['cartagtype_fid']=$cartagtypeEntityObject->FindAll(new QueryLogic());
        $carentitytypeEntityObject=new buysell_carentitytypeEntity($DBAccessor);
        $result['carentitytype_fid']=$carentitytypeEntityObject->FindAll(new QueryLogic());
        $carmakerEntityObject=new buysell_carmakerEntity($DBAccessor);
        $GroupQ=new QueryLogic();
        $GroupQ->addCondition(new FieldCondition("cargroup_fid",$GroupID));
        $result['carmaker_fid']=$carmakerEntityObject->FindAll($GroupQ);
		if($PageNum<=0)
			$PageNum=1;
		$carEnt=new buysell_carEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addCondition(new FieldCondition("cargroup_fid",$GroupID));
		$allcount=$carEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
        $q->addResultField(new DBField("buysell_car.*",true));
		$result['data']=$carEnt->FindAll($q);
		for ($i=0;$i<count($result['data']);$i++)
        {
            $item=$result['data'][$i];
            $ID=$item->getId();
            $CarPEnt=new buysell_carphotoEntity($DBAccessor);
            $q=new QueryLogic();
            $q->addCondition(new FieldCondition(buysell_carphotoEntity::$CAR_FID,$ID));
            $q->setLimit("0,5");
            $result['cardata'][$i]['photos']=$CarPEnt->FindAll($q);



            $ME=new buysell_carmodelEntity($DBAccessor);
//            $n=new buysell_carEntity();
//            $n->getRole_systemuser_fid();
            $ME->setId($item->getCarmodel_fid());
            $BE=new buysell_carmakerEntity($DBAccessor);
            $BE->setId($ME->getCarmaker_fid());
            $result['cardata'][$i]['model']=$ME;
            $result['cardata'][$i]['brand']=$BE;
            $BSE=new buysell_carbodystatusEntity($DBAccessor);
            $BSE->setId($item->getCarbodystatus_fid());
            $result['cardata'][$i]['bodystatus']=$BSE;

            $userID=$item->getRole_systemuser_fid();
            $UE=new buysell_userEntity($DBAccessor);
            $uq=new QueryLogic();
            $uq->addCondition(new FieldCondition("role_systemuser_fid",$userID));
            $userinf=$UE->FindOne($uq);
            $cityID=$userinf->getCommon_city_fid();
            $CSE=new common_cityEntity($DBAccessor);
            $CSE->setId($cityID);
            $result['cardata'][$i]['city']=$CSE;
        }
		$result['group']['id']=$GroupID;
		$DBAccessor->close_connection();
		return $result;
	}
    public function Search($PageNum,$details,$pricemin,$pricemax,$adddate,$body_carcolor_fid,$inner_carcolor_fid,$paytype_fid,$cartype_fid,$usagecountmin,$usagecountmax,$wheretodate,$carbodystatus_fid,$makedatemin,$makedatemax,$carstatus_fid,$shasitype_fid,$isautogearbox,$carmodel_fid,$cartagtype_fid,$carentitytype_fid,$sortby,$isdesc,$GroupID)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $result=array();
        $body_carcolorEntityObject=new buysell_carcolorEntity($DBAccessor);
        $result['body_carcolor_fid']=$body_carcolorEntityObject->FindAll(new QueryLogic());
        $inner_carcolorEntityObject=new buysell_carcolorEntity($DBAccessor);
        $result['inner_carcolor_fid']=$inner_carcolorEntityObject->FindAll(new QueryLogic());
        $paytypeEntityObject=new buysell_paytypeEntity($DBAccessor);
        $result['paytype_fid']=$paytypeEntityObject->FindAll(new QueryLogic());
        $cartypeEntityObject=new buysell_cartypeEntity($DBAccessor);
        $result['cartype_fid']=$cartypeEntityObject->FindAll(new QueryLogic());
        $carbodystatusEntityObject=new buysell_carbodystatusEntity($DBAccessor);
        $result['carbodystatus_fid']=$carbodystatusEntityObject->FindAll(new QueryLogic());
        $carstatusEntityObject=new buysell_carstatusEntity($DBAccessor);
        $result['carstatus_fid']=$carstatusEntityObject->FindAll(new QueryLogic());
        $shasitypeEntityObject=new buysell_shasitypeEntity($DBAccessor);
        $result['shasitype_fid']=$shasitypeEntityObject->FindAll(new QueryLogic());
        $carmodelEntityObject=new buysell_carmodelEntity($DBAccessor);
        $result['carmodel_fid']=$carmodelEntityObject->FindAll(new QueryLogic());
        $cartagtypeEntityObject=new buysell_cartagtypeEntity($DBAccessor);
        $result['cartagtype_fid']=$cartagtypeEntityObject->FindAll(new QueryLogic());
        $carentitytypeEntityObject=new buysell_carentitytypeEntity($DBAccessor);
        $result['carentitytype_fid']=$carentitytypeEntityObject->FindAll(new QueryLogic());
        if($PageNum<=0)
            $PageNum=1;
        $carEnt=new buysell_carEntity($DBAccessor);
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition("details","%$details%",LogicalOperator::LIKE));
        if($pricemin!="")
            $q->addCondition(new FieldCondition("price",$pricemin,LogicalOperator::Bigger));
        if($pricemax!="")
            $q->addCondition(new FieldCondition("price",$pricemax,LogicalOperator::Smaller));
        $q->addCondition(new FieldCondition("adddate","%$adddate%",LogicalOperator::LIKE));
        if($body_carcolor_fid!="")
            $q->addCondition(new FieldCondition("body_carcolor_fid","$body_carcolor_fid",LogicalOperator::Equal));
        if($inner_carcolor_fid!="")
            $q->addCondition(new FieldCondition("inner_carcolor_fid","$inner_carcolor_fid",LogicalOperator::Equal));
        if($paytype_fid!="")
            $q->addCondition(new FieldCondition("paytype_fid","$paytype_fid",LogicalOperator::Equal));
        if($cartype_fid!="")
            $q->addCondition(new FieldCondition("cartype_fid","$cartype_fid",LogicalOperator::Equal));
        if($usagecountmin!="")
            $q->addCondition(new FieldCondition("usagecount",$usagecountmin,LogicalOperator::Bigger));
        if($usagecountmax!="")
            $q->addCondition(new FieldCondition("usagecount",$usagecountmax,LogicalOperator::Smaller));
        $q->addCondition(new FieldCondition("wheretodate","%$wheretodate%",LogicalOperator::LIKE));
        if($carbodystatus_fid!="")
            $q->addCondition(new FieldCondition("carbodystatus_fid","$carbodystatus_fid",LogicalOperator::Equal));
        if($makedatemin!="")
            $q->addCondition(new FieldCondition("makedate",$makedatemin,LogicalOperator::Bigger));
        if($makedatemax!="")
            $q->addCondition(new FieldCondition("makedate",$makedatemax,LogicalOperator::Smaller));
        if($carstatus_fid!="")
            $q->addCondition(new FieldCondition("carstatus_fid","$carstatus_fid",LogicalOperator::Equal));
        if($shasitype_fid!="")
            $q->addCondition(new FieldCondition("shasitype_fid","$shasitype_fid",LogicalOperator::Equal));
        if($isautogearbox!="")
            $q->addCondition(new FieldCondition("isautogearbox","$isautogearbox",LogicalOperator::Equal));
        if($carmodel_fid!="")
            $q->addCondition(new FieldCondition("carmodel_fid","$carmodel_fid",LogicalOperator::Equal));
        if($cartagtype_fid!="")
            $q->addCondition(new FieldCondition("cartagtype_fid","$cartagtype_fid",LogicalOperator::Equal));
        if($carentitytype_fid!="")
            $q->addCondition(new FieldCondition("carentitytype_fid","$carentitytype_fid",LogicalOperator::Equal));
        $q->addOrderBy($sortby,$isdesc);
        $q->addResultField(new DBField("buysell_car.*",true));
        $allcount=$carEnt->FindAllCount($q);
        $result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
        $q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
        $result['data']=$carEnt->FindAll($q);
        for ($i=0;$i<count($result['data']);$i++)
        {
            $item=$result['data'][$i];
            $ID=$item->getId();
            $CarPEnt=new buysell_carphotoEntity($DBAccessor);
            $q=new QueryLogic();
            $q->addCondition(new FieldCondition(buysell_carphotoEntity::$CAR_FID,$ID));
            $q->setLimit("0,5");
            $result['cardata'][$i]['photos']=$CarPEnt->FindAll($q);



            $ME=new buysell_carmodelEntity($DBAccessor);
//            $n=new buysell_carEntity();
//            $n->getRole_systemuser_fid();
            $ME->setId($item->getCarmodel_fid());
            $BE=new buysell_carmakerEntity($DBAccessor);
            $BE->setId($ME->getCarmaker_fid());
            $result['cardata'][$i]['model']=$ME;
            $result['cardata'][$i]['brand']=$BE;
            $BSE=new buysell_carbodystatusEntity($DBAccessor);
            $BSE->setId($item->getCarbodystatus_fid());
            $result['cardata'][$i]['bodystatus']=$BSE;

            $userID=$item->getRole_systemuser_fid();
            $UE=new buysell_userEntity($DBAccessor);
            $uq=new QueryLogic();
            $uq->addCondition(new FieldCondition("role_systemuser_fid",$userID));
            $userinf=$UE->FindOne($uq);
            $cityID=$userinf->getCommon_city_fid();
            $CSE=new common_cityEntity($DBAccessor);
            $CSE->setId($cityID);
            $result['cardata'][$i]['city']=$CSE;
        }
        $result['group']['id']=$GroupID;
        $DBAccessor->close_connection();
        return $result;
    }
}
?>