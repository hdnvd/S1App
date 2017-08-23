<?php

namespace Modules\products\BusinessObjects;

use core\CoreClasses\services\BusinessObject;

/**
 *
 * @author nahavandi
 *        
 */
class productGroupLangBO extends BusinessObject {
	private $Title,$GroupID;
	public function __construct($Title,$GroupID)
	{
		$this->Title=$Title;
		$this->GroupID=$GroupID;
	}

	public function getTitle()
	{
	    return $this->Title;
	}

	public function getGroupID()
	{
	    return $this->GroupID;
	}
}

?>