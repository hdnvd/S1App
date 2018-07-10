<?php
namespace Modules\kpex\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\kpex\Entity\kpex_testEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-03-24 - 2018-06-14 03:29
*@lastUpdate 1397-03-24 - 2018-06-14 03:29
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managetestsController extends testlistController {
	private $PAGESIZE=10;
	public function DeleteItem($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$testEnt=new kpex_testEntity($DBAccessor);
		$testEnt->setId($ID);
		if($testEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $testEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$testEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
    public function Run($ID)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
        $testEnt=new kpex_testEntity($DBAccessor);
        $testEnt->setId($ID);
        if($testEnt->getId()==-1)
            throw new DataNotFoundException();
        if($UserID!=null && $testEnt->getRole_systemuser_fid()!=$UserID)
            throw new DataNotFoundException();
        set_time_limit( 0 );
//        echo exec('whoami');
//        $ShellResult="";
        $ShellResult=(shell_exec("bash /home/hduser/env.sh $ID 2>&1"));
        $ShellResult=str_replace("\n","<br>",$ShellResult);
        $KeywordsFilePath=DEFAULT_PUBLICPATH.'/content/files/kpex/results/keywords'.$ID.".txt";
        $Keywords=$this->readCSV($KeywordsFilePath);
        $RateStr=$Keywords[0];
//echo "Rate:".substr($RateStr[0],5);
//        $testEnt->setApprate(substr($RateStr[0],5));
//        $testEnt->setApprate($RateStr[2]);
        $KeywordsStr=$Keywords[10];
        for($i=11;$i<count($Keywords);$i++)
        {
            $KeywordsStr.=",".$Keywords[$i][1].":".$Keywords[$i][2];
        }
        $testEnt->setWords($KeywordsStr);
        $testEnt->save();
        $DBAccessor->close_connection();
        $Result= $this->load(-1);
        $Result['shellscript']=$ShellResult;
        return $Result;
    }
    function readCSV($csvFile){
        $line_of_text=array();
	    if(file_exists($csvFile))
        {

            $file_handle = fopen($csvFile, 'r');
            while (!feof($file_handle) ) {
                $line_of_text[] = fgetcsv($file_handle, 1024,"\t");
            }
            fclose($file_handle);
        }
        return $line_of_text;
    }
}
?>