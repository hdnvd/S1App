<?php
namespace Modules\pages\Forms;
use \core\CoreClasses\services;
use \core\CoreClasses\services\FormCode;
use core\CoreClasses\db\dbquery;
use Modules\pages\Entity\pageEntity;
use Modules\pages\Entity\languageEntity;
use Modules\pages\EntityObjects\pageEntityObject;
use Modules\pages\Controllers\languageManageController;
use Modules\pages\Controllers\pageManageController;
	class pagemanage_Code extends FormCode
	{
		public function  __construct()
		{
			$this->setThemePage("admin.php");
		}
		public function load()
		{
			$design=new pagemanage_Design();
			$design=$this->loadPageLables($design);
			if(isset($_GET['pageid']))
			{
				$design=$this->loadPageContent($design, $_GET['pageid']);
				$design->setAction("edit");
				
			}
			else
				$design->setAction("add");
			return $design->getBodyHTML();
		}
		public function add_click()
		{
		
			$design=new pagemanage_Design();
			$design=$this->loadPageLables($design);
			$design->setTxtname($_POST['txtname']);
			$design->setTxttitle($_POST['txttitle']);
			$design->setTxtcontent($_POST['txtcontent']);
			$design->setTxttags($_POST['txttags']);
			$design->txtthumb=$_POST['txtthumb'];
			$pageController=new pageManageController();
			$pageController->AddPage($_POST['txtname'], $_POST['txttitle'], $_POST['txtcontent'], $_POST['sellanguage'],$_POST['txtthumb'],'1',$_POST['txttags']);
			$design->setMessage("صفحه با موفقیت اضافه شد");
			return $design->getBodyHTML();
		}
		public function edit_click()
		{
			$design=new pagemanage_Design();
			$design=$this->loadPageLables($design);
			$design->setTxtname($_POST['txtname']);
			$design->setTxttitle($_POST['txttitle']);
			$design->setTxtcontent($_POST['txtcontent']);
			$design->setTxttags($_POST['txttags']);
			$design->txtthumb=$_POST['txtthumb'];
			$pageController=new pageManageController();
			$pageController->EditPage($_POST['pageid'],$_POST['txtname'], $_POST['txttitle'], $_POST['txtcontent'], $_POST['sellanguage'],$_POST['txtthumb'],'1',$_POST['txttags']);
			$design->setMessage("صفحه با موفقیت ویرایش شد");
			return $design->getBodyHTML();
		}
		private function loadPageLables(pagemanage_Design $design)
		{
			$lblname="عنوان لاتین صفحه";
			$design->setLblname($lblname);
			$txtname="";
			$design->setTxtname($txtname);
			$lbltitle="عنوان";
			$design->setLbltitle($lbltitle);
			$txttitle="";
			$design->setTxttitle($txttitle);
			$lblcontent="محتوای صفحه";
			$design->setLblcontent($lblcontent);
			$txtcontent="";
			$design->setTxtcontent($txtcontent);
			$lbltags="تگ ها";
			$design->setLbltags($lbltags);
			$txttags="";
			$design->setTxttags($txttags);
			$btnsave="ذخیره";
			$design->setBtnsave($btnsave);
			$lbllanguage="زبان";
			$design->setLbllanguage($lbllanguage);
			$design->lblthumb="عکس صفحه";
			$langController=new languageManageController();
			$design->setSellanguage($langController->loadAll());
			return $design;
		}
		private function loadPageContent(pagemanage_Design $design,$PageID)
		{
			$Controller=new pageManageController();
			$PageData=$Controller->LoadPage($PageID);
			$design->setTxtname($PageData['page'][0]['name']);
			$design->setTxttitle($PageData['page'][0]['title']);
			$design->setTxtcontent($PageData['page'][0]['content']);
			$design->setTxttags("");
			$design->setPageID($PageID);
			$design->txtthumb=$PageData['page'][0]['thumb'];
			return $design;
		}
	}
?>
 