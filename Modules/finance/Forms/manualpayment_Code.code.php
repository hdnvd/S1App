<?php
namespace Modules\finance\Forms;
use core\CoreClasses\services\FormCode;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\finance\Controllers\manualpaymentController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-06-15 - 2017-09-06 16:47
*@lastUpdate 1396-06-15 - 2017-09-06 16:47
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class manualpayment_Code extends FormCode {

    private $Data;
    private $Description=null;

    /**
     * @param null $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
    }
    private $PageTitle="پرداخت الکترونیکی";
    /**
     * @param string $PageTitle
     */
    public function setPageTitle($PageTitle)
    {
        $this->PageTitle = $PageTitle;
    }

    /**
     * @param bool $DisplayManualInfo
     */
    public function setDisplayManualInfo($DisplayManualInfo)
    {
        $this->DisplayManualInfo = $DisplayManualInfo;
    }
    private $DisplayManualInfo=true;
	public function load()
	{
		$manualpaymentController=new manualpaymentController();
		$translator=new ModuleTranslator("finance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$Result=$manualpaymentController->load($this->getID());
		$design=new manualpayment_Design();
		$design->setDisplayManualInfo($this->DisplayManualInfo);
		$design->setPageTitle($this->PageTitle);
		$design->setData($Result);
		$design->setMessage("");
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
		catch(\Exception $uex){
			$design=new message_Design();
			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
		}
		return $design->getBodyHTML();
	}
	public function getID()
	{
		$id=-1;
		if(isset($_GET['id']))
			$id=$_GET['id'];
		return $id;
	}
	public function txtPay_Click()
	{
		$manualpaymentController=new manualpaymentController();
		$translator=new ModuleTranslator("finance");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		$design=new manualpayment_Design();
        $design->setDisplayManualInfo($this->DisplayManualInfo);
        $design->setPageTitle($this->PageTitle);
		$txtName=$design->getTxtName()->getValue();
		$txtFamily=$design->getTxtFamily()->getValue();
		$txtTel=$design->getTxtTel()->getValue();
		$txtDescription=$design->getTxtDescription()->getValue();
		if($this->Description!=null)
		    $txtDescription=$this->Description;
		$txtAmount=$design->getTxtAmount()->getValue();
		$user=null;
        $pass=null;
		if(isset($_GET['username']))
        {

            $user=$_GET['username'];
            $pass=$_GET['password'];
            $Result=$manualpaymentController->TxtPay($this->getID(),$txtName,$txtFamily,$txtTel,$txtDescription,$txtAmount,$user,$pass);

        }
		else
            $Result=$manualpaymentController->TxtPay($this->getID(),$txtName,$txtFamily,$txtTel,$txtDescription,$txtAmount);

        if($Result['payinfo']['transaction']['id']>0)
        {
//            echo "Hi";
            $url=new AppRooter("finance","epayment");
            $url->addParameter(new UrlParameter("id",$Result['payinfo']['transaction']['id']));
            AppRooter::redirect($url->getAbsoluteURL());
//            AppRooter::redirect("http://asriran.com");
        }
		$design->setData($Result);
		$design->setMessage("در حال انتقال به صفحه پرداخت");
		return $design->getBodyHTML();
	}
}
?>