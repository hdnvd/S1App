<?php
namespace Modules\fileshop\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\finance\Exceptions\LowBalanceException;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\fileshop\Controllers\filelistController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-09 - 2017-11-30 16:33
*@lastUpdate 1396-09-09 - 2017-11-30 16:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class filelist_Code extends FormCode {
	private $searchForm='filelist';
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
		$filelistController=new filelistController();
		$translator=new ModuleTranslator("fileshop");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$design=new filelist_Design();
			$this->setSearchForm($design);
			if(isset($_GET['action']) && $_GET['action']=="search_Click"){
				return $this->search_Click();
			}
            elseif(isset($_GET['service']) && $_GET['service']=="buy")
            {
                $design=new message_Design();
                $design->setMessageType(MessageType::$SUCCESS);
                $Result=$filelistController->buy($this->getHttpGETparameter('fileid',-1),$this->getHttpGETparameter('username',-1),$this->getHttpGETparameter('password',-1));
//                $design->setService($_GET['service']);
//                $design->setData($Result);
                $design->setMessage("فایل با موفقیت خریداری شد.");
            }
			else
			{
				$Cat=$this->getHttpGETparameter('catid',-1);
				if($Cat>0)
                    $Result=$filelistController->loadCategoryFiles($Cat);
				else
                    $Result=$filelistController->load($this->getHttpGETparameter('pn',-1));

			if(isset($_GET['search']))
					$design=new filelistsearch_Design();
				$design->setData($Result);
				$design->setMessage("");
			}
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
        catch (LowBalanceException $Lbex)
        {
            $design=new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("موجودی کافی نیست");
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
		$this->setTitle("File List");
	}
	public function search_Click()
	{
		$filelistController=new filelistController();
		$translator=new ModuleTranslator("fileshop");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=$this->searchForm;
		$design->setAdminMode($this->getAdminMode());
		$filelistController->setAdminMode($this->getAdminMode());
		$Categorys=$design->getCategorys()->getSelectedValues();
		$title=$this->getHttpGETparameter('title','');
		$add_date_from=DatePicker::getTimeFromText($this->getHttpGETparameter('add_date_from',''));
		$add_date_to=DatePicker::getTimeFromText($this->getHttpGETparameter('add_date_to',''));
		$description=$this->getHttpGETparameter('description','');
		$price=$this->getHttpGETparameter('price','');
		$filecount=$this->getHttpGETparameter('filecount','');
		$sortby_ID=$this->getHttpGETparameter('sortby','');
		$isdesc_ID=$this->getHttpGETparameter('isdesc','');
		$Result=$filelistController->Search($this->getHttpGETparameter('pn',-1),$title,$add_date_from,$add_date_to,$description,$price,$filecount,$sortby_ID,$isdesc_ID,$Categorys);
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