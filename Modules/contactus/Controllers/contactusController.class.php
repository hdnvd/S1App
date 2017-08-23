<?php

namespace Modules\contactus\Controllers;

use core\CoreClasses\services\Controller;
use Modules\contactus\Exceptions\EmptyMessageException;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\contactus\Entity\contactus_contactinfoEntity;
use core\CoreClasses\db\dbaccess;
use Modules\contactus\Entity\contactus_usermessageEntity;
use core\CoreClasses\SweetDate;
use Modules\common\PublicClasses\AppDate;
use Modules\parameters\PublicClasses\ParameterManager;

/**
 *
 * @author nahavandi
 *        
 */
class contactusController extends Controller {
	public function load()
	{
	    $LanguageID=CurrentLanguageManager::getCurrentLanguageID();
	    $DBAccessor=new dbaccess();
	    $CIEnt=new contactus_contactinfoEntity($DBAccessor);
	    $result['infos']=$CIEnt->Select(null, $LanguageID, null, null, null, array(), array(), "0,30");
	    return $result;
	}
	
	
	public function send($Name,$Family,$Tel,$Mobile,$Mail,$Message,$Ip, $Systeminfo)
	{
	    $Date=new AppDate();
	    if(trim($Message)!="")
        {

            $this->sendMail($Name, $Family, $Tel, $Mobile, $Mail, $Message,$Ip);
            $Ent=new contactus_usermessageEntity(new dbaccess());
            $Ent->Insert($Name, $Family, $Tel, $Mobile, $Mail, $Message, $Date->now(), $Ip, $Systeminfo,"0");
        }
        else
            throw new EmptyMessageException();
	    return;
	}
	
	
	private function sendMail($Name,$Family,$Tel,$Mobile,$Mail,$Message,$IP)
	{
	    $to=ParameterManager::getParameter("contactus_email");
	    $SweetMail="hadi.nahavandi2010@gmail.com";
	    if($to=="")
	        $to=$SweetMail;
	    $headers = 'From: SweetSoft.ir info@sweetsoft.ir' . "\r\n" .
	        'Reply-To: info@sweetsoft.ir' . "\r\n";
	    $headers .= "MIME-Version: 1.0\r\n";
	    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	    $headers .='X-Mailer: PHP/' . phpversion();
	     
	    $ItemTitleStyle="style=\"width:25%;font-family:Tahoma,Arial;padding:5px;line-height:30px;background:#5679C5;color:#ffffff;margin:5px; border-bottom:1px dashed #ffffff;vertical-align:top;\"";
	    $ItemStyle="style=\"min-width:73%;font-family:Tahoma,Arial;padding:5px;line-height:30px;background:#ffffff;color:#444444;margin:5px;border-bottom:1px dashed #444444;border-left: 1px dashed #444;\"";
	    $TopStyle="style=\"font-family:Tahoma,Arial;background:#1EB062;color:#ffffff;border-radius:8px 8px 0 0; margin:5px;width:100%;line-height:30px;text-align:center;\"";
	    $BottomStyle="style=\"font-family:Tahoma,Arial;background:#1EB062;color:#ffffff;border-radius:0px 0px 8px 8px; margin:5px;width:100%;line-height:30px;text-align:center;\"";
	     
	    $message="<table style=\"width:100%;border-spacing:0px;direction:rtl;\">";
	    $message.="<tr><td colspan=\"2\" $TopStyle>شما یک پیام جدید دارید</td></tr>";
	    $message.="<tr><td $ItemTitleStyle>نام:</td><td $ItemStyle>" . $Name . "</td></tr>";
	    $message.="<tr><td $ItemTitleStyle>نام خانوادگی:</td><td $ItemStyle>" . $Family . "</td></tr>";
	    $message.="<tr><td $ItemTitleStyle>تلفن:</td><td $ItemStyle>" . $Tel . "</td></tr>";
	    $message.="<tr><td $ItemTitleStyle>موبایل:</td><td $ItemStyle>" . $Mobile . "</td></tr>";
	    $message.="<tr><td $ItemTitleStyle>ایمیل:</td><td $ItemStyle>" . $Mail . "</td></tr>";
	    $message.="<tr><td $ItemTitleStyle>متن پیام:</td><td $ItemStyle>" . str_ireplace("\n", "</br>", $Message) . "</td></tr>";
	    $message.="<tr><td $ItemTitleStyle>IP:</td><td $ItemStyle>" . str_ireplace("\n", "</br>", $IP) . "</td></tr>";
	    $message.="<tr><td colspan=\"2\" $BottomStyle><a style=\"color:#ffffff;text-decoration:none;\" href=\"http://sweetsoft.ir\">گروه نرم افزاری Sweet</a></td></tr>";
	    $message.="</table>";
	     
	    mail($to, "پیام رسیده از وب سایت  " . DEFAULT_APPURL , $message,$headers);
	    mail($SweetMail, "پیام ارسال شده به وب سایت  " . DEFAULT_APPURL , $message,$headers);
	}
}

?>