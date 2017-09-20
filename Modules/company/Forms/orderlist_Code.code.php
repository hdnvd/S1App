<?php
namespace Modules\company\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\company\Controllers\orderlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-28 - 2017-09-19 16:32
*@lastUpdate 1396-06-28 - 2017-09-19 16:32
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class orderlist_Code extends FormCode {
	public function load()
	{
		$orderlistController=new orderlistController();
		$translator=new ModuleTranslator("company");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$orderlistController->load($this->getHttpGETparameter('pn',-1));
				$design=new orderlist_Design();
			if(isset($_GET['search']))
					$design=new orderlistsearch_Design();
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
		$orderlistController=new orderlistController();
		$translator=new ModuleTranslator("company");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new orderlist_Design();
		$descriptions=$_GET['descriptions'];
		$similarproducts=$_GET['similarproducts'];
		$email=$_GET['email'];
		$orderdate=$_GET['orderdate'];
		$mobile=$_GET['mobile'];
		$name=$_GET['name'];
		$family=$_GET['family'];
		$paydate=$_GET['paydate'];
		$package_fid_ID=$_GET['package_fid'];
		$finance_transaction_fid_ID=$_GET['finance_transaction_fid'];
		$prepayment_finance_transaction_fid_ID=$_GET['prepayment_finance_transaction_fid'];
		$sortby_ID=$_GET['sortby'];
		$isdesc_ID=$_GET['isdesc'];
		$Result=$orderlistController->Search($this->getHttpGETparameter('pn',-1),$descriptions,$similarproducts,$email,$orderdate,$mobile,$name,$family,$paydate,$package_fid_ID,$finance_transaction_fid_ID,$prepayment_finance_transaction_fid_ID,$sortby_ID,$isdesc_ID);
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