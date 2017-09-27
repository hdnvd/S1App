<?php
namespace Modules\sfman\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-06 - 2017-09-28 01:40
*@lastUpdate 1396-07-06 - 2017-09-28 01:40
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class sfman_pageinfoEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("sfman_pageinfo");
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(sfman_pageinfoEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(sfman_pageinfoEntity::$TITLE,$Title);
	}
	public static $DESCRIPTION="description";
	/**
	 * @return mixed
	 */
	public function getDescription(){
		return $this->getField(sfman_pageinfoEntity::$DESCRIPTION);
	}
	/**
	 * @param mixed $Description
	 */
	public function setDescription($Description){
		$this->setField(sfman_pageinfoEntity::$DESCRIPTION,$Description);
	}
	public static $KEYWORDS="keywords";
	/**
	 * @return mixed
	 */
	public function getKeywords(){
		return $this->getField(sfman_pageinfoEntity::$KEYWORDS);
	}
	/**
	 * @param mixed $Keywords
	 */
	public function setKeywords($Keywords){
		$this->setField(sfman_pageinfoEntity::$KEYWORDS,$Keywords);
	}
	public static $THEMEPAGE="themepage";
	/**
	 * @return mixed
	 */
	public function getThemepage(){
		return $this->getField(sfman_pageinfoEntity::$THEMEPAGE);
	}
	/**
	 * @param mixed $Themepage
	 */
	public function setThemepage($Themepage){
		$this->setField(sfman_pageinfoEntity::$THEMEPAGE,$Themepage);
	}
	public static $INTERNALURL="internalurl";
	/**
	 * @return mixed
	 */
	public function getInternalurl(){
		return $this->getField(sfman_pageinfoEntity::$INTERNALURL);
	}
	/**
	 * @param mixed $Internalurl
	 */
	public function setInternalurl($Internalurl){
		$this->setField(sfman_pageinfoEntity::$INTERNALURL,$Internalurl);
	}
	public static $CANONICALURL="canonicalurl";
	/**
	 * @return mixed
	 */
	public function getCanonicalurl(){
		return $this->getField(sfman_pageinfoEntity::$CANONICALURL);
	}
	/**
	 * @param mixed $Canonicalurl
	 */
	public function setCanonicalurl($Canonicalurl){
		$this->setField(sfman_pageinfoEntity::$CANONICALURL,$Canonicalurl);
	}
}
?>