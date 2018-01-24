<?php
namespace Modules\finance\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\finance\Controllers\transactionlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-15 - 2017-09-06 14:09
*@lastUpdate 1396-06-15 - 2017-09-06 14:09
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class transactionlist_Code extends FormCode {
	public function load()
	{
		$transactionlistController=new transactionlistController();
		$translator=new ModuleTranslator("finance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
            elseif(isset($_GET['service']) && $_GET['service']=="getbalance"){

                $Result=$transactionlistController->getUserBalance($this->getHttpGETparameter('username',-1),$this->getHttpGETparameter('password',-1));
                $design=new transactionlist_Design();
                $design->setData($Result);
                $design->setMessage("");

			}
			else
			{
				$Result=$transactionlistController->load($this->getHttpGETparameter('pn',-1));
				$design=new transactionlist_Design();
			if(isset($_GET['search']))
					$design=new transactionlistsearch_Design();
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
		return $design->getResponse();
	}
	public function search_Click()
	{
		$transactionlistController=new transactionlistController();
		$translator=new ModuleTranslator("finance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new transactionlist_Design();
		$amount=$_GET['amount'];
		$description=$_GET['description'];
		$add_time=$_GET['add_time'];
		$commit_time=$_GET['commit_time'];
		$issuccessful=$_GET['issuccessful'];
		$chapter_fid_ID=$_GET['chapter_fid'];
		$sortby_ID=$_GET['sortby'];
		$isdesc_ID=$_GET['isdesc'];
		$Result=$transactionlistController->Search($this->getHttpGETparameter('pn',-1),$amount,$description,$add_time,$commit_time,$issuccessful,$chapter_fid_ID,$sortby_ID,$isdesc_ID);
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