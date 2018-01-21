<?php
namespace Modules\fileshop\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\fileshop\Entity\fileshop_filecategoryEntity;
use Modules\fileshop\Entity\fileshop_filetransactionEntity;
use Modules\finance\Exceptions\LowBalanceException;
use Modules\finance\PublicClasses\Payment;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\fileshop\Entity\fileshop_fileEntity;
use Modules\users\PublicClasses\User;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-09 - 2017-11-30 16:33
*@lastUpdate 1396-09-09 - 2017-11-30 16:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class filelistController extends Controller {
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
            $QueryLogic->addCondition(new FieldCondition(fileshop_fileEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$fileEnt=new fileshop_fileEntity($DBAccessor);
		$result['file']=$fileEnt;
		$allcount=$fileEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$fileEnt->FindAll($QueryLogic);
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
		$fileEnt=new fileshop_fileEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
    public function loadCategoryFiles($catID)
    {
        $DBAccessor=new dbaccess();
        $fileEnt=new fileshop_fileEntity($DBAccessor);
        $fileCatEnt=new fileshop_filecategoryEntity($DBAccessor);
        $qFCat=new QueryLogic();
        $qFCat->addCondition(new FieldCondition(fileshop_filecategoryEntity::$COMMON_CATEGORY_FID,$catID));
        $catFiles=$fileCatEnt->FindAll($qFCat);
        $files=array();
        $AllCount1 = count($catFiles);
        for ($i = 0; $i < $AllCount1; $i++) {
            $CatF=$catFiles[$i];
            $files[$i]=new fileshop_fileEntity($DBAccessor);
            $files[$i]->setID($CatF->getFile_fid());
        }

        $DBAccessor->close_connection();
        $fileEnt=new fileshop_fileEntity($DBAccessor);
        $result['file']=$fileEnt;
        $result['data']=$files;
        return $result;
    }
	public function Search($PageNum,$title,$add_date_from,$add_date_to,$description,$price,$filecount,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$fileEnt=new fileshop_fileEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("title","%$title%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("add_date",$add_date_from,LogicalOperator::Bigger));
		$q->addCondition(new FieldCondition("add_date",$add_date_to,LogicalOperator::Smaller));
		$q->addCondition(new FieldCondition("description","%$description%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("price","%$price%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("filecount","%$filecount%",LogicalOperator::LIKE));
		$sortByField=$fileEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}

    public function buy($FileID,$UserName,$Password)
    {
        $DBAccessor=new dbaccess();
        $ent=new fileshop_fileEntity($DBAccessor);
        $ent->setId($FileID);
        if($ent->getId()<=0)
            throw new DataNotFoundException();

        $user=new User(-1);
        $SystemUserID=$user->getSystemUserIDFromUserPass($UserName,$Password);
        $Payment=new Payment();
        $UserBalance=$Payment->getBalance(1,$SystemUserID);
//        echo $UserBalance;
        if($UserBalance<$ent->getPrice())
            throw new LowBalanceException();
        $result=$Payment->startTransaction(-1*$ent->getPrice(),$SystemUserID,'','','','خرید فایل',1,false,'',$SystemUserID);
        $resEnt=new fileshop_filetransactionEntity($DBAccessor);
        $resEnt->setFinance_transaction_fid($result['transaction']['id']);
        $resEnt->setFile_fid($ent->getId());
        $resEnt->Save();
        return [];


    }
}
?>