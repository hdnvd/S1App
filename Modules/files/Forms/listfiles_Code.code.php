<?php

namespace Modules\files\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\files\Controllers\listfilesController;
use core\CoreClasses\Sweet2DArray;


class listfiles_Code extends FormCode {
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->setThemePage("admin.php");
	}
	public function load()
	{
		$listfilesController=new listfilesController();
		$translator=new ModuleTranslator("files");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$listfilesController->load();
		
		$Fields=Sweet2DArray::array_filp($Fields);
		$design=new listfiles_Design();
		$design->setLblviewlinks($translator->getWordTranslation("lblviewlink"));
		$design->setLblfilename($translator->getWordTranslation("lblfilename"));
		$design->setLblfiletitle($translator->getWordTranslation("lblfiletitle"));
		$design->setLblIndexTitle($translator->getWordTranslation("lblindex"));
		
		$design->setViewTitle($translator->getWordTranslation("viewlink"));
		$urls=$Fields['url'];
		
		$design->setLblfiletitles($Fields['title']);
		$links=array();
		$names=array();
		for($i=0;$i<count($urls);$i++)
		{
			$links[$i]=DEFAULT_PUBLICURL . htmlspecialchars($urls[$i]);
			$names[$i]=basename($urls[$i]);
		}
		$design->setViewlinks($links);
		$design->setLblfilenames($names);
		return $design->getBodyHTML();
	}
}
?>
