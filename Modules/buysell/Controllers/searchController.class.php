<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\db\DBField;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_carmakerEntity;
use Modules\buysell\Entity\buysell_carmodelEntity;
use Modules\buysell\Entity\buysell_componentEntity;
use Modules\buysell\Entity\buysell_componentgroupEntity;
use Modules\buysell\Entity\buysell_componentphotoEntity;
use Modules\common\Entity\common_cityEntity;
use Modules\common\Entity\common_countryEntity;
use Modules\common\Entity\common_provinceEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-02-19 - 2017-05-09 17:42
*@lastUpdate 1396-02-19 - 2017-05-09 17:42
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class searchController extends Controller {
    private $PAGESIZE=5;
	public function load($ID)
	{
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $result=array();
        $CountEnt=new common_countryEntity($DBAccessor);
        $CarModelEnt=new buysell_carmodelEntity($DBAccessor);
        $CompGroupEnt=new buysell_componentgroupEntity($DBAccessor);
        $carmakEnt=new buysell_carmakerEntity($DBAccessor);
        $ProvinceEnt=new common_provinceEntity($DBAccessor);
        $result['provinces']=$ProvinceEnt->Select(null,null,array('title'),array(false),"0,1000");
        $result['countries']=$CountEnt->Select(null,null,null,array('name'),array(false),"0,200");
        $result['carmodels']=$CarModelEnt->Select(null,null,null,null,-1,array('carmaker_fid','title'),array(false,false),"0,3000");
        for ($i=0;$i<count($result['carmodels']);$i++)
        {
            $result['carmodels'][$i]['carmakertitle']=$carmakEnt->Select($result['carmodels'][$i]['carmaker_fid'],null,null,null,array(),array(),"0,1")[0]['title'];
        }
        $result['componentgroups']=$CompGroupEnt->Select(null,null,null,null,null,array('title'),array(false),"0,1000");
        $DBAccessor->close_connection();
        return $result;
	}
	public function BtnSearch($PageNumber,$txtTitle,$cmbGroup,$txtPriceLB,$txtPriceUB,$cmbCountry,$cmbStatus,$cmbCarModel,$cmbSortBY,$cmbSortBYOrder,$cmbProvince)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		if($txtPriceLB=="")
		    $txtPriceLB=null;
        if($txtPriceUB=="")
            $txtPriceUB=null;
        if($cmbGroup==-1)
            $cmbGroup=null;
        if($cmbCountry==-1)
            $cmbCountry=null;
        if($cmbStatus==-1)
            $cmbStatus=null;
        if($cmbCarModel==-1)
            $cmbCarModel=null;
		$DBAccessor=new dbaccess();
		$result=array();
        $orderFiled="id";
        switch($cmbSortBY)
        {
            case 1:
                $orderFiled=new DBField("co.title",false);
                break;
            case 2:
                $orderFiled="price";
                break;
            case 3:
                $orderFiled="componentgroup_fid";
                break;
            case 4:
                $orderFiled="carmodel_fid";
                break;
            case 5:
                $orderFiled="country_fid";
                break;
        }
        $IsDesc=false;
        if($cmbSortBYOrder==1)
            $IsDesc=true;
        $Compent=new buysell_componentEntity($DBAccessor);
        $photEnt=new buysell_componentphotoEntity($DBAccessor);
        $countEnt=new common_countryEntity($DBAccessor);
        $allComps=$Compent->FullSelect(null,"%$txtTitle%",$txtPriceLB,$txtPriceUB,$cmbStatus,null,$cmbCountry,$cmbGroup,null,null,null,$cmbCarModel,$cmbProvince,array($orderFiled),array($IsDesc),"0,1000000");
        $allcount=count($allComps);
        $result['pagecount']=$allcount/$this->PAGESIZE;
        if($allcount%$this->PAGESIZE!=0)
            $result['pagecount']++;
        $result['components']=$Compent->FullSelect(null,"%$txtTitle%",$txtPriceLB,$txtPriceUB,$cmbStatus,null,$cmbCountry,$cmbGroup,null,null,null,$cmbCarModel,$cmbProvince,array($orderFiled),array($IsDesc),$this->getLimit($PageNumber));

        for ($i=0;$i<count($result['components']);$i++)
        {
            $result['components'][$i]['photos']=$photEnt->Select(null,$result['components'][$i]['id'],null,null,array('priority'),array(false),"0,1");
        }
        for ($i=0;$i<count($result['components']);$i++)
        {
            $result['components'][$i]['country']=$countEnt->Select($result['components'][$i]['country_fid'],null,null,array('id'),array(false),"0,1")[0];
        }
        $DBAccessor->close_connection();
		return $result;
	}
    private function getLimit($PageNumber)
    {
        $Limit=($PageNumber-1)*$this->PAGESIZE . "," . $PageNumber*$this->PAGESIZE;
        return $Limit;
    }
}
?>