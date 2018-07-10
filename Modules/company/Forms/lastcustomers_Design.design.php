<?php

namespace Modules\company\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\SweetFrom;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\html\Image;
use core\CoreClasses\html\link;


/**
 *@author Hadi AmirNahavandi
 *@creationDate 2015/02/19 15:54:05
 *@lastUpdate 2015/02/19 15:54:05
 *@SweetFrameworkHelperVersion 1.102
*/


class lastcustomers_Design extends FormDesign {
    private $customers;
	/**
	 * @var TextBox
	 */
	
	/**
	 * @var DataComboBox
	 */
	
	/**
	 * @var SweetButton
	 */
	
	public function __construct()
	{
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setId("company_lastcustomers");
		$Page->addElement(new Lable(""));
		$Page->setClass("sweet_formtitle");
		$LTable1=new Div();
		
		for ($ci=0;$ci<count($this->customers);$ci++)
		{
		    $cimage=new Image(DEFAULT_PUBLICURL . $this->customers[$ci]['thumbnail']);
		    $cimage->setClass("company_lastcustomers_customerthumbnail");
		    $Link=new link($this->customers[$ci]['url'], $cimage);
		    $PTitle=new Div();
		    $PTitle->addElement(new Lable($this->customers[$ci]['title']));
		    $PTitle->setClass("company_lastcustomers_infotitle");
		    $customerInfo=new Div();
		    $customerInfo->setClass("company_lastcustomers_customer");
		    $customerInfo->addElement($Link);
		    $customerInfo->addElement($PTitle);
		    $LTable1->addElement($customerInfo);
		}
		
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}


    public function setCustomers($customers)
    {
        $this->customers = $customers;
    }
}
?>
