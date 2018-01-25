<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\iribfinance\Entity\iribfinance_programestimationemployeeEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_paymentlicenceEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managepaymentlicenceController extends Controller {
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
		$paymentlicenceEntityObject=new iribfinance_paymentlicenceEntity($DBAccessor);
		$programestimationemployeeEntityObject=new iribfinance_programestimationemployeeEntity($DBAccessor);
		$result['programestimationemployee_fid']=$programestimationemployeeEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('paymentlicence_fid',$ID));
		$result['paymentlicence']=$paymentlicenceEntityObject;
		if($ID!=-1){
			$paymentlicenceEntityObject->setId($ID);
			if($paymentlicenceEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $paymentlicenceEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['paymentlicence']=$paymentlicenceEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$programestimationemployee_fid,$month,$pay_date,$work,$decrementtime,$workfactor)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$paymentlicenceEntityObject=new iribfinance_paymentlicenceEntity($DBAccessor);
		$this->ValidateFieldArray([$programestimationemployee_fid,$month,$pay_date,$work,$decrementtime,$workfactor],[$paymentlicenceEntityObject->getFieldInfo(iribfinance_paymentlicenceEntity::$PROGRAMESTIMATIONEMPLOYEE_FID),$paymentlicenceEntityObject->getFieldInfo(iribfinance_paymentlicenceEntity::$MONTH),$paymentlicenceEntityObject->getFieldInfo(iribfinance_paymentlicenceEntity::$PAY_DATE),$paymentlicenceEntityObject->getFieldInfo(iribfinance_paymentlicenceEntity::$WORK),$paymentlicenceEntityObject->getFieldInfo(iribfinance_paymentlicenceEntity::$DECREMENTTIME),$paymentlicenceEntityObject->getFieldInfo(iribfinance_paymentlicenceEntity::$WORKFACTOR)]);
		if($ID==-1){
			$paymentlicenceEntityObject->setProgramestimationemployee_fid($programestimationemployee_fid);
			$paymentlicenceEntityObject->setMonth($month);
			$paymentlicenceEntityObject->setPay_date($pay_date);
			$paymentlicenceEntityObject->setWork($work);
			$paymentlicenceEntityObject->setDecrementtime($decrementtime);
			$paymentlicenceEntityObject->setWorkfactor($workfactor);
			$paymentlicenceEntityObject->Save();
			$ID=$paymentlicenceEntityObject->getId();
		}
		else{
			$paymentlicenceEntityObject->setId($ID);
			if($paymentlicenceEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $paymentlicenceEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$paymentlicenceEntityObject->setProgramestimationemployee_fid($programestimationemployee_fid);
			$paymentlicenceEntityObject->setMonth($month);
			$paymentlicenceEntityObject->setPay_date($pay_date);
			$paymentlicenceEntityObject->setWork($work);
			$paymentlicenceEntityObject->setDecrementtime($decrementtime);
			$paymentlicenceEntityObject->setWorkfactor($workfactor);
			$paymentlicenceEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('paymentlicence_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>