<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\SweetDate;
use Modules\buysell\Entity\buysell_carmakerEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use Modules\buysell\Entity\buysell_carEntity;
use Modules\buysell\Entity\buysell_carcolorEntity;
use Modules\buysell\Entity\buysell_paytypeEntity;
use Modules\buysell\Entity\buysell_cartypeEntity;
use Modules\buysell\Entity\buysell_carbodystatusEntity;
use Modules\buysell\Entity\buysell_carstatusEntity;
use Modules\buysell\Entity\buysell_shasitypeEntity;
use Modules\buysell\Entity\buysell_carmodelEntity;
use Modules\buysell\Entity\buysell_cartagtypeEntity;
use Modules\buysell\Entity\buysell_carentitytypeEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-25 - 2017-06-15 02:03
*@lastUpdate 1396-03-25 - 2017-06-15 02:03
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class carmodelLoadController extends Controller {

	public function loadCarModels($CarMakerID,$DefaultValue="...")
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
            if($CarMakerID>0){

                $carmodelEntityObject=new buysell_carmodelEntity($DBAccessor);
                $q=new QueryLogic();
                $q->addCondition(new FieldCondition("carmaker_fid",$CarMakerID));
                $result['carmodel_fid']=$carmodelEntityObject->FindAll($q);
            }
		$DBAccessor->close_connection();
		return $result;
	}
}
?>