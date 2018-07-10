<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\buysell\Controllers\selectgroupController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-07 - 2017-08-29 16:28
*@lastUpdate 1396-06-07 - 2017-08-29 16:28
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class selectgroup_Code extends FormCode {
	public function load()
	{
		$selectgroupController=new selectgroupController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$Result['page']=$this->getHttpGETparameter("pagename","carlist");
		$design=new selectgroup_Design();
		$design->setData($Result);
		$design->setMessage("");
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
	public function getID()
	{
		$id=-1;
		if(isset($_GET['id']))
			$id=$_GET['id'];
		return $id;
	}
}
?>