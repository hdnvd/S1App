<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\link;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;

/**
*@author Hadi AmirNahavandi
*@creationDate 1395-11-21 - 2017-02-09 01:49
*@lastUpdate 1395-11-21 - 2017-02-09 01:49
*@SweetFrameworkHelperVersion 2.000
*@SweetFrameworkVersion 1.017
*/
class managecarmodels_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	public function __construct()
	{
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("buysell_managecarmodels");
		$Page->addElement(new Lable("فهرست  مدل اتومبیل"));
		$Page->setClass("sweet_formtitle");
		$LTable1=new ListTable(2);
        $CMaks=$this->Data['carmodels'];
        for ($i=0;$i<count($CMaks);$i++)
        {
            $url=new AppRooter('buysell','managecarmodel');
            $url->addParameter(new UrlParameter('id',$CMaks[$i]['id']));
            $lbTit[$i]=new Lable($CMaks[$i]['title']);
            $liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
            $LTable1->addElement(new Lable($i+1));
            $LTable1->addElement($liTit[$i]);
        }
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
}
?>