<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\searchController;
use Modules\files\PublicClasses\uploadHelper;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-02-19 - 2017-05-09 17:42
*@lastUpdate 1396-02-19 - 2017-05-09 17:42
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class search_Code extends FormCode {
	public function load()
	{
	    if(isset($_GET['action']) && $_GET['action']=="btnSearch_Click")
        {
            return $this->btnSearch_Click();
        }
        else
        {
            $searchController=new searchController();
            $translator=new ModuleTranslator("buysell");
            $translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
            $Result=$searchController->load($this->getID(),$this->getHttpGETparameter('groupid',1));
            $design=new search_Design();
            $design->setData($Result);
            $design->setMessage("");
            return $design->getBodyHTML();
        }
	}
	public function getID()
	{
		$id=-1;
		if(isset($_GET['id']))
			$id=$_GET['id'];
		return $id;
	}
	public function btnSearch_Click()
	{
		$searchController=new searchController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new search_Design();
		$txtTitle=$_GET['txtTitle'];
		$cmbGroup_ID=$_GET['cmbGroup'];
		$txtPriceLB=$_GET['txtPriceLB'];
		$txtPriceUB=$_GET['txtPriceUB'];
		$cmbCountry_ID=$_GET['cmbCountry'];
		$cmbStatus_ID=$_GET['cmbStatus'];
		$cmbCarModel_ID=$_GET['carmodel_fid'];
        $cmbProvince_ID=$_GET['cmbProvince'];
        $cmbSortBY_ID=$_GET['cmbSortBY'];
        $cmbSortBYOrder_ID=$_GET['cmbSortBYOrder'];
        $groupID=$this->getHttpGETparameter('groupid',1);
		$Result=$searchController->BtnSearch(1,$txtTitle,$cmbGroup_ID,$txtPriceLB,$txtPriceUB,$cmbCountry_ID,$cmbStatus_ID,$cmbCarModel_ID,$cmbSortBY_ID,$cmbSortBYOrder_ID,$cmbProvince_ID,$groupID);

        $design2=new complist_Design();
		$design2->setData($Result);
		return $design2->getBodyHTML();
	}
}
?>