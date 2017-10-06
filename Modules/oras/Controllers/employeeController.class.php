<?php
namespace Modules\oras\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\oras\Entity\oras_complexqueriesEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\oras\Entity\oras_employeeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 16:08
*@lastUpdate 1396-07-12 - 2017-10-04 16:08
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class employeeController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$employeeEntityObject=new oras_employeeEntity($DBAccessor);
		$result['employee']=$employeeEntityObject;
		if($ID!=-1){
			$employeeEntityObject->setId($ID);
			if($employeeEntityObject->getId()==-1)
				throw new DataNotFoundException();
			$cmpEnt=new oras_complexqueriesEntity($DBAccessor);
            $result['employeetotalnegativepoints']=$cmpEnt->getEmployeePointsSum($ID,-1);
            $result['employeetotalpositivepoints']=$cmpEnt->getEmployeePointsSum($ID,1);

            $result['employeetotalnegativerecords']=$cmpEnt->getEmployeeRecordsCount($ID,-1);
            $result['employeetotalpositiverecords']=$cmpEnt->getEmployeeRecordsCount($ID,1);
            $result['employeetotalallrecords']=$cmpEnt->getEmployeeRecordsCount($ID);

            if($result['employeetotalnegativepoints']!=null)
                $result['employeetotalnegativepoints']=$result['employeetotalnegativepoints'][0]['pointsum'];
            if($result['employeetotalnegativepoints']=="")
                $result['employeetotalnegativepoints']="0";

            if($result['employeetotalpositivepoints']!=null)
                $result['employeetotalpositivepoints']=$result['employeetotalpositivepoints'][0]['pointsum'];
            if($result['employeetotalpositivepoints']=="")
                $result['employeetotalpositivepoints']="0";


            if($result['employeetotalnegativerecords']!=null)
                $result['employeetotalnegativerecords']=$result['employeetotalnegativerecords'][0]['recordcount'];

            if($result['employeetotalpositiverecords']!=null)
                $result['employeetotalpositiverecords']=$result['employeetotalpositiverecords'][0]['recordcount'];


            if($result['employeetotalallrecords']!=null)
                $result['employeetotalallrecords']=$result['employeetotalallrecords'][0]['recordcount'];

            $result['employeetotalpoints']=$result['employeetotalpositivepoints']+$result['employeetotalnegativepoints'];
			$result['employee']=$employeeEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}

}
?>