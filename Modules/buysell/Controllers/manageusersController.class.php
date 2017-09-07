<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\common\Entity\common_cityEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Entity\roleSystemUserEntity;
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
class manageusersController extends Controller {
	private $PAGESIZE=10;
	public function load($PageNum)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
			$common_cityEntityObject=new common_cityEntity($DBAccessor);
			$result['common_city_fid']=$common_cityEntityObject->FindAll(new QueryLogic());
			$carmodelEntityObject=new buysell_carmodelEntity($DBAccessor);
			$result['carmodel_fid']=$carmodelEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$userEnt=new buysell_userEntity($DBAccessor);
		$q=new QueryLogic();
		$allcount=$userEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$userEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function Search($PageNum,$name,$email,$tel,$mob,$postalcode,$ismale,$common_city_fid,$birthday,$ispayed,$signupdate,$photo,$is_info_visible,$carmodel_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
			$common_cityEntityObject=new common_cityEntity($DBAccessor);
			$result['common_city_fid']=$common_cityEntityObject->FindAll(new QueryLogic());
			$carmodelEntityObject=new buysell_carmodelEntity($DBAccessor);
			$result['carmodel_fid']=$carmodelEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;
		$userEnt=new buysell_userEntity($DBAccessor);
		$q=new QueryLogic();
$q->addCondition(new FieldCondition("name","%$name%",LogicalOperator::LIKE));
$q->addCondition(new FieldCondition("email","%$email%",LogicalOperator::LIKE));
$q->addCondition(new FieldCondition("tel","%$tel%",LogicalOperator::LIKE));
$q->addCondition(new FieldCondition("mob","%$mob%",LogicalOperator::LIKE));
$q->addCondition(new FieldCondition("postalcode","%$postalcode%",LogicalOperator::LIKE));
$q->addCondition(new FieldCondition("ismale","%$ismale%",LogicalOperator::LIKE));
$q->addCondition(new FieldCondition("common_city_fid","%$common_city_fid%",LogicalOperator::LIKE));
$q->addCondition(new FieldCondition("birthday","%$birthday%",LogicalOperator::LIKE));
$q->addCondition(new FieldCondition("ispayed","%$ispayed%",LogicalOperator::LIKE));
$q->addCondition(new FieldCondition("signupdate","%$signupdate%",LogicalOperator::LIKE));
$q->addCondition(new FieldCondition("photo","%$photo%",LogicalOperator::LIKE));
$q->addCondition(new FieldCondition("is_info_visible","%$is_info_visible%",LogicalOperator::LIKE));
$q->addCondition(new FieldCondition("carmodel_fid","%$carmodel_fid%",LogicalOperator::LIKE));
$q->addOrderBy($sortby,$isdesc);
		$allcount=$userEnt->FindAllCount($q);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$q->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$userEnt->FindAll($q);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function DeleteItem($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
        $DBAccessor->beginTransaction();
		$userEnt=new buysell_userEntity($DBAccessor);
		$userEnt->setId($ID);
		if($userEnt->getId()==-1)
			throw new DataNotFoundException();
        $roleSystemUser=$userEnt->getRole_systemuser_fid();
        $rs=new roleSystemUserEntity();
        $rs->Update($roleSystemUser,null,null,null,1);
		$userEnt->Remove();
        $DBAccessor->commit();
        $DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>