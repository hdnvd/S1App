<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_carmakerEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-21 - 2017-02-09 02:04
*@lastUpdate 1395-11-21 - 2017-02-09 02:04
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class managecarmakerController extends Controller {
	public function load($id)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $CMEnt=new buysell_carmakerEntity($DBAccessor);
		if($id>=0)
        $result['cmaker']=$CMEnt->Select($id,null,null,null,array('id'),array(false),"0,1");

		$DBAccessor->close_connection();
		return $result;
	}

    /**
     * @param $id
     * @param $txtLatinTitle
     * @param $txtTitle
     * @param $flLogo
     * @return array
     */
    public function BtnSave($id, $txtLatinTitle, $txtTitle, $flLogo)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $CMEnt=new buysell_carmakerEntity($DBAccessor);
        if($id==-1)
            $CMEnt->Insert($txtLatinTitle,$txtTitle,$flLogo[0]['url']);
        else
            $CMEnt->Update($id,$txtLatinTitle,$txtTitle,$flLogo[0]['url']);

		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>