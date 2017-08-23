<?php

namespace Modules\sfman\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Entity\sfman_moduleEntity;
use Modules\sfman\Entity\sfman_formEntity;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2016/05/14 16:05:05
 *@lastUpdate 2016/05/14 16:05:05
 *@SweetFrameworkHelperVersion 1.109
*/


class pcFormManagerController extends Controller {
    
	public function FindModule($ModuleName)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$ModEnt=new sfman_moduleEntity($DBAccessor);
		$Mods=$ModEnt->Select(null, $ModuleName, null, null, array("id"), array(false), "0,1");
		$result['isfound']=false;
		if($Mods!=null && is_array($Mods) && count($Mods)>0)
		{
		    $result['isfound']=true;
		    $result['isenabled']=$Mods[0]['isenabled'];
		}
		$DBAccessor->close_connection();
		return $result;
	}
	public function FindForm($ModuleName,$FormName)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$ModEnt=new sfman_moduleEntity($DBAccessor);
		$formEnt=new sfman_formEntity($DBAccessor);
		$Mods=$ModEnt->Select(null, $ModuleName, null, null, array("id"), array(false), "0,1");
		$result['isfound']=false;
		if($Mods!=null && is_array($Mods) && count($Mods)>0)
		{
		    $ModuleID=$Mods[0]['id'];
		    $result['isenabled']=$Mods[0]['isenabled'];
		    $form=$formEnt->Select(null, $FormName, null, $ModuleID, null,  array("id"), array(false), "0,1");
		    if($form!=null && is_array($form) && count($form)>0)
		    {
		        $result['isfound']=true;
		        if($result['isenabled'])
		            $result['isenabled']=$form[0]['isenabled'];
		    }
		}
		$DBAccessor->close_connection();
		return $result;
	}
}
?>
