<?php
namespace Modules\oras\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\oras\Controllers\managerecordsController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 03:03
*@lastUpdate 1396-07-12 - 2017-10-04 03:03
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managerecords_Code extends recordlist_Code {
	public function load()
	{
		return $this->getLoadDesign()->getBodyHTML();
	}
	public function getLoadDesign()
	{
		try{
		$managerecordsController=new managerecordsController();
		$managerecordsController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("oras");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
			$design=new managerecords_Design();
			$design->setAdminMode($this->getAdminMode());
			if(isset($_GET['delete'])){
				$Result=$managerecordsController->DeleteItem($this->getID());
			}elseif(isset($_GET['action']) && $_GET['action']=="search_Click"){
				$this->setSearchForm($design);
				return $this->search_Click();
			}else{
				$Result=$managerecordsController->load($this->getHttpGETparameter('pn',-1),$this->getHttpGETparameter('employeeid',-1),$this->getHttpGETparameter('placeid',-1));
				if(isset($_GET['search']))
					$design=new recordlistsearch_Design();
			}
			$design->setData($Result);
			$design->setMessage("");
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
		catch(\Exception $uex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
		}
		return $design;
	}
	public function __construct($namespace)
	{
		parent::__construct($namespace);
		$this->setTitle("Manage Records");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
}
?>