<?php
namespace Modules\oras\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\oras\Entity\oras_employeeroleEntity;
use Modules\oras\Entity\oras_placeEntity;
use Modules\oras\Entity\oras_roleEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\oras\Entity\oras_employeeEntity;
use Modules\oras\Entity\oras_photoEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 16:20
*@lastUpdate 1396-07-12 - 2017-10-04 16:20
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class employeelistController extends Controller {
	private $PAGESIZE=25;
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
            $QueryLogic->addCondition(new FieldCondition(oras_employeeEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$employeeEnt=new oras_employeeEntity($DBAccessor);
		$result['employee']=$employeeEnt;
		$allcount=$employeeEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$employeeEnt->FindAll($QueryLogic);
		$dt=$result['data'];
        $dtCnt=0;
        if($dt!=null)
		    $dtCnt=count($dt);
		for($i=0;$i<$dtCnt;$i++)
        {
            $empRole=new oras_employeeroleEntity($DBAccessor);
            $q2=new QueryLogic();
            $q2->addCondition(new FieldCondition(oras_employeeroleEntity::$EMPLOYEE_FID,$dt[$i]->getID()));
            $q2->addOrderBy(oras_employeeroleEntity::$START_TIME,true);
            $result['emprole'][$i]=$empRole->FindOne($q2);

            $er=$result['emprole'][$i];
            if($er!=null)
            {
                $rEnt=new oras_roleEntity($DBAccessor);
                $rEnt->setId($er->getRole_fid());
                $pEnt=new oras_placeEntity($DBAccessor);
                $pEnt->setId($er->getPlace_fid());
              $result['role'][$i]  =$rEnt;
                $result['place'][$i]  =$pEnt;
            }

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
		$employeeEnt=new oras_employeeEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$mellicode,$name,$family,$ismale,$phonenumber,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$employeeEnt=new oras_employeeEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("mellicode","%$mellicode%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("name","%$name%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("family","%$family%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("ismale","%$ismale%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("phonenumber","%$phonenumber%",LogicalOperator::LIKE));
		$sortByField=$employeeEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>