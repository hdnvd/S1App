<?php

namespace Modules\gallery\Forms;

use core\CoreClasses\services\FormCode;
use Modules\gallery\Controllers\photoViewController;

/**
 *
 * @author nahavandi
 *        
 */
class showphoto_Code extends FormCode {
	private $photo;
	private $ShowTitle;
	public function __construct($namespace=null)
	{
		parent::__construct($namespace);
		$this->loadData();
		$this->setTitle($this->photo[0]['title']);
	}
	public function loadData()
	{
		$controller=new photoViewController();
		$ID=$_GET['id'];
		$result=$controller->getProduct($ID);
		$this->photo=$result['photo'];
		$this->ShowTitle=$result['showtitle'];
	}
	public function load()
	{
		
		$design=new showphoto_Design();
		$design->setPhoto($this->photo);
		$design->setShowTitle($this->ShowTitle);
		return $design->getBodyHTML();
		
	}
}

?>