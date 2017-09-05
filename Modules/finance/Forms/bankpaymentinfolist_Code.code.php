<?php
namespace Modules\finance\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\finance\Controllers\bankpaymentinfolistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-13 - 2017-09-04 18:38
*@lastUpdate 1396-06-13 - 2017-09-04 18:38
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class bankpaymentinfolist_Code extends FormCode {
	public function load()
	{
		$bankpaymentinfolistController=new bankpaymentinfolistController();
		$translator=new ModuleTranslator("finance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$bankpaymentinfolistController->load($this->getHttpGETparameter('pn',-1));
				$design=new bankpaymentinfolist_Design();
			if(isset($_GET['search']))
					$design=new bankpaymentinfolistsearch_Design();
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
		$bankpaymentinfolistController=new bankpaymentinfolistController();
		$translator=new ModuleTranslator("finance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new bankpaymentinfolist_Design();
		$amount=$_GET['amount'];
		$payedamount=$_GET['payedamount'];
		$cardnumber=$_GET['cardnumber'];
		$factorserial=$_GET['factorserial'];
		$transaction_fid_ID=$_GET['transaction_fid'];
		$status_fid_ID=$_GET['status_fid'];
		$start_time=$_GET['start_time'];
		$commit_time=$_GET['commit_time'];
		$portal_fid_ID=$_GET['portal_fid'];
		$name=$_GET['name'];
		$family=$_GET['family'];
		$systemuser_fid_ID=$_GET['systemuser_fid'];
		$phonenumber=$_GET['phonenumber'];
		$sortby_ID=$_GET['sortby'];
		$isdesc_ID=$_GET['isdesc'];
		$Result=$bankpaymentinfolistController->Search($this->getHttpGETparameter('pn',-1),$amount,$payedamount,$cardnumber,$factorserial,$transaction_fid_ID,$status_fid_ID,$start_time,$commit_time,$portal_fid_ID,$name,$family,$systemuser_fid_ID,$phonenumber,$sortby_ID,$isdesc_ID);
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