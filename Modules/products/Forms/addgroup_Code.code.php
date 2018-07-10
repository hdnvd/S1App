<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\FormCode;
use Modules\products\Controllers\ProductGroupManageController;
use Modules\products\BusinessObjects\productGroupBO;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\products\Controllers\ProductManageController;
use Modules\products\Controllers\addgroupController;
use Modules\products\Entity\products_productgroupEntity;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class addgroup_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setThemePage("admin.php");
		$this->setTitle("مدیریت گروه محصول");
	}
	public function load()
	{
		$design=$this->getAddGroupForm();
		return $design->getBodyHTML();
	}
	private function getAddGroupForm()
	{
		$GroupID=null;
		if(isset($_GET['id']) && is_numeric($_GET['id']))
			$GroupID=$_GET['id'];
		$control=new addgroupController();
		$result=$control->load($GroupID);
		$groups=$result['groups'];
		if(is_null($groups))
			$groups=array();
		array_push($groups, array("title"=>"بدون گروه مادر","id"=>"-1"));
		$design=new addgroup_Design();

		$design->getBtnSave()->setAction("add");
		if(key_exists("group", $result) && count($result['group'])>0)
		{
			$design->getTxtLatinTitle()->setValue($result['group'][0]['latintitle']);
			$design->getTxtTitle()->setValue($result['group'][0]['title']);
			$design->setMotherGroupID($result['group'][0]['mother_fid']);
			$design->getTxtHidGroupID()->setValue($result['group'][0]['id']);
			$design->getBtnSave()->setAction("edit");
		}
		$design->setLblGroupLatinName("عنوان لاتین");
		$design->setLblGroupName("عنوان گروه");
		$design->setLblMotherGroup("گروه مادر");
		$design->getBtnSave()->SetAttribute("value", "ذخیره");
		$design->setSelMotherGroup($groups);
		
		return $design;
	}
	public function add_Click()
	{
		$design=$this->getAddGroupForm();
		$mother=$_POST['mothergroup'];
		$latintitle=$design->getTxtLatinTitle()->getValue();
		$title=$design->getTxtTitle()->getValue();
		$control=new addgroupController();
		$control->addGroup($latintitle, $title, $mother);
		$design->getTxtLatinTitle()->setValue("");
		$design->getTxtTitle()->setValue("");
		$design->getMessage()->setText("گروه مورد نظر با موفقیت ذخیره شد.");
		return $design->getBodyHTML();
	}
	public function edit_Click()
	{
		$design=new addgroup_Design();
		$mother=$_POST['mothergroup'];

		$ID=$design->getTxtHidGroupID()->getValue();
		$latintitle=$design->getTxtLatinTitle()->getValue();
		echo $latintitle;
		$title=$design->getTxtTitle()->getValue();
		$control=new addgroupController();
		$control->editGroup($ID,$latintitle, $title, $mother);
		$design=$this->getAddGroupForm();
		$design->getTxtLatinTitle()->setValue("");
		$design->getTxtTitle()->setValue("");
		
		$design->getMessage()->setText("گروه مورد نظر با موفقیت ویرایش شد.");
		return $design->getBodyHTML();
	}
	
}

?>