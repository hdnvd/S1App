<?php
namespace Modules\kpex\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\kpex\Controllers\testlistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-06-19 - 2018-09-10 10:26
*@lastUpdate 1397-06-19 - 2018-09-10 10:26
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class testlist_Code extends FormCode {
	private $searchForm='testlist';
	protected function setSearchForm($searchForm){
		$this->searchForm=$searchForm;
	}    
	private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
    public function getAdminMode()
    {
        return $this->adminMode;
    }
	public function load()
	{
		return $this->getLoadDesign()->getResponse();
	}
	public function getLoadDesign()
	{
		$testlistController=new testlistController();
		$translator=new ModuleTranslator("kpex");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new testlist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
			else
			{
				$Result=$testlistController->load($this->getHttpGETparameter('pn',-1));
			if(isset($_GET['search']))
					$design=new testlistsearch_Design();
				$design->setData($Result);
				$design->setMessage("");
			}
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
		$this->setTitle("Test List");
	}
	public function search_Click()
	{
		$testlistController=new testlistController();
		$translator=new ModuleTranslator("kpex");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$testlistController->setAdminMode($this->getAdminMode());
		$nouninfluence=$this->getHttpGETparameter('nouninfluence','');
		$nounoutinfluence=$this->getHttpGETparameter('nounoutinfluence','');
		$adjectiveinfluence=$this->getHttpGETparameter('adjectiveinfluence','');
		$adjectiveoutinfluence=$this->getHttpGETparameter('adjectiveoutinfluence','');
		$similarity_threshold=$this->getHttpGETparameter('similarity_threshold','');
		$similarity_influence=$this->getHttpGETparameter('similarity_influence','');
		$resultcount=$this->getHttpGETparameter('resultcount','');
		$context_fid_ID=$this->getHttpGETparameter('context_fid','');
		$description=$this->getHttpGETparameter('description','');
		$words=$this->getHttpGETparameter('words','');
		$is_postaged_ID=$this->getHttpGETparameter('is_postaged','');
		$is_similarityedgeweighed_ID=$this->getHttpGETparameter('is_similarityedgeweighed','');
		$method_fid_ID=$this->getHttpGETparameter('method_fid','');
		$testgroup_fid_ID=$this->getHttpGETparameter('testgroup_fid','');
		$apprate=$this->getHttpGETparameter('apprate','');
		$precisionrate=$this->getHttpGETparameter('precisionrate','');
		$recall=$this->getHttpGETparameter('recall','');
		$fscore=$this->getHttpGETparameter('fscore','');
		$idfrom=$this->getHttpGETparameter('idfrom','');
		$idto=$this->getHttpGETparameter('idto','');
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$testlistController->Search($this->getHttpGETparameter('pn',-1),$nouninfluence,$nounoutinfluence,$adjectiveinfluence,$adjectiveoutinfluence,$similarity_threshold,$similarity_influence,$resultcount,$context_fid_ID,$description,$words,$is_postaged_ID,$is_similarityedgeweighed_ID,$method_fid_ID,$apprate,$precisionrate,$recall,$fscore,$idfrom,$idto,$testgroup_fid_ID,$sortby_ID,$isdesc_ID);
		$design->setData($Result);
		if($Result['data']==null || count($Result['data'])==0){
			$design->setMessage("متاسفانه هیچ نتیجه ای برای این جستجو پیدا نشد.");
			$design->setMessageType(MessageType::$ERROR);
		}else{
			$design->setMessage("نتایج جستجو : ");
			$design->setMessageType(MessageType::$INFORMATION);
		}
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
}
?>