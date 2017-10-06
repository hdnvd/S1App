<?php
namespace Modules\oras\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\oras\Controllers\manageemployeerecruitmenttypesController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-10 - 2017-10-02 23:05
*@lastUpdate 1396-07-10 - 2017-10-02 23:05
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageemployeerecruitmenttypes_Code extends employeerecruitmenttypelist_Code {
	public function load()
	{
		return $this->getLoadDesign()->getBodyHTML();
	}
	public function getLoadDesign()
	{
		try{
		$manageemployeerecruitmenttypesController=new manageemployeerecruitmenttypesController();
		$manageemployeerecruitmenttypesController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("oras");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
			$design=new manageemployeerecruitmenttypes_Design();
			$design->setAdminMode($this->getAdminMode());
			if(isset($_GET['delete'])){
				$Result=$manageemployeerecruitmenttypesController->DeleteItem($this->getID());
			}elseif(isset($_GET['action']) && $_GET['action']=="search_Click"){
				$this->setSearchForm($design);
				return $this->search_Click();
			}else{
				$Result=$manageemployeerecruitmenttypesController->load($this->getHttpGETparameter('pn',-1));
				if(isset($_GET['search']))
					$design=new employeerecruitmenttypelistsearch_Design();
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
		$this->setTitle("Manage Employeerecruitmenttypes");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
}
?>