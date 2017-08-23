<?php
namespace Modules\room\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\room\Controllers\carlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-05-25 - 2017-08-16 01:15
*@lastUpdate 1396-05-25 - 2017-08-16 01:15
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class carlist_Code extends FormCode {
	public function load()
	{
		$carlistController=new carlistController();
		$translator=new ModuleTranslator("room");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$carlistController->load($this->getHttpGETparameter('pn',-1));
				$design=new carlist_Design();
			if(isset($_GET['search']))
					$design=new carlistsearch_Design();
				$design->setData($Result);
				$design->setMessage("");
			}
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
		catch(\Exception $uex){
			$design=new message_Design();
			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
		}
		return $design->getBodyHTML();
	}
	public function search_Click()
	{
		$carlistController=new carlistController();
		$translator=new ModuleTranslator("room");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new carlist_Design();
		$details=$_GET['details'];
		$price=$_GET['price'];
		$adddate=$_GET['adddate'];
		$body_carcolor_fid_ID=$_GET['body_carcolor_fid'];
		$inner_carcolor_fid_ID=$_GET['inner_carcolor_fid'];
		$paytype_fid_ID=$_GET['paytype_fid'];
		$cartype_fid_ID=$_GET['cartype_fid'];
		$usagecount=$_GET['usagecount'];
		$wheretodate=$_GET['wheretodate'];
		$carbodystatus_fid_ID=$_GET['carbodystatus_fid'];
		$makedate=$_GET['makedate'];
		$carstatus_fid_ID=$_GET['carstatus_fid'];
		$shasitype_fid_ID=$_GET['shasitype_fid'];
		$isautogearbox=$_GET['isautogearbox'];
		$carmodel_fid_ID=$_GET['carmodel_fid'];
		$cartagtype_fid_ID=$_GET['cartagtype_fid'];
		$carentitytype_fid_ID=$_GET['carentitytype_fid'];
		$sortby_ID=$_GET['sortby'];
		$isdesc_ID=$_GET['isdesc'];
		$Result=$carlistController->Search($this->getHttpGETparameter('pn',-1),$details,$price,$adddate,$body_carcolor_fid_ID,$inner_carcolor_fid_ID,$paytype_fid_ID,$cartype_fid_ID,$usagecount,$wheretodate,$carbodystatus_fid_ID,$makedate,$carstatus_fid_ID,$shasitype_fid_ID,$isautogearbox,$carmodel_fid_ID,$cartagtype_fid_ID,$carentitytype_fid_ID,$sortby_ID,$isdesc_ID);
		$design->setData($Result);
		$design->setMessage("search is done!");
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
		catch(\Exception $uex){
			$design=new message_Design();
			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
		}
		return $design->getBodyHTML();
	}
}
?>