<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\buysell\Controllers\manageuserController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-16 - 2017-09-07 01:34
*@lastUpdate 1396-06-16 - 2017-09-07 01:34
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manageuser_Code extends FormCode {
	public function load()
	{
		$manageuserController=new manageuserController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$manageuserController->load($this->getID());
			$design=new manageuser_Design();
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
		$manageuserController=new manageuserController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new manageuser_Design();
		$name=$design->getName()->getValue();
		$email=$design->getEmail()->getValue();
		$tel=$design->getTel()->getValue();
		$mob=$design->getMob()->getValue();
		$postalcode=$design->getPostalcode()->getValue();
		$ismale=$design->getIsmale()->getSelectedID();
		$common_city_fid_ID=$design->getCommon_city_fid()->getSelectedID();
		$birthday=$design->getBirthday()->getValue();
		$ispayed=$design->getIspayed()->getSelectedValues();
		$signupdate=$design->getSignupdate()->getValue();
		$photo=$design->getPhoto()->getValue();
		$is_info_visible=$design->getIs_info_visible()->getSelectedValues();
		$carmodel_fid_ID=$design->getCarmodel_fid()->getSelectedID();
		$Result=$manageuserController->BtnSave($this->getID(),$name,$email,$tel,$mob,$postalcode,$ismale,$common_city_fid_ID,$birthday,$ispayed,$signupdate,$photo,$is_info_visible,$carmodel_fid_ID);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد!");
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