<?php

namespace Modules\appman\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\appman\Entity\appman_productkeyEntity;
use Modules\appman\Entity\appman_userdeviceEntity;
use Modules\common\PublicClasses\AppDate;
use Modules\appman\Entity\appman_appuserEntity;
use Modules\users\PublicClasses\User;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/10/17 16:53:41
 *@lastUpdate 2015/10/17 16:53:41
 *@SweetFrameworkHelperVersion 1.108
*/


class registerController extends Controller {
    public static $KEYSTATUS_NOTEXIST=1;
    public static $KEYSTATUS_REGISTERED=2;
    public static $KEYSTATUS_FREE=3;
    public static $KEYSTATUS_REGISTEREDTOOTHER=4;
	public function load()
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$result=array();
		$result['param1']="";
		/*$APPPrefix="SWEETSOFTWAREGROUPBYHADIAMIRNAHAVANDIMBCSE";
		echo $this->getAppPassword($APPPrefix, "7687358b4720049c");*/
		$DBAccessor->close_connection();
		return $result;
	}
	public function register($productkey,$deviceCode,$name,$mobile,$width,$height,$appid,$os,$devicename,$osversion,$accounts,$city,$mail,$ismale)
	{
	    $Language_fid=CurrentLanguageManager::getCurrentLanguageID();
	    $DBAccessor=new dbaccess();
	    $result=array();
	    $Ent=new appman_productkeyEntity($DBAccessor);
	    $DevEnt=new appman_userdeviceEntity($DBAccessor);
	    $DBResult=$Ent->Select(null, $productkey, null, null, null, null, null, $appid, array("id"), array(false), "0,1");
	    $result['password']="";
	    if($DBResult!==null && is_array($DBResult) && count($DBResult)>0)
	    {
	        $KeyID=$DBResult[0]['id'];
	        $DeviceID=$DBResult[0]['userdevice_fid'];
	        $APPPrefix="SWEETSOFTWAREGROUPBYHADIAMIRNAHAVANDIMBCSE";
	        if($DeviceID>0)
	        {
	            
	            $theDevice=$DevEnt->Select($DeviceID, null, null, null, null, null, null, null, array('id'), array(false), "0,1");
	            $oldDeviceCode=$theDevice[0]['devicecode'];
	            if($oldDeviceCode==$deviceCode)
	            {
	                $result['keystatus']=registerController::$KEYSTATUS_REGISTERED;
	                $result['password']=$this->getAppPassword($APPPrefix,$deviceCode);
	            }
	            else 
	                $result['keystatus']=registerController::$KEYSTATUS_REGISTEREDTOOTHER;
	        }
	        else
	        {
	            $result['keystatus']=registerController::$KEYSTATUS_FREE;
	            $this->registerNewDevice($DBAccessor, $KeyID, $deviceCode, $name, $mobile, $width, $height, $appid, $os, $devicename, $osversion, $accounts, $city,$mail,$ismale);
	            $result['password']=$this->getAppPassword($APPPrefix,$deviceCode);
	            
	        }
	    }
	    else
	        $result['keystatus']=registerController::$KEYSTATUS_NOTEXIST;
	    
	    
	    $DBAccessor->close_connection();
	    return $result;
	}
	
	
	private function registerNewDevice(dbaccess $DBAccessor,$ProductKeyID,$deviceCode,$name,$mobile,$width,$height,$appid,$os,$devicename,$osversion,$accounts,$city,$mail,$ismale)
	{
	   $PKeyEnt=new appman_productkeyEntity($DBAccessor);
	   $DeviceEnt=new appman_userdeviceEntity($DBAccessor);
	   $AppUserEnt=new appman_appuserEntity($DBAccessor);
	   
	   
	   /*****************************SystemUser***************************/
        $SystemUserID=-1;
        $SystemUserID=User::getSystemUserIDFromUser($mobile);
	   if($SystemUserID<=0)
	       $SystemUserID=User::addUser($mobile, $mobile);
	   /*****************************EOF SystemUser***************************/
	   
	   /*****************************Device***************************/
	   $DeviceID=-1;
	   $OldDevice=$DeviceEnt->Select(null, $deviceCode, null, null, null, null, null, null, array("id"), array(false), "0,1");
	   if($OldDevice!==null && is_array($OldDevice) && count($OldDevice)>0)
	   {
	       $DeviceID=$OldDevice[0]['id'];
	       $DeviceEnt->Update($DeviceID,$deviceCode, $os, $devicename, $width, $height, $osversion, $accounts);
	   }
	   else
	   {
	       $DeviceID=$DeviceEnt->Insert($deviceCode, $os, $devicename, $width, $height, $osversion, $accounts);
	   }
	   /*****************************EOF Device***************************/
	   
	   $OldAppUser=$AppUserEnt->Select(null, null, $mobile, null, null,null, array("id"), array(false), "0,1");
	   if($OldAppUser!==null && is_array($OldAppUser) && count($OldAppUser)>0)
	   {
	       $AppUserEnt->Update($OldAppUser[0]['id'], $name, $mobile, $mail, $ismale, null);
	   }
	   else
	       $AppUserEnt->Insert($name, $mobile, $mail, $ismale, $SystemUserID);
	   
	   $PKeyEnt->Update($ProductKeyID, null, $DeviceID, AppDate::now(), null, $SystemUserID, null, null);
	   return true;
	}
	public function getAppPassword($APPPrefix,$DeviceCode)
	{
	    $DevicePass1=-1;
	    $textToEncrypt=$APPPrefix . $DeviceCode;
	     
	    for($i=0;$i<strlen($textToEncrypt);$i++)
	        $DevicePass1+=(ord(substr($textToEncrypt,$i, 1)))%24;
	        $DevicePass1*=8;
	        $DevicePass1+=888;
	        $DevicePass=substr($DeviceCode, 5) . $DevicePass1;
		    return $DevicePass;
	}
}
?>
