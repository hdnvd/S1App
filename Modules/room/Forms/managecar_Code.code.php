<?php
namespace Modules\room\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\room\Controllers\managecarController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-05-25 - 2017-08-16 01:15
*@lastUpdate 1396-05-25 - 2017-08-16 01:15
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managecar_Code extends FormCode {
	public function load()
	{
		$managecarController=new managecarController();
		$translator=new ModuleTranslator("room");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$managecarController->load($this->getID());
			$design=new managecar_Design();
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
	public function btnSave_Click()
	{
		$managecarController=new managecarController();
		$translator=new ModuleTranslator("room");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new managecar_Design();
		$details=$design->getDetails()->getValue();
		$price=$design->getPrice()->getValue();
		$adddate=$design->getAdddate()->getValue();
		$body_carcolor_fid_ID=$design->getBody_carcolor_fid()->getSelectedID();
		$inner_carcolor_fid_ID=$design->getInner_carcolor_fid()->getSelectedID();
		$paytype_fid_ID=$design->getPaytype_fid()->getSelectedID();
		$cartype_fid_ID=$design->getCartype_fid()->getSelectedID();
		$usagecount=$design->getUsagecount()->getValue();
		$wheretodate=$design->getWheretodate()->getValue();
		$carbodystatus_fid_ID=$design->getCarbodystatus_fid()->getSelectedID();
		$makedate=$design->getMakedate()->getValue();
		$carstatus_fid_ID=$design->getCarstatus_fid()->getSelectedID();
		$shasitype_fid_ID=$design->getShasitype_fid()->getSelectedID();
		$isautogearbox=$design->getIsautogearbox()->getSelectedValues();
		$carmodel_fid_ID=$design->getCarmodel_fid()->getSelectedID();
		$cartagtype_fid_ID=$design->getCartagtype_fid()->getSelectedID();
		$carentitytype_fid_ID=$design->getCarentitytype_fid()->getSelectedID();
		$Result=$managecarController->BtnSave($this->getID(),$details,$price,$adddate,$body_carcolor_fid_ID,$inner_carcolor_fid_ID,$paytype_fid_ID,$cartype_fid_ID,$usagecount,$wheretodate,$carbodystatus_fid_ID,$makedate,$carstatus_fid_ID,$shasitype_fid_ID,$isautogearbox,$carmodel_fid_ID,$cartagtype_fid_ID,$carentitytype_fid_ID);
		$design->setData($Result);
		$design->setMessage("btnSave is done!");
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