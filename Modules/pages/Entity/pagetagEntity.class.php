<?php

namespace Modules\pages\Entity;

/**
 *
 * @author Hadi Nahavandi
 * @version 0.1
 *        
 */
class pagetagEntity extends tagEntity {
	
	/**
	 */
	public function __construct($contentID) 
	{
		parent::__construct ($contentID );
		$this->setRelationTable("pagetag");
	}
}

?>