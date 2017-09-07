<?php
namespace Modules\buysell\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\buysell\Entity\buysell_componentphotoEntity;
use Modules\buysell\Exceptions\ProductNotFoundException;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\buysell\Entity\buysell_componentEntity;
use Modules\users\PublicClasses\sessionuser;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-02-23 - 2017-05-13 21:09
*@lastUpdate 1396-02-23 - 2017-05-13 21:09
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class managecomponentsController extends Controller {
    private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	public function load($ID,$GroupID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$componentEnt=new buysell_componentEntity($DBAccessor);
		$su=new sessionuser();
        $UserID=null;
        if(!$this->adminMode)
            $UserID=$su->getSystemUserID();
		$result['data']=$componentEnt->FullSelect(null,null,null,null,null,$UserID,null,null,null,null,null,null,null,$GroupID,null,array(),array(),'0,1000');
		$result['group']['id']=$GroupID;
		$DBAccessor->close_connection();
		return $result;
	}
	public function DeleteItem($ID,$GroupID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$componentEnt=new buysell_componentEntity($DBAccessor);
        $su=new sessionuser();
        $UserID=null;
        if(!$this->adminMode)
            $UserID=$su->getSystemUserID();
        $comp=$componentEnt->Select($ID,null,null,null,null,$UserID,null,null,null,null,null,array(),array(),"0,1");
        if($comp==null || count($comp)<=0)
            throw new ProductNotFoundException();

        $comPhotEnt=new buysell_componentphotoEntity($DBAccessor);
		$photos=$comPhotEnt->Select(null,$ID,null,null,array(),array(),"0,1000");
		for($i=0;$i<count($photos);$i++)
        {
            $picname=$photos[$i]['url'];
            $picInf=pathinfo($picname);
            $picname=$picInf['basename'];
            unlink(DEFAULT_PUBLICPATH . "content/files/buysell/managecomponent/" . $picname);
        }
		$componentEnt->Delete($ID);
        $DBAccessor->close_connection();
		return $this->load(-1,$GroupID);
	}
}
?>