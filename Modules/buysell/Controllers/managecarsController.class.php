<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_carmakerEntity;
use Modules\buysell\Entity\buysell_carmodelEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use Modules\buysell\Entity\buysell_carEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-29 - 2017-06-19 19:04
*@lastUpdate 1396-03-29 - 2017-06-19 19:04
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 2.001
*/
class managecarsController extends Controller {
	private $PAGESIZE=10;
	public function load($PageNum,$GroupID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
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

		for($i=0;$result['data']!=null && $i<count($result['data']);$i++){
            $ME=new buysell_carmodelEntity($DBAccessor);
            $ME->setId($result['data'][$i]->getCarmodel_fid());
            $BE=new buysell_carmakerEntity($DBAccessor);
            $BE->setId($ME->getCarmaker_fid());
            $result['cardata'][$i]['model']=$ME;
            $result['cardata'][$i]['brand']=$BE;
        }

		$result['group']['id']=$GroupID;
		$DBAccessor->close_connection();
		return $result;
	}
	public function DeleteItem($ID,$GroupID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$carEnt=new buysell_carEntity($DBAccessor);
		$carEnt->setId($ID);
		$carEnt->Remove();
		return $this->load(-1,$GroupID);
		$DBAccessor->close_connection();
	}
}
?>