<?php
namespace Modules\shift\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\shift\Controllers\importshiftdataController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
use Modules\shift\Exceptions\MultipleBakhshException;
use Modules\shift\Exceptions\ShiftExistsException;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-27 - 2018-01-17 16:12
*@lastUpdate 1396-10-27 - 2018-01-17 16:12
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class importshiftdata_Code extends FormCode {
	public function load()
	{
		$importshiftdataController=new importshiftdataController();
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$Result=$importshiftdataController->load($this->getID());
		$design=new importshiftdata_Design();
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
		return $design->getBodyHTML();
	}
	public function getID()
	{
		$id=-1;
		if(isset($_GET['id']))
			$id=$_GET['id'];
		return $id;
	}
	public function btnsave_Click()
	{

		$importshiftdataController=new importshiftdataController();
		$translator=new ModuleTranslator("shift");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new importshiftdata_Design();
		$datatypeid=$design->getDataType()->getSelectedID();
		$inputfilePaths=$design->getInputfile()->getSelectedFilesTempPath();
		$inputfileNames=$design->getInputfile()->getSelectedFilesName();
		$inputfileURLs=array();
		for($fileIndex=0;$fileIndex<count($inputfilePaths);$fileIndex++){
			$inputfileURLs[$fileIndex]=uploadHelper::UploadFile($inputfilePaths[$fileIndex], $inputfileNames[$fileIndex], "content/files/shift/importshiftdata/");
		}
        try {
            $Result = $importshiftdataController->Btnsave($this->getID(), $inputfileURLs, $datatypeid);
            $design->setData($Result);
            $design->setMessage("اطلاعات با موفقیت وارد سیستم شدند!"."\n"."تعداد خانه های اضافه شده:".$Result['shiftsadded']);
        }
        catch(DataNotFoundException $dnfex){
                $design=new message_Design();
                $design->setMessageType(MessageType::$ERROR);
                $design->setMessage("اطلاعات یک یا چند نفر از کارکنان از پایگاه داده پیدا نشد،لطفا این افراد را از طریق بخش تعریف کارکنان به سیستم اظافه نموده و دوباره تلاش کنید"."\n".$dnfex->getMessage());
            }
		catch(ShiftExistsException $shex){
                $design=new message_Design();
                $design->setMessageType(MessageType::$ERROR);
                $design->setMessage("برخی از روزهای موجود در این فایل از قبل در پایگاه داده برای این بخش موجود است،لطفا اطلاعات را بررسی نمایید."."\n".$shex->getMessage());
            }
        catch(MultipleBakhshException $mbex){
            $design=new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("تمام افراد وارد شده باید در یک بخش باشند."."\n".$mbex->getMessage());
        }
        catch(\Exception $uex){
            $design=new message_Design();
            $design->setMessageType(MessageType::$ERROR);
            $design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
        }
		return $design->getBodyHTML();
	}
}
?>