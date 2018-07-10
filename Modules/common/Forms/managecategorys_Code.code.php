<?php
namespace Modules\common\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\common\Controllers\managecategorysController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-12 - 2017-12-03 02:52
*@lastUpdate 1396-09-12 - 2017-12-03 02:52
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managecategorys_Code extends categorylist_Code {
	public function load()
	{
		return $this->getLoadDesign()->getResponse();
	}
	public function getLoadDesign()
	{
		try{
		$managecategorysController=new managecategorysController();
		$managecategorysController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("common");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
			$design=new managecategorys_Design();
			$design->setAdminMode($this->getAdminMode());
			if(isset($_GET['delete'])){
				$Result=$managecategorysController->DeleteItem($this->getID());
			}elseif(isset($_GET['action']) && $_GET['action']=="search_Click"){
				$this->setSearchForm($design);
				return $this->search_Click();
			}else{
				$Result=$managecategorysController->load($this->getHttpGETparameter('pn',-1));
				if(isset($_GET['search']))
					$design=new categorylistsearch_Design();
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
		$this->setTitle("Manage Categorys");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
}
?>