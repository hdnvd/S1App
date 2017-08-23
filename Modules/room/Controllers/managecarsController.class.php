<?php
namespace Modules\room\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\room\Entity\room_carEntity;
use Modules\room\Entity\room_carcolorEntity;
use Modules\room\Entity\room_paytypeEntity;
use Modules\room\Entity\room_cartypeEntity;
use Modules\room\Entity\room_carbodystatusEntity;
use Modules\room\Entity\room_carstatusEntity;
use Modules\room\Entity\room_shasitypeEntity;
use Modules\room\Entity\room_carmodelEntity;
use Modules\room\Entity\room_cartagtypeEntity;
use Modules\room\Entity\room_carentitytypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-05-25 - 2017-08-16 01:15
*@lastUpdate 1396-05-25 - 2017-08-16 01:15
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managecarsController extends Controller {
	private $PAGESIZE=10;
	public function load($PageNum)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
			$body_carcolorEntityObject=new room_carcolorEntity($DBAccessor);
			$result['body_carcolor_fid']=$body_carcolorEntityObject->FindAll(new QueryLogic());
			$inner_carcolorEntityObject=new room_carcolorEntity($DBAccessor);
			$result['inner_carcolor_fid']=$inner_carcolorEntityObject->FindAll(new QueryLogic());
			$paytypeEntityObject=new room_paytypeEntity($DBAccessor);
			$result['paytype_fid']=$paytypeEntityObject->FindAll(new QueryLogic());
			$cartypeEntityObject=new room_cartypeEntity($DBAccessor);
			$result['cartype_fid']=$cartypeEntityObject->FindAll(new QueryLogic());
			$carbodystatusEntityObject=new room_carbodystatusEntity($DBAccessor);
			$result['carbodystatus_fid']=$carbodystatusEntityObject->FindAll(new QueryLogic());
			$carstatusEntityObject=new room_carstatusEntity($DBAccessor);
			$result['carstatus_fid']=$carstatusEntityObject->FindAll(new QueryLogic());
			$shasitypeEntityObject=new room_shasitypeEntity($DBAccessor);
			$result['shasitype_fid']=$shasitypeEntityObject->FindAll(new QueryLogic());
			$carmodelEntityObject=new room_carmodelEntity($DBAccessor);
			$result['carmodel_fid']=$carmodelEntityObject->FindAll(new QueryLogic());
			$cartagtypeEntityObject=new room_cartagtypeEntity($DBAccessor);
			$result['cartagtype_fid']=$cartagtypeEntityObject->FindAll(new QueryLogic());
			$carentitytypeEntityObject=new room_carentitytypeEntity($DBAccessor);
			$result['carentitytype_fid']=$carentitytypeEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$carEnt=new room_carEntity($DBAccessor);
		$q=new QueryLogic();
		$allcount=$carEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$carEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function Search($PageNum,$details,$price,$adddate,$body_carcolor_fid,$inner_carcolor_fid,$paytype_fid,$cartype_fid,$usagecount,$wheretodate,$carbodystatus_fid,$makedate,$carstatus_fid,$shasitype_fid,$isautogearbox,$carmodel_fid,$cartagtype_fid,$carentitytype_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
			$body_carcolorEntityObject=new room_carcolorEntity($DBAccessor);
			$result['body_carcolor_fid']=$body_carcolorEntityObject->FindAll(new QueryLogic());
			$inner_carcolorEntityObject=new room_carcolorEntity($DBAccessor);
			$result['inner_carcolor_fid']=$inner_carcolorEntityObject->FindAll(new QueryLogic());
			$paytypeEntityObject=new room_paytypeEntity($DBAccessor);
			$result['paytype_fid']=$paytypeEntityObject->FindAll(new QueryLogic());
			$cartypeEntityObject=new room_cartypeEntity($DBAccessor);
			$result['cartype_fid']=$cartypeEntityObject->FindAll(new QueryLogic());
			$carbodystatusEntityObject=new room_carbodystatusEntity($DBAccessor);
			$result['carbodystatus_fid']=$carbodystatusEntityObject->FindAll(new QueryLogic());
			$carstatusEntityObject=new room_carstatusEntity($DBAccessor);
			$result['carstatus_fid']=$carstatusEntityObject->FindAll(new QueryLogic());
			$shasitypeEntityObject=new room_shasitypeEntity($DBAccessor);
			$result['shasitype_fid']=$shasitypeEntityObject->FindAll(new QueryLogic());
			$carmodelEntityObject=new room_carmodelEntity($DBAccessor);
			$result['carmodel_fid']=$carmodelEntityObject->FindAll(new QueryLogic());
			$cartagtypeEntityObject=new room_cartagtypeEntity($DBAccessor);
			$result['cartagtype_fid']=$cartagtypeEntityObject->FindAll(new QueryLogic());
			$carentitytypeEntityObject=new room_carentitytypeEntity($DBAccessor);
			$result['carentitytype_fid']=$carentitytypeEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$carEnt=new room_carEntity($DBAccessor);
		$q=new QueryLogic();		
$q->addCondition(new FieldCondition("details","%$details%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("price","%$price%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("adddate","%$adddate%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("body_carcolor_fid","%$body_carcolor_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("inner_carcolor_fid","%$inner_carcolor_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("paytype_fid","%$paytype_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("cartype_fid","%$cartype_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("usagecount","%$usagecount%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("wheretodate","%$wheretodate%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("carbodystatus_fid","%$carbodystatus_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("makedate","%$makedate%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("carstatus_fid","%$carstatus_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("shasitype_fid","%$shasitype_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("isautogearbox","%$isautogearbox%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("carmodel_fid","%$carmodel_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("cartagtype_fid","%$cartagtype_fid%",LogicalOperator::LIKE));		
$q->addCondition(new FieldCondition("carentitytype_fid","%$carentitytype_fid%",LogicalOperator::LIKE));		
$q->addOrderBy($sortby,$isdesc);
		$allcount=$carEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$carEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function DeleteItem($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$carEnt=new room_carEntity($DBAccessor);
		$carEnt->setId($ID);
		if($carEnt->getId()==-1)
			throw new DataNotFoundException();
		$carEnt->Remove();
		return $this->load(-1);
		$DBAccessor->close_connection();
	}
}
?>