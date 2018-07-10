<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\ocms\Entity\ocms_doctorEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_doctorfileEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-06 - 2018-03-26 16:43
*@lastUpdate 1397-01-06 - 2018-03-26 16:43
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class doctorfilelistController extends Controller {
	private $PAGESIZE=10;
	public function getData($PageNum,QueryLogic $QueryLogic,$doctor_fid)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$doctorEntityObject=new ocms_doctorEntity($DBAccessor);
		$result['doctor_fid']=$doctorEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(ocms_doctorfileEntity::$ROLE_SYSTEMUSER_FID,$UserID));
        if($doctor_fid<=0)
            $doctor_fid=managedoctorfileController::getDoctorIDFromSysUserID($DBAccessor,$role_systemuser_fid);
        $QueryLogic->addCondition(new FieldCondition(ocms_doctorfileEntity::$DOCTOR_FID,$doctor_fid));
		$doctorfileEnt=new ocms_doctorfileEntity($DBAccessor);
		$result['doctorfile']=$doctorfileEnt;
		$allcount=$doctorfileEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$doctorfileEnt->FindAll($QueryLogic);
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
	public function load($PageNum,$DoctorID=-1)
	{
		$DBAccessor=new dbaccess();
		$doctorfileEnt=new ocms_doctorfileEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q,$DoctorID);
	}
	public function Search($PageNum,$description,$doctor_fid,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$doctorfileEnt=new ocms_doctorfileEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("description","%$description%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("doctor_fid","%$doctor_fid%",LogicalOperator::LIKE));
		$sortByField=$doctorfileEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q,$doctor_fid);
	}
}
?>