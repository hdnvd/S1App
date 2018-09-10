<?php
namespace Modules\kpex\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\kpex\Entity\kpex_contextEntity;
use Modules\kpex\Entity\kpex_methodEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\kpex\Entity\kpex_testEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-06-19 - 2018-09-10 10:26
*@lastUpdate 1397-06-19 - 2018-09-10 10:26
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class testlistController extends Controller {
	private $PAGESIZE=50;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$contextEntityObject=new kpex_contextEntity($DBAccessor);
		$result['context_fid']=$contextEntityObject->FindAll(new QueryLogic());
		$methodEntityObject=new kpex_methodEntity($DBAccessor);
		$result['method_fid']=$methodEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(kpex_testEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$testEnt=new kpex_testEntity($DBAccessor);
		$result['test']=$testEnt;
        $result['total_rates']=$testEnt->getAverageRates($QueryLogic);
		$allcount=$testEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$testEnt->FindAll($QueryLogic);
		for($i=0;$i<count($result['data']);$i++)
        {
            $methods=new kpex_methodEntity($DBAccessor);
            $methods->setId($result['data'][$i]->getMethod_fid());
            $result['methods'][$i]=$methods;
        }
		$DBAccessor->close_connection();
		return $result;
	}
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
	public function load($PageNum)
	{
		$DBAccessor=new dbaccess();
		$testEnt=new kpex_testEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$nouninfluence,$nounoutinfluence,$adjectiveinfluence,$adjectiveoutinfluence,$similarity_threshold,$similarity_influence,$resultcount,$context_fid,$description,$words,$is_postaged,$is_similarityedgeweighed,$method_fid,$apprate,$precisionrate,$recall,$fscore,$idfrom,$idto,$sortby,$isdesc)
	{

		$DBAccessor=new dbaccess();
		$testEnt=new kpex_testEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("nouninfluence","%$nouninfluence%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("nounoutinfluence","%$nounoutinfluence%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("adjectiveinfluence","%$adjectiveinfluence%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("adjectiveoutinfluence","%$adjectiveoutinfluence%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("similarity_threshold","%$similarity_threshold%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("similarity_influence","%$similarity_influence%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("resultcount","%$resultcount%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("context_fid","%$context_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("description","%$description%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("words","%$words%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("is_postaged","%$is_postaged%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("is_similarityedgeweighed","%$is_similarityedgeweighed%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("method_fid","%$method_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("apprate","%$apprate%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("precisionrate","%$precisionrate%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("recall","%$recall%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("fscore","%$fscore%",LogicalOperator::LIKE));
		if($idfrom!="")
        {
            $idfrom=$idfrom-1;
            $q->addCondition(new FieldCondition("id","$idfrom",LogicalOperator::Bigger));
        }
        if($idto!="")
        {
            $idto=$idto+1;
            $q->addCondition(new FieldCondition("id","$idto",LogicalOperator::Smaller));
        }
		$sortByField=$testEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>