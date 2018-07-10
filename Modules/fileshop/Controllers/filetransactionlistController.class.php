<?php
namespace Modules\fileshop\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\fileshop\Entity\fileshop_filetransactionEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-09 - 2017-11-30 16:35
*@lastUpdate 1396-09-09 - 2017-11-30 16:35
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class filetransactionlistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$fileEntityObject=new fileshop_fileEntity($DBAccessor);
		$result['file_fid']=$fileEntityObject->FindAll(new QueryLogic());
		$finance_bankpaymentinfoEntityObject=new fileshop_bankpaymentinfoEntity($DBAccessor);
		$result['finance_bankpaymentinfo_fid']=$finance_bankpaymentinfoEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(fileshop_filetransactionEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$filetransactionEnt=new fileshop_filetransactionEntity($DBAccessor);
		$result['filetransaction']=$filetransactionEnt;
		$allcount=$filetransactionEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$filetransactionEnt->FindAll($QueryLogic);
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
		$filetransactionEnt=new fileshop_filetransactionEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$file_fid,$finance_bankpaymentinfo_fid,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$filetransactionEnt=new fileshop_filetransactionEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("file_fid","%$file_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("finance_bankpaymentinfo_fid","%$finance_bankpaymentinfo_fid%",LogicalOperator::LIKE));
		$sortByField=$filetransactionEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>