<?php
namespace Modules\kpex\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\kpex\Entity\kpex_contextEntity;
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
	private $PAGESIZE=30;
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
    public function makeHulthCSV($PageNum)
    {
        $DBAccessor=new dbaccess();
        for($i=6;$i<1461;$i++)
        {
            $textFileName=DEFAULT_PUBLICPATH . "content/files/kpex/hulth/" . $i.".abstr";
            $KeyWordsFileName=DEFAULT_PUBLICPATH . "content/files/kpex/hulth/" . $i.".uncontr";
            if(file_exists($textFileName) && file_exists($KeyWordsFileName))
            {
                $textFile = fopen($textFileName, "r") or die("Unable to open Text file $i");
                $keyWordsFile = fopen($KeyWordsFileName, "r") or die("Unable to open Keywords file $i");
                $Text=fread($textFile,filesize($textFileName));
//                echo "1:\n" . $Text;
                $Text=str_replace("\n	"," ",$Text);
//                $Text=strtolower($Text);
//                echo "2:\n" . $Text;
                $Text=explode("\n",$Text);
                $Title=$Text[0];
                $Text=$Text[1];
                $KeywordsText=fread($keyWordsFile,filesize($KeyWordsFileName));
                $KeywordsText=strtolower($KeywordsText);
//                $KeywordsText=str_replace("-"," ",$KeywordsText);
                $KeywordsText=str_replace("\t"," ",$KeywordsText);
                $KeywordsText=str_replace("; ",",",$KeywordsText);
                $KeywordsText=str_replace(";\n",",",$KeywordsText);
                $KeywordsText=str_replace("\n	",",",$KeywordsText);
//                $KeywordsText=str_replace(" ",",",$KeywordsText);

                $KeywordsTextArray=explode(",",$KeywordsText);
                $keys=[];
                for($j=0;$j<count($KeywordsTextArray);$j++)
                {
                    if(strlen(trim($KeywordsTextArray[$j]))>1)
                        $keys[$KeywordsTextArray[$j]]=1;
                }
                $keys=array_keys($keys);
                $KeywordsText=$keys[0];
                for($t=1;$t<count($keys);$t++)
                {
                    $KeywordsText=$KeywordsText . "," . $keys[$t];
                }
                $ent=new kpex_contextEntity($DBAccessor);
                $ent->setTitle($Title);
                $ent->setContent($Text);
                $ent->setWords($KeywordsText);
                $ent->setUrl("Hulth " . $i);
                $ent->Save();
                fclose($textFile);
                fclose($keyWordsFile);
            }
            $DBAccessor->close_connection();
//            else
//                echo $textFileName;
        }
        return $this->load($PageNum);
    }
    public function Run($ID,$PageNum)
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
        $StartTime=time();
        $ShellResult=(shell_exec("bash /home/hduser/env.sh $ID 2>&1"));
        $ShellResult=str_replace("\n","<br>",$ShellResult);
        $KeywordsFilePath=DEFAULT_PUBLICPATH.'/content/files/kpex/results/keywords'.$ID.".txt";
        $Keywords=$this->readCSV($KeywordsFilePath);
        $RateStr=$Keywords[0];
        $PrecisionStr=$Keywords[1];
        $RecallStr=$Keywords[2];
        $FScoreStr=$Keywords[3];
//echo "Rate:".substr($RateStr[0],5);
//        $testEnt->setApprate(substr($RateStr[0],5));
        try
        {

            $EndTime=time();
        $testEnt->setApprate($RateStr[2]);
        $testEnt->setPrecisionrate($PrecisionStr[2]);
        $testEnt->setRecall($RecallStr[2]);
        $testEnt->setFscore($FScoreStr[2]);
        $testEnt->setStart_time($StartTime);
        $testEnt->setEnd_time($EndTime);
        $KeywordsStr=$Keywords[17];
        for($i=18;$i<count($Keywords);$i++)
        {
            $KeywordsStr.=",".$Keywords[$i][1].":".$Keywords[$i][2];
        }
        $testEnt->setWords($KeywordsStr);
        $testEnt->save();
        }
        catch (\Exception $x)
        {
            echo "Can't Update Score";
        }

        $DBAccessor->close_connection();
        $Result= $this->load($PageNum);
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