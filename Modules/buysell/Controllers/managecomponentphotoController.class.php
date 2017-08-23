<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_componentEntity;
use Modules\buysell\Entity\buysell_componentphotoEntity;
use Modules\buysell\Exceptions\ProductNotFoundException;
use Modules\buysell\Exceptions\ProductPhotoNotFoundException;
use Modules\buysell\PublicClasses\Constants;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;

/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-27 - 2017-02-15 13:42
*@lastUpdate 1395-11-27 - 2017-02-15 13:42
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponentphotoController extends Controller {
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $phEnt=new buysell_componentphotoEntity($DBAccessor);
        $CEnt=new buysell_componentEntity($DBAccessor);
        $su=new sessionuser();
		if($ID!=-1){
            $result['photos']=$phEnt->Select(null,$ID,null,null,array('id'),array('false'),"0,". Constants::$MAXPHOTOCOUNT);
            $result['component']=$CEnt->Select($ID,null,null,null,null,$su->getSystemUserID(),null,null,null,null,null,array(),array(),"0,1");
            if($result['component']==null || count($result['component'])<1)
                throw new ProductNotFoundException();
		}

		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnAddNew($ID,$flPhoto)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
        $su=new sessionuser();
        $cEnt=new buysell_componentEntity($DBAccessor);
        $comp=$cEnt->Select($ID,null,null,null,null,$su->getSystemUserID(),null,null,null,null,null,array(),array(),"0,1");
        if($comp==null || count($comp)<=0)
            throw new ProductNotFoundException();

        $phEnt=new buysell_componentphotoEntity($DBAccessor);
        $phEnt->Insert($ID,0,$flPhoto[0]['url']);
		$DBAccessor->close_connection();
		return $this->load($ID);
	}
    public function DeletePhoto($ComponentID,$PhotoID)
    {
        $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
        $DBAccessor=new dbaccess();
        $result=array();
        $su=new sessionuser();
        $cEnt=new buysell_componentEntity($DBAccessor);
        $comp=$cEnt->Select($ComponentID,null,null,null,null,$su->getSystemUserID(),null,null,null,null,null,array(),array(),"0,1");
        if($comp==null || count($comp)<=0)
            throw new ProductNotFoundException();

        $phEnt=new buysell_componentphotoEntity($DBAccessor);
        $photo=$phEnt->Select($PhotoID,$ComponentID,null,null,array(),array(),"0,1");
        if($photo==null || count($photo)<=0)
            throw new ProductPhotoNotFoundException();
        $phEnt->Delete($PhotoID);
        $DBAccessor->close_connection();
        return $this->load($ComponentID);
    }
}
?>