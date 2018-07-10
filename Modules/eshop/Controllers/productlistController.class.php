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
use Modules\eshop\Entity\eshop_productEntity;
use Modules\eshop\Entity\eshop_pic1Entity;
use Modules\eshop\Entity\eshop_pic2Entity;
use Modules\eshop\Entity\eshop_pic3Entity;
use Modules\eshop\Entity\eshop_pic4Entity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-08-28 - 2017-11-19 00:39
*@lastUpdate 1396-08-28 - 2017-11-19 00:39
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class productlistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(eshop_productEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$productEnt=new eshop_productEntity($DBAccessor);
		$result['product']=$productEnt;
		$allcount=$productEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$productEnt->FindAll($QueryLogic);
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
		$productEnt=new eshop_productEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$title,$latintitle,$description,$price,$code,$adddate,$visitcount,$is_exists,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$productEnt=new eshop_productEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("title","%$title%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("latintitle","%$latintitle%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("description","%$description%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("price","%$price%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("code","%$code%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("adddate","%$adddate%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("visitcount","%$visitcount%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("is_exists","%$is_exists%",LogicalOperator::LIKE));
		$sortByField=$productEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>