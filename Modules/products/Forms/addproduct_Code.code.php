<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormCode;
use Modules\products\Controllers\ProductManageController;
use Modules\products\BusinessObjects\productBO;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\File\Uploader;
use Modules\pages\Controllers\languageManageController;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\parameters\PublicClasses\ParameterManager;
use Modules\files\PublicClasses\uploadHelper;
use core\CoreClasses\File\JpegImage;
use core\CoreClasses\Exception\FileTypeError;
use core\CoreClasses\File\PngImage;
use core\CoreClasses\File\GifImage;
use Modules\common\PublicClasses\AppRooter;

/**
 *
 * @author Hadi Nahavandi
 * @version 0.1
 *        
 */
class addproduct_Code extends FormCode 
{
	private $ImagesPath,$ThumbsPath;
	public function __construct($NameSpace=null)
	{
		$this->ImagesPath="content/files/products/img/";
		$this->ThumbsPath="content/files/products/img/thumbnails/";
		parent::__construct($NameSpace);
		$this->setThemePage("admin.php");

		$this->setTitle("مدیریت محصول");
	}
	private function getDesign()
	{
		$languageID=CurrentLanguageManager::getCurrentLanguageID();
		$design=new addproduct_Design();
		$productManageController=new ProductManageController();
		$groups=$productManageController->loadLangGroups($languageID);
		$design->latinname="نام لاتین";
		$design->lbltitle="عنوان";
		$design->lbldesc="توضیحات";
		$design->lbllatinname="نام لاتین";
		$design->lblgrouplang="گروه";
		$infotitle=$productManageController->getAdditionalInfosTitle();
		$design->setAdditionalInfosTitle($infotitle);
		$design->setBtnsave("ذخیره");
		$design->setGrouplangs($groups);
		$design->setLblMainPhoto("تصویر اصلی");
		$design->setLblphoto(array("نقشه محصول","تصویر کاربری","مشخصات"));
		$design->setLblMakeThumb("ساخت عکس کوچک از تصویر اصلی");
		$design->setLblThumbPhoto("عکس کوچک");
		return $design;
	}
	private function loadData($ID,addproduct_Design $design)
	{
		
		$languageID=CurrentLanguageManager::getCurrentLanguageID();
		
		if($ID!="-1")
		{
			$productid=$_GET['productid'];
			$pcontrol=new ProductManageController();
			$product=$pcontrol->getProductByID($productid);
			
			if(!is_null($product) && count($product)>0)
			{
				$design->setTxtLatinName($product[0]['latinname']);
				$design->setTxtTitle($product[0]['title']);
				$design->setTxtdesc($product[0]['description']);
				$design->setId($productid);
				$design->setGroupid($product[0]['groups'][0]['productgroup_fid']);
				$design->setAdditionalInfos($product[0]['additionalinfo']);
				$design->getTxtVisits()->setValue($product[0]['visits']);
				if($product[0]['isnew']=="1")
					$design->getChkIsNew()->addSelectedValue("1");
				if($product[0]['isexists']=="1")
					$design->getChkIsExists()->addSelectedValue("1");
			}
				
		}
		else
			$design->setId("-1");
		
		return $design;
	}
	public function load()
	{
		$design=$this->getDesign();
		if(isset($_GET['productid']))
			$id=$_GET['productid'];
		else
			$id="-1";
		$design=$this->loadData($id, $design);
		return $design->getBodyHTML();
	}
	public function save_Click()
	{
		try {
		$mainphoto=$_FILES['mainphoto']['name'];
		$MainPhotoURL=null;
		$ThumbURL=null;
		if(isset($_FILES['mainphoto']['tmp_name']) && $_FILES['mainphoto']['tmp_name']!="")
			$MainPhotoURL=$this->UploadPhoto($_FILES['mainphoto']['tmp_name'], $_FILES['mainphoto']['name']);
		if(isset($_POST['makethumb']) && $_POST['makethumb']=="1")
		{
			$tmpurl=$MainPhotoURL['url'];
			$FileInfo = new \SplFileInfo($tmpurl);
			$Extension=$FileInfo->getExtension();
			$Extension=strtolower($Extension);
			if($Extension=="jpg" || $Extension=="jpeg")
				$Image=new JpegImage($tmpurl);
			elseif($Extension=="png")
				$Image=new PngImage($tmpurl);
			elseif($Extension=="gif")
			$Image=new GifImage($tmpurl);
			else
				throw new FileTypeError();
			$Image->setWidth(250);
			$Image->Save(DEFAULT_PUBLICPATH . $this->ThumbsPath . $MainPhotoURL['name']);
			$ThumbURL=$this->ThumbsPath . $MainPhotoURL['name'];
		}
		elseif(isset($_FILES['thumbnail']['tmp_name']) && $_FILES['thumbnail']['tmp_name']!="")
		{
			$ThumbURL=$this->UploadPhoto($_FILES['thumbnail']['tmp_name'], $_FILES['thumbnail']['name'],true);
			$ThumbURL= $ThumbURL['url'];
		}
		$photoURL=array();
		for($i=0;$i<count($_FILES['photo']['name']) && isset($_FILES['photo']['name']);$i++)
		{
			$filename=$_FILES['photo']['name'][$i];
			if(!is_null($filename))
			{
			    if(isset($_POST['delete'.$i]) && $_POST['delete'.$i]=="1")
			        $photoURL[$i]="";
			    else 
			    {
				    $photoURL[$i]=$this->UploadPhoto($_FILES['photo']['tmp_name'][$i], $filename);
				    if(!is_null($photoURL[$i]))
					   $photoURL[$i]=$photoURL[$i]['url'];
			    }
			}
		}
		$user=new sessionuser();
		$additionalInfoCount=ParameterManager::getParameter("productadditionalinfocount");
		if(is_null($additionalInfoCount))
			$additionalInfoCount=0;
		$additionalInfo=array();
		for($i=0;$i<$additionalInfoCount;$i++)
		{
			$additionalInfo[$i]=$_POST["info" . $i];
		}
		$ProductController=new ProductManageController();
		$design=$this->getDesign();
		$IsNew=0;
		if($design->getChkIsNew()->getSelectedValues()=="1")
			$IsNew="1";
		$IsExists=0;
		if($design->getChkIsExists()->getSelectedValues()=="1")
		    $IsExists="1";
		if(!isset($_POST['id']) || $_POST['id']==-1)
		{
			
						
			$ProductController->addProduct($_POST['latinname'], $_POST['txttitle'], $_POST['txtdesc'], $MainPhotoURL['url'], $ThumbURL, $design->getTxtVisits()->getValue(), "0", "1",$IsNew, $additionalInfo, $_POST['grouplang'], $photoURL,$IsExists);
			$design->setTxtLatinName("");
			$design->setTxtTitle("");
			$design->setTxtdesc("");
			$design->setId("-1");
			$design->setAdditionalInfos("");
			$design->setMessage("محصول مورد نظر با موفقیت به لیست محصولات اضافه شد");
			$link=new AppRooter("products", "listproducts");
			AppRooter::redirect($link->getAbsoluteURL(),1000);
			
		}
		else 
		{
			$ProductController->editProduct($_POST['id'],$_POST['latinname'], $_POST['txttitle'], $_POST['txtdesc'], $MainPhotoURL['url'], $ThumbURL, $design->getTxtVisits()->getValue(), "0", "1",$IsNew, $additionalInfo, $_POST['grouplang'], $photoURL,$IsExists);
			$design=$this->loadData($_POST['id'], $design);
			$design->setMessage("محصول مورد نظر با موفقیت ویرایش شد");
			$link=new AppRooter("products", "listproducts");
			AppRooter::redirect($link->getAbsoluteURL(),1000);
			
		}
		
		return $design->getBodyHTML();
		}
		catch (FileTypeError $FE)
		{
			return "نوع فایل تصویر ارسالی باید JPEG،Gif و یا PNG باشد ";
		}
	}
	public function UploadPhoto($tmpfile,$fileName,$isThumb=false)
	{
		if(!$isThumb)
			return uploadHelper::UploadFile($tmpfile, $fileName, $this->ImagesPath);
		else 
			return uploadHelper::UploadFile($tmpfile, $fileName, $this->ThumbsPath);
	}
	
}

?>