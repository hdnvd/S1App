<?php

namespace Modules\users\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\Controllers\managerolesController;


class manageroles_Code extends FormCode {
	public function load()
	{
		$managerolesController=new managerolesController();
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$managerolesController->load();
		$design=new manageroles_Design();
		$design->setRoles($Fields['roles']);
		$design->setTasks($Fields['tasks']);
		return $design->getBodyHTML();
	}
	public function addnewrole_Click()
	{
		$managerolesController=new managerolesController();
		$design=new manageroles_Design();
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$managerolesController->addrole($design->getTitle(), $design->getDefaultModule(), $design->getDefaultPage());

		$design->setRoles($Fields['roles']);
		$design->setTasks($Fields['tasks']);
		return $design->getBodyHTML();
	}
	public function setprevilage_Click()
	{
		$managerolesController=new managerolesController();
		$design=new manageroles_Design();
		$translator=new ModuleTranslator("users");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$managerolesController->setPrevilages($design->getSelectedRole(), $design->getPrevilages());
		$design->setRoles($Fields['roles']);
		$design->setTasks($Fields['tasks']);
		return $design->getBodyHTML();
	}
	public function getThemePage($Action="load")
	{
		if($Action=="getroleprevilages_Click")
			return "ajax.php";
		else
			return parent::getThemePage($Action);
	}
	public function getroleprevilages_Click()
	{
		
		$managerolesController=new managerolesController();
		$design=new manageroles_Design();
		$Fields=$managerolesController->getRoleTasks($design->getSelectedRole());
		$result="";
		for($i=0;$i<count($Fields);$i++)
		{
			if($i>0)
				$result.=",";
			$result.=$Fields[$i]['systemtask_fid'];
		}
		return $result;
	}
}
?>
