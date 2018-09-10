<?php
namespace Modules\kpex\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\kpex\Controllers\managetestsController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-03-24 - 2018-06-14 03:29
*@lastUpdate 1397-03-24 - 2018-06-14 03:29
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managetests_Code extends testlist_Code {
	public function load()
	{
		return $this->getLoadDesign()->getResponse();
	}
	public function getLoadDesign()
	{
		try{
		$managetestsController=new managetestsController();
		$managetestsController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("kpex");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
			$design=new managetests_Design();
			$design->setAdminMode($this->getAdminMode());
			if(isset($_GET['delete'])){
				$Result=$managetestsController->DeleteItem($this->getID());
			}
            elseif(isset($_GET['run'])){
                $Result=$managetestsController->Run($this->getID(),$this->getHttpGETparameter('pn',-1));
            }
			elseif(isset($_GET['action']) && $_GET['action']=="search_Click"){
				$this->setSearchForm($design);
				return $this->search_Click();

			}elseif(isset($_GET['hulth'])){

                $Result=$managetestsController->makeHulthCSV($this->getHttpGETparameter('pn',-1));
            }
			else{
				$Result=$managetestsController->load($this->getHttpGETparameter('pn',-1));
				if(isset($_GET['search']))
					$design=new testlistsearch_Design();

			}
			$design->setData($Result);
			$design->setMessage("");
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
//		catch(\Exception $uex){
//			$design=new message_Design();
//			$design->setMessageType(MessageType::$ERROR);
//			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
//		}
		return $design;
	}
	public function __construct($namespace)
	{
		parent::__construct($namespace);
		$this->setTitle("Manage Tests");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
}
?>