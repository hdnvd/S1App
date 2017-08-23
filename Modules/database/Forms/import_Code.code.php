<?php

namespace Modules\database\Forms;
use core\CoreClasses\services\FormCode;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\database\Controllers\importController;


class import_Code extends FormCode {
	public function load()
	{
		$importController=new importController();
		$translator=new ModuleTranslator("database");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$Fields=$importController->load();
		$design=new import_Design();
		return $design->getBodyHTML();
		//ENTER THE RELEVANT INFO BELOW
		$mysqlDatabaseName ='test';
		$mysqlUserName ='root';
		$mysqlPassword ='';
		$mysqlHostName ='localhost';
		$mysqlImportFilename ='dbbackupmember.sql';
		//DONT EDIT BELOW THIS LINE
		//Export the database and output the status to the page
		$command='mysql -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;
		exec($command,$output=array(),$worked);
		switch($worked){
			case 0:
				echo 'Import file <b>' .$mysqlImportFilename .'</b> successfully imported to database <b>' .$mysqlDatabaseName .'</b>';
				break;
			case 1:
				echo 'There was an error during import. Please make sure the import file is saved in the same folder as this script and check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr><tr><td>MySQL Import Filename:</td><td><b>' .$mysqlImportFilename .'</b></td></tr></table>';
				break;
		}
	}
}
?>
