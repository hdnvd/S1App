<?php
namespace Modules\kpex\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\kpex\Entity\kpex_contextEntity;
use Modules\kpex\Entity\kpex_wordvectorEntity;
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
	public function makeWordVectorCSV()
    {
        $file = fopen("/home/hduser/FinalProject/wordEmbeddingPythonGlove/glove.6B.50d.txt","r");
        $row=fgetcsv($file,0,' ');
        $DBAccessor=new dbaccess();
        while($row!== FALSE)
        {

            $Word=$row[0];
            if(trim($Word)!="")
            {
                $Vector=$row[1];
                for($i=1;$i<count($row);$i++)
                {
                    $Vector=$Vector.",".$row[$i];
                }
                $vect=new kpex_wordvectorEntity($DBAccessor);
                $vect->setWord($Word);
                $vect->setVector($Vector);
                $vect->Save();
            }

            $row=fgetcsv($file,0,' ');
        }
//        file_put_contents($xx,$txt);
        $DBAccessor->close_connection();
        fclose($file);
        return $this->load(0);


    }
    public function makeHulthCSV($PageNum)
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
                $TextExploded=explode("\n",$Text);
                $Title=$TextExploded[0];
//                $Text=$Text[1];
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
                    $KeywordsText=$KeywordsText . "," . $keys[$t];
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
    public function makeMajuroCSV($PageNum)
    {
        $DBAccessor=new dbaccess();
        $path    = DEFAULT_PUBLICPATH . "content/files/kpex/majuro/";
        $files = array_diff(scandir($path), array('.', '..'));
        for($i=0;$i<count($files);$i++)
        {

            $ext = pathinfo($files[$i], PATHINFO_EXTENSION);
            if($ext=="txt")
            {
                $textFileName=t . $files[$i];
                $KeyWordsFileName=str_replace(".txt",'.key',$path . $files[$i]);
                if(file_exists($textFileName) && file_exists($KeyWordsFileName))
                {
                    $textFile = fopen($textFileName, "r") or die("Unable to open Text file $i");
                    $keyWordsFile = fopen($KeyWordsFileName, "r") or die("Unable to open Keywords file $i");
                    $Text=fread($textFile,filesize($textFileName));
//                $AbstractStart=strpos($Text,"ABSTRACT");
//                $AbstractEnd=strpos($Text,"Categories and Subject Descriptors");
                    $FirstLineEnd=strpos($Text,"\n");
                    $Title=substr($Text,0,$FirstLineEnd);
//                $AbstractStart=$AbstractStart+9;
//                $Text=substr($Text,$AbstractStart,$AbstractEnd-$AbstractStart);
                    $Text=str_replace("\n"," ",$Text);
                    $KeywordsText=fread($keyWordsFile,filesize($KeyWordsFileName));
                    $KeywordsText=strtolower($KeywordsText);
                    $KeywordsText=str_replace("\n",",",$KeywordsText);
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
                    $ent->setUrl("Majuro ".basename($textFileName)."-" . $i);
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
                    $TestEnt->setDescription("Majuro ".basename($textFileName)."-" . $i);
                    $TestEnt->setWords("");
                    $TestEnt->Save();


                    fclose($textFile);
                    fclose($keyWordsFile);
                }
            }

//            else
//                echo $textFileName;
        }
        $DBAccessor->close_connection();
        return $this->load($PageNum);
    }
    public function makeSemEvalCSV($PageNum)
    {
        $DBAccessor=new dbaccess();
        for($i=1;$i<99;$i++)
        {
            $FilePreName="C";
//            $FilePreName="H";
//            $FilePreName="I";
//            $FilePreName="J";
            $textFileName=DEFAULT_PUBLICPATH . "content/files/kpex/semeval/$FilePreName-" . $i.".txt";
            $KeyWordsFileName=DEFAULT_PUBLICPATH . "content/files/kpex/semeval/$FilePreName-" . $i.".key";
            if(file_exists($textFileName) && file_exists($KeyWordsFileName))
            {
                $textFile = fopen($textFileName, "r") or die("Unable to open Text file $i");
                $keyWordsFile = fopen($KeyWordsFileName, "r") or die("Unable to open Keywords file $i");
                $Text=fread($textFile,filesize($textFileName));
//                $AbstractStart=strpos($Text,"ABSTRACT");
//                $AbstractEnd=strpos($Text,"Categories and Subject Descriptors");
                $FirstLineEnd=strpos($Text,"\n");
                $Title=substr($Text,0,$FirstLineEnd);
//                $AbstractStart=$AbstractStart+9;
//                $Text=substr($Text,$AbstractStart,$AbstractEnd-$AbstractStart);
                $Text=str_replace("\n"," ",$Text);
                $KeywordsText=fread($keyWordsFile,filesize($KeyWordsFileName));
                $KeywordsText=strtolower($KeywordsText);
                $KeywordsText=str_replace("\n",",",$KeywordsText);
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
                $ent->setUrl("Semeval ".$FilePreName."-" . $i);
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
                $TestEnt->setDescription("Semeval ".$FilePreName."-" . $i);
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
//        echo exec('whoami');s
//        $ShellResult="";
        $StartTime=time();
        $ShellResult=(shell_exec("bash /home/hduser/env.sh $ID 2>&1"));
        $ShellResult=str_replace("Adding annotator tokenize\n","",$ShellResult);
        $ShellResult=str_replace("Adding annotator ssplit\n","",$ShellResult);
        $ShellResult=str_replace("Adding annotator pos\n","",$ShellResult);
        $ShellResult=str_replace("Adding annotator lemma\n","",$ShellResult);
        $ShellResult=str_replace("zip warning: name not matched: META-INF/*.SF\n","",$ShellResult);
        $ShellResult=str_replace("zip warning: name not matched: META-INF/*.DSA\n","",$ShellResult);
        $ShellResult=str_replace("zip warning: name not matched: META-INF/*.RSA\n","",$ShellResult);
        $ShellResult=str_replace("deleting: META-INF/DUMMY.SF\n","",$ShellResult);
        $ShellResult=str_replace("deleting: META-INF/DUMMY.DSA\n","",$ShellResult);
        $ShellResult=str_replace("deleting: META-INF/BCKEY.SF\n","",$ShellResult);
        $ShellResult=str_replace("deleting: META-INF/BCKEY.DSA\n","",$ShellResult);
        $ShellResult=str_replace("deleting: META-INF/DEV.SF\n","",$ShellResult);
        $SherllResult=str_replace("deleting: META-INF/DEV.DSA\n","",$ShellResult);
        $ShellResult=str_replace("WARN util.NativeCodeLoader: Unable to load native-hadoop library for your platform... using builtin-java classes where applicable\n","",$ShellResult);
        $ShellResult=str_replace("INFO fs.TrashPolicyDefault: Namenode trash configuration: Deletion interval = 0 minutes, Emptier interval = 0 minutes.\n","",$ShellResult);
        $ShellResult=str_replace("WARN: Establishing SSL connection without server's identity verification is not recommended. According to MySQL 5.5.45+, 5.6.26+ and 5.7.6+ requirements SSL connection must be established by default if explicit option isn't set. For compliance with existing applications not using SSL the verifyServerCertificate property is set to 'false'. You need either to explicitly disable SSL by setting useSSL=false, or set useSSL=true and provide truststore for server certificate verification.\n","",$ShellResult);
        $initStart=strpos($ShellResult,"/Initiating...");
        $initEnd=strpos($ShellResult,"/Initiation Completed");
        if($initStart>=0 && $initEnd>0)
        {
            $ShellResult=substr($ShellResult,$initStart);
        }
        $ShellResult=str_replace("\n","<br>",$ShellResult);
        $KeywordsFilePath=DEFAULT_PUBLICPATH.'/content/files/kpex/results/keywords'.$ID.".txt";
        $CatchFilePath=DEFAULT_PUBLICPATH.'/content/files/kpex/results/catch.csv';
        $Keywords=$this->readCSV($KeywordsFilePath);
        $CatchedData=$this->readCSV($CatchFilePath,"\"");
//        print_r($CatchedData);
        for($CDId=0;$CDId<count($CatchedData);$CDId++)
        {
            $Row=$CatchedData[$CDId];
            $TestIDOfRow=$Row[0];
            echo $TestIDOfRow;
            $rowTest=new kpex_testEntity($DBAccessor);
            $rowTest->setId($TestIDOfRow);
            $NPTxt="";
            for($NpID=1;$NpID<count($Row);$NpID++)
            {
                if($NPTxt!="")
                    $NPTxt=$NPTxt."\t";
                $NPTxt=$NPTxt.$Row[$NpID];
            }
            $rowTest->setWords($NPTxt);
            $rowTest->setUpdated_at(time());
            $rowTest->setWords($NPTxt);
            $rowTest->Save();
        }
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
    function readCSV($csvFile,$Delimiter="\t"){
        $line_of_text=array();
	    if(file_exists($csvFile))
        {

            $file_handle = fopen($csvFile, 'r');
            while (!feof($file_handle) ) {
                $line_of_text[] = fgetcsv($file_handle, 1024,$Delimiter);
            }
            fclose($file_handle);
        }
        return $line_of_text;
    }
}
?>