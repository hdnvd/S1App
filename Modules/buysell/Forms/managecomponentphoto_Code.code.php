<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\Exception\FileSizeError;
use core\CoreClasses\Exception\FileTypeError;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use Modules\buysell\Exceptions\ProductNotFoundException;
use Modules\buysell\Exceptions\ProductPhotoNotFoundException;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Controllers\managecomponentphotoController;
use Modules\files\PublicClasses\uploadHelper;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-27 - 2017-02-15 13:42
*@lastUpdate 1395-11-27 - 2017-02-15 13:42
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponentphoto_Code extends FormCode {
    private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
    public function __construct($namespace=null)
    {
        parent::__construct($namespace);
        $this->setThemePage("admin.php");
        $this->setTitle("مدیریت تصاویر قطعه");
        $this->setAdminMode(true);
    }
	public function load()
	{
		$managecomponentphotoController=new managecomponentphotoController();
		$managecomponentphotoController->setAdminMode($this->adminMode);
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		if($this->getID()>=0)
        {
            try
            {
                if(isset($_GET['delete']))
                    $managecomponentphotoController->DeletePhoto($this->getID(),$_GET['photoid']);
                $Result=$managecomponentphotoController->load($this->getID());
                $Result['id']=$this->getID();
                $design=new managecomponentphoto_Design();
                $design->setAdminMode($this->adminMode);
                $design->setData($Result);
                $design->setMessage("");
                return $design->getBodyHTML();
            }
            catch (ProductNotFoundException $ex)
            {
                return "قطعه مورد نظر پیدا نشد";
            }
            catch (ProductPhotoNotFoundException $ex)
            {
                return "تصویر مورد نظر پیدا نشد";
            }

        }
        else
            return "قطعه مورد نظر وجود ندارد";
	}
	public function getID()
	{
		$id=-1;
		if(isset($_GET['id']))
			$id=$_GET['id'];
		return $id;
	}
	public function btnAddNew_Click()
	{
		$managecomponentphotoController=new managecomponentphotoController();
        $managecomponentphotoController->setAdminMode($this->adminMode);
		$translator=new ModuleTranslator("buysell");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new managecomponentphoto_Design();
        $design->setAdminMode($this->adminMode);
		$flPhotoPaths=$design->getFlPhoto()->getSelectedFilesTempPath();
		$flPhotoNames=$design->getFlPhoto()->getSelectedFilesName();
        $flPhotoTypes=$design->getFlPhoto()->getSelectedFilesType();
		$flPhotoURLs=array();
		try
        {
            for($fileIndex=0;$fileIndex<count($flPhotoPaths);$fileIndex++){
                $flPhotoURLs[$fileIndex]=uploadHelper::UploadFile($flPhotoPaths[$fileIndex], $flPhotoNames[$fileIndex], "content/files/buysell/managecomponent/",array("image/jpeg"),1536,false,$flPhotoTypes[$fileIndex]);
            }
            $Result=$managecomponentphotoController->BtnAddNew($this->getID(),$flPhotoURLs);
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
            $design->setMessage("قطعه مورد نظر وجود ندارد");
        }


		return $design->getBodyHTML();
	}
}
?>