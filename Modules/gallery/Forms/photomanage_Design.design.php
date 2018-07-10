<?php

namespace Modules\gallery\Forms;

use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\link;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;

/**
 *
 * @author nahavandi
 *        
 */
class photomanage_Design extends FormDesign {
	
	private $photos;
	/**
	 * (non-PHPdoc)
	 *
	 * @see \core\CoreClasses\services\FormDesign::getBodyHTML()
	 *
	 */
	public function getBodyHTML($command = "load") {
		
		$table=new ListTable(6);
		$table->setId("photomanage_list");
		$table->addElement(new Lable("#"));
		$table->setLastElementClass("photomanage_listhead");
		$table->addElement(new Lable("عنوان"));
		$table->setLastElementClass("photomanage_listhead");
		$table->addElement(new Lable("عملیات"),4);
		$table->setLastElementClass("photomanage_listhead");
		$AllCount=count($this->photos);
		for($i=$AllCount-1;$i>=0;$i--)
		{
		    $ispublished=false;
		    if($this->photos[$i]['ppublishdate']>999 && $this->photos[$i]['ppublishdate']<time())
		        $ispublished=true;
			$tmpElement=new Lable($AllCount-$i);
			$table->addElement($tmpElement);
			$table->setLastElementClass("photomanage_list_photonumber");
			
			$deleteLink=new AppRooter("gallery", "deletephoto");
			$deleteLink->addParameter(new UrlParameter("id", $this->photos[$i]['photoid']));
			$editLink=new AppRooter("gallery", "addphoto");
			$editLink->addParameter(new UrlParameter("id", $this->photos[$i]['photoid']));
			$publishLink=new AppRooter("gallery", "addphoto");
			$publishLink->addParameter(new UrlParameter("id", $this->photos[$i]['photoid']));
			$publishLink->addParameter(new UrlParameter("changepublish", "1"));
			$viewLink=new AppRooter("gallery", "showphoto");
			$viewLink->addParameter(new UrlParameter("id", $this->photos[$i]['photoid']));
			if($this->photos[$i]['phototitle']=="")
				$this->photos[$i]['phototitle']="بدون عنوان";
			$tmpElement1=new Lable($this->photos[$i]['phototitle']);
			$tmpLink1=new link($editLink->getAbsoluteURL(), $tmpElement1);
			$table->addElement($tmpLink1);
			$table->setLastElementClass("photomanage_list_phototitle");
			
			$tmpElement2=new Lable("ویرایش");
			$tmpLink2=new link($editLink->getAbsoluteURL(), $tmpElement2);
			$table->addElement($tmpLink2);
			$table->setLastElementClass("photomanage_list_photoedit");
			
			$tmpElement5=new Lable("انتشار");
			if($ispublished)
			    $tmpElement5->setText("عدم انتشار");
			$tmpLink5=new link($publishLink->getAbsoluteURL(), $tmpElement5);
			$table->addElement($tmpLink5);
			if($ispublished)
			    $table->setLastElementClass("photomanage_list_photounpublish");
			else 
			    $table->setLastElementClass("photomanage_list_photopublish");
			
			$tmpElement3=new Lable("مشاهده");
			$tmpLink3=new link($viewLink->getAbsoluteURL(), $tmpElement3);
			$table->addElement($tmpLink3);
			$table->setLastElementClass("photomanage_list_photoview");
			
			$tmpElement4=new Lable("حذف");
			$tmpLink4=new link($deleteLink->getAbsoluteURL(), $tmpElement4);
			$table->addElement($tmpLink4);
			$table->setLastElementClass("photomanage_list_photodelete");
			
			
			
		}
		return $table;
	}

	public function setPhotos($photos)
	{
	    $this->photos = $photos;
	}
}

?>