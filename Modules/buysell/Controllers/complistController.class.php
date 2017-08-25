<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_carmodelEntity;
use Modules\buysell\Entity\buysell_componentcarmodelEntity;
use Modules\buysell\Entity\buysell_componentEntity;
use Modules\buysell\Entity\buysell_componentphotoEntity;
use Modules\buysell\PublicClasses\Constants;
use Modules\common\Entity\common_countryEntity;
use Modules\company\Entity\company_customerEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-27 - 2017-02-15 15:29
*@lastUpdate 1395-11-27 - 2017-02-15 15:29
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class complistController extends Controller {
    private $PAGESIZE=5;
	public function load($PageNumber,array $SortBy,array $IsDESC,$GroupID,$Status_fid,$CarGroupID)
	{

	    if($GroupID<0)
	        $GroupID=null;
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $result['groupid']=$GroupID;
		if($PageNumber<=0)
            $PageNumber=1;
        if($SortBy==null)
        {
            $SortBy=array('adddate');
            $IsDESC=array(true);
        }
        $Compent=new buysell_componentEntity($DBAccessor);
        $photEnt=new buysell_componentphotoEntity($DBAccessor);
        $carEnt=new buysell_carmodelEntity($DBAccessor);
        $countEnt=new common_countryEntity($DBAccessor);
        $compCarModEnt=new buysell_componentcarmodelEntity($DBAccessor);
        $allComps=$Compent->FullSelect(null,null,null,null,$Status_fid,null,null,$GroupID,null,null,null,null,null,$CarGroupID,array(),array(),null);
        $allcount=count($allComps);
        $result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
        $result['components']=$Compent->FullSelect(null,null,null,null,$Status_fid,null,null,$GroupID,null,null,null,null,null,$CarGroupID,$SortBy,$IsDESC,$this->getPageRowsLimit($PageNumber,$this->PAGESIZE));
		for ($i=0;$i<count($result['components']);$i++)
        {
            $result['components'][$i]['photos']=$photEnt->Select(null,$result['components'][$i]['id'],null,null,array('priority'),array(false),"0,1");
        }
        for ($i=0;$i<count($result['components']);$i++)
        {
            $result['components'][$i]['country']=$countEnt->Select($result['components'][$i]['country_fid'],null,null,array('id'),array(false),"0,1")[0];
        }
        for ($i=0;$i<count($result['components']);$i++)
        {
            $carmodelIds[$i]=$compCarModEnt->Select(null,$result['components'][$i]['id'],null,array(),array(),"0,100");
            for($j=0;$j<count($carmodelIds[$i]);$j++)
                $result['components'][$i]['carmodels']=$carEnt->Select($carmodelIds[$i][$j]['carmodel_fid'],null,null,null,$CarGroupID,array('id'),array(false),"0,1");
        }

        $result['group']['id']=$CarGroupID;
        $DBAccessor->close_connection();
		return $result;
	}
}
?>