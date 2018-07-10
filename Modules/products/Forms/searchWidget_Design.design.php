<?php

namespace Modules\products\Forms;

use core\CoreClasses\services\WidgetDesign;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\Button;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\form;
use Modules\common\PublicClasses\AppRooter;

/**
 *
 * @author nahavandi
 *        
 */
class searchWidget_Design extends WidgetDesign {
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\WidgetDesign::getBodyHTML()
	 *
	 */
	public function getBodyHTML() {
		
		$textBox=new TextBox("searchtext");
		$searchbutton=new Button(true,"","searchbtn","searchbtn");
		$table=new ListTable(2);
		$table->addElement($textBox);
		$table->addElement($searchbutton);
		$linkObj=new AppRooter("products", "");
	    $linkObj->setFileFormat("");
		$link=$linkObj->getAbsoluteURL();
		$form=new form($link, "GET", $table);
		return $form;
	}
}

?>