<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_devicetypeEntity;
use Modules\itsap\Entity\itsap_servicerequestEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_servicerequestdeviceEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-16 - 2018-04-05 00:53
*@lastUpdate 1397-01-16 - 2018-04-05 00:53
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class servicerequestdevicelistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$devicetypeEntityObject=new itsap_devicetypeEntity($DBAccessor);
		$result['devicetype_fid']=$devicetypeEntityObject->FindAll(new QueryLogic());
		$servicerequestEntityObject=new itsap_servicerequestEntity($DBAccessor);
		$result['servicerequest_fid']=$servicerequestEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(itsap_servicerequestdeviceEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$servicerequestdeviceEnt=new itsap_servicerequestdeviceEntity($DBAccessor);
		$result['servicerequestdevice']=$servicerequestdeviceEnt;
		$allcount=$servicerequestdeviceEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$servicerequestdeviceEnt->FindAll($QueryLogic);
		for($i=0;$i<count($result['data']);$i++)
        {
            $DevType=new itsap_devicetypeEntity($DBAccessor);
            $DevType->setId($result['data'][$i]->getDevicetype_fid());
            $result['devicetypes'][$i]=$DevType;

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
	public function load($PageNum,$ServiceRequestID)
	{
		$DBAccessor=new dbaccess();
		$servicerequestdeviceEnt=new itsap_servicerequestdeviceEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition(itsap_servicerequestdeviceEntity::$SERVICEREQUEST_FID,$ServiceRequestID));
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$code,$devicetype_fid,$servicerequest_fid,$description,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$servicerequestdeviceEnt=new itsap_servicerequestdeviceEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("code","%$code%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("devicetype_fid","%$devicetype_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("servicerequest_fid","%$servicerequest_fid%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("description","%$description%",LogicalOperator::LIKE));
		$sortByField=$servicerequestdeviceEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>