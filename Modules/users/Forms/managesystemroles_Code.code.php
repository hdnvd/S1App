<?php
namespace Modules\users\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\users\Controllers\managesystemrolesController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-19 - 2018-02-08 15:47
*@lastUpdate 1396-11-19 - 2018-02-08 15:47
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managesystemroles_Code extends systemrolelist_Code {
	public function load()
	{
		return $this->getLoadDesign()->getResponse();
	}
	public function getLoadDesign()
	{
		try{
		$managesystemrolesController=new managesystemrolesController();
		$managesystemrolesController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
			$design=new managesystemroles_Design();
			$design->setAdminMode($this->getAdminMode());
			if(isset($_GET['delete'])){
				$Result=$managesystemrolesController->DeleteItem($this->getID());
			}elseif(isset($_GET['action']) && $_GET['action']=="search_Click"){
				$this->setSearchForm($design);
				return $this->search_Click();
			}else{
				$Result=$managesystemrolesController->load($this->getHttpGETparameter('pn',-1));
				if(isset($_GET['search']))
					$design=new systemrolelistsearch_Design();
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
		$this->setTitle("Manage Systemroles");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
}
?>