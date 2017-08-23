<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\Exception\FileSizeError;
use core\CoreClasses\Exception\FileTypeError;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use Modules\buysell\Controllers\managecarphotoController;
use Modules\buysell\Exceptions\ProductNotFoundException;
use Modules\buysell\Exceptions\ProductPhotoNotFoundException;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\files\PublicClasses\uploadHelper;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-27 - 2017-02-15 13:42
*@lastUpdate 1395-11-27 - 2017-02-15 13:42
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecarphoto_Code extends FormCode {
	public function load()
	{
		$managecarphotoController=new managecarphotoController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		if($this->getID()>=0)
        {
            try
            {
                if(isset($_GET['delete']))
                    $managecarphotoController->DeletePhoto($this->getID(),$_GET['photoid']);
                $Result=$managecarphotoController->load($this->getID());
                $Result['id']=$this->getID();
                $design=new managecarphoto_Design();
                $design->setData($Result);
                $design->setMessage("");
                $design->setGroupID($this->getHttpGETparameter('groupid',1));
                return $design->getBodyHTML();
            }
            catch (ProductNotFoundException $ex)
            {
                return "اتومبیل مورد نظر پیدا نشد";
            }
            catch (ProductPhotoNotFoundException $ex)
            {
                return "تصویر مورد نظر پیدا نشد";
            }

        }
        else
            return "اتومبیل مورد نظر وجود ندارد";
	}
	public function getID()
	{
		return $this->getHttpGETparameter("id",-1);
	}
	public function btnAddNew_Click()
	{
		$managecarphotoController=new managecarphotoController();
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new managecarphoto_Design();
		$flPhotoPaths=$design->getFlPhoto()->getSelectedFilesTempPath();
		$flPhotoNames=$design->getFlPhoto()->getSelectedFilesName();
        $flPhotoTypes=$design->getFlPhoto()->getSelectedFilesType();
		$flPhotoURLs=array();
		try
        {
            for($fileIndex=0;$fileIndex<count($flPhotoPaths);$fileIndex++){
                $flPhotoURLs[$fileIndex]=uploadHelper::UploadFile($flPhotoPaths[$fileIndex], $flPhotoNames[$fileIndex], "content/files/buysell/managecar/",array("image/jpeg"),1536,false,$flPhotoTypes[$fileIndex]);
            }
            $Result=$managecarphotoController->BtnAddNew($this->getID(),$flPhotoURLs,$flPhotoURLs);
            $Result['id']=$this->getID();
            $design->setData($Result);
            $design->setMessageType(MessageType::$SUCCESS);
            $design->setMessage("تصویر با موفقیت اضافه شد");
        }
        catch (FileTypeError $fe)
        {
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("فرمت عکس ورودی باید jpg باشد");
        }
        catch (FileSizeError $se)
        {
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("حجم عکس باید کمتر از 1.5 مگابایت باشد");
        }
        catch (ProductNotFoundException $ex)
        {
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("اتومبیل مورد نظر وجود ندارد");
        }
        catch (\Exception $ex)
        {
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("متاسفانه خطایی در اجرای دستور مورد نظر بوجود آمد");
        }

        $design->setGroupID($this->getHttpGETparameter('groupid',1));

		return $design->getBodyHTML();
	}
}
?>