<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\iribfinance\Entity\iribfinance_employeeEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_prosperityfundEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 19:04
*@lastUpdate 1396-11-05 - 2018-01-25 19:04
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageprosperityfundController extends Controller {
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
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$prosperityfundEntityObject=new iribfinance_prosperityfundEntity($DBAccessor);
		$employeeEntityObject=new iribfinance_employeeEntity($DBAccessor);
		$result['employee_fid']=$employeeEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('prosperityfund_fid',$ID));
		$result['prosperityfund']=$prosperityfundEntityObject;
		if($ID!=-1){
			$prosperityfundEntityObject->setId($ID);
			if($prosperityfundEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $prosperityfundEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['prosperityfund']=$prosperityfundEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$employee_fid,$totalamount,$add_date,$monthcount,$amountpermonth,$isactive)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$prosperityfundEntityObject=new iribfinance_prosperityfundEntity($DBAccessor);
		$this->ValidateFieldArray([$employee_fid,$totalamount,$add_date,$monthcount,$amountpermonth,$isactive],[$prosperityfundEntityObject->getFieldInfo(iribfinance_prosperityfundEntity::$EMPLOYEE_FID),$prosperityfundEntityObject->getFieldInfo(iribfinance_prosperityfundEntity::$TOTALAMOUNT),$prosperityfundEntityObject->getFieldInfo(iribfinance_prosperityfundEntity::$ADD_DATE),$prosperityfundEntityObject->getFieldInfo(iribfinance_prosperityfundEntity::$MONTHCOUNT),$prosperityfundEntityObject->getFieldInfo(iribfinance_prosperityfundEntity::$AMOUNTPERMONTH),$prosperityfundEntityObject->getFieldInfo(iribfinance_prosperityfundEntity::$ISACTIVE)]);
		if($ID==-1){
			$prosperityfundEntityObject->setEmployee_fid($employee_fid);
			$prosperityfundEntityObject->setTotalamount($totalamount);
			$prosperityfundEntityObject->setAdd_date($add_date);
			$prosperityfundEntityObject->setMonthcount($monthcount);
			$prosperityfundEntityObject->setAmountpermonth($amountpermonth);
			$prosperityfundEntityObject->setIsactive($isactive);
			$prosperityfundEntityObject->Save();
			$ID=$prosperityfundEntityObject->getId();
		}
		else{
			$prosperityfundEntityObject->setId($ID);
			if($prosperityfundEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $prosperityfundEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$prosperityfundEntityObject->setEmployee_fid($employee_fid);
			$prosperityfundEntityObject->setTotalamount($totalamount);
			$prosperityfundEntityObject->setAdd_date($add_date);
			$prosperityfundEntityObject->setMonthcount($monthcount);
			$prosperityfundEntityObject->setAmountpermonth($amountpermonth);
			$prosperityfundEntityObject->setIsactive($isactive);
			$prosperityfundEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('prosperityfund_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>