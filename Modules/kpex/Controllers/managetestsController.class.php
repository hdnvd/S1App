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
        $file = fopen("/home/hduser/fear.csv","r");
        $Sid=1;
        $row=fgetcsv($file);
        $xx="/home/hduser/far.csv";
        $txt="";
        while($row!== FALSE)
        {

            $f=$row[0];
            $f2=$row[1];
            if($f!="***************")
                $txt=$txt. "\"" . $f ."\"".",\"" . $f2 ."\"".",\"" . $Sid ."\""."\r\n";
            else
                $Sid++;
            $row=fgetcsv($file);
        }
        file_put_contents($xx,$txt);
        fclose($file);

    }
    public function makeHulthCSVAA($PageNum)
    {
        $DBAccessor=new dbaccess();
        for($i=1;$i<2300;$i++)
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
                $TestEnt=new kpex_testEntity($DBAccessor);
                $TestEnt->setTestgroup_fid(4);
                $TestEnt->setContext_fid($ent->getId());
                $TestEnt->setNouninfluence(1);
                $TestEnt->setNounoutinfluence(1);
                $TestEnt->setAdjectiveinfluence(1);
                $TestEnt->setAdjectiveoutinfluence(1);
                $TestEnt->setIs_postaged(true);
                $TestEnt->setIs_similarityedgeweighed(1);
                $TestEnt->setSimilarity_threshold("1000");
                $TestEnt->setMethod_fid(4);

                $TestEnt->setCreated_at(time());
                $TestEnt->setUpdated_at(-1);
                $TestEnt->setDescription("Hulth " . $i);
                $TestEnt->setWords("");
                $TestEnt->Save();

                $TestEnt=new kpex_testEntity($DBAccessor);
                $TestEnt->setTestgroup_fid(5);
                $TestEnt->setContext_fid($ent->getId());
                $TestEnt->setNouninfluence(1);
                $TestEnt->setNounoutinfluence(1);
                $TestEnt->setAdjectiveinfluence(1);
                $TestEnt->setAdjectiveoutinfluence(1);
                $TestEnt->setIs_postaged(true);
                $TestEnt->setIs_similarityedgeweighed(0);
                $TestEnt->setSimilarity_influence(1);
                $TestEnt->setSimilarity_threshold("0");
                $TestEnt->setMethod_fid(4);
                $TestEnt->setCreated_at(time());
                $TestEnt->setUpdated_at(-1);
                $TestEnt->setDescription("Hulth " . $i);
                $TestEnt->setWords("");
                $TestEnt->Save();

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
//        $ShellResult=str_replace("Adding annotator tokenize\n","",$ShellResult);
//        $ShellResult=str_replace("Adding annotator ssplit\n","",$ShellResult);
//        $ShellResult=str_replace("Adding annotator pos\n","",$ShellResult);
//        $ShellResult=str_replace("Adding annotator lemma\n","",$ShellResult);
//        $ShellResult=str_replace("zip warning: name not matched: META-INF/*.SF\n","",$ShellResult);
//        $ShellResult=str_replace("zip warning: name not matched: META-INF/*.DSA\n","",$ShellResult);
//        $ShellResult=str_replace("zip warning: name not matched: META-INF/*.RSA\n","",$ShellResult);
//        $ShellResult=str_replace("deleting: META-INF/DUMMY.SF\n","",$ShellResult);
//        $ShellResult=str_replace("deleting: META-INF/DUMMY.DSA\n","",$ShellResult);
//        $ShellResult=str_replace("deleting: META-INF/BCKEY.SF\n","",$ShellResult);
//        $ShellResult=str_replace("deleting: META-INF/BCKEY.DSA\n","",$ShellResult);
//        $ShellResult=str_replace("deleting: META-INF/DEV.SF\n","",$ShellResult);
//        $ShellResult=str_replace("deleting: META-INF/DEV.DSA\n","",$ShellResult);
//        $ShellResult=str_replace("WARN util.NativeCodeLoader: Unable to load native-hadoop library for your platform... using builtin-java classes where applicable\n","",$ShellResult);
//        $ShellResult=str_replace("INFO fs.TrashPolicyDefault: Namenode trash configuration: Deletion interval = 0 minutes, Emptier interval = 0 minutes.\n","",$ShellResult);
//        $ShellResult=str_replace("WARN: Establishing SSL connection without server's identity verification is not recommended. According to MySQL 5.5.45+, 5.6.26+ and 5.7.6+ requirements SSL connection must be established by default if explicit option isn't set. For compliance with existing applications not using SSL the verifyServerCertificate property is set to 'false'. You need either to explicitly disable SSL by setting useSSL=false, or set useSSL=true and provide truststore for server certificate verification.\n","",$ShellResult);
//        $initStart=strpos($ShellResult,"/Initiating...");
//        $initEnd=strpos($ShellResult,"/Initiation Completed");
//        if($initStart>=0 && $initEnd>0)
//        {
//            $ShellResult=substr($ShellResult,$initStart);
//        }
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
        $Result['precision']=$testEnt->getPrecisionrate();
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