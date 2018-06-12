<?php
namespace Modules\sfman\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-07 - 2017-09-29 14:20
*@lastUpdate 1396-07-07 - 2017-09-29 14:20
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 1.018
*/
class sfman_pageinfoEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("sfman_pageinfo");
		$this->setTableTitle("اطلاعات صفحه");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
        $TitleInfo->setRequired(true);
        $TitleInfo->setMinLength(5);
        $TitleInfo->setMaxLength(50);
		$this->setFieldInfo(sfman_pageinfoEntity::$TITLE,$TitleInfo);

		/******** description ********/
		$DescriptionInfo=new FieldInfo();
		$DescriptionInfo->setTitle("توضیحات");
		$this->setFieldInfo(sfman_pageinfoEntity::$DESCRIPTION,$DescriptionInfo);

		/******** keywords ********/
		$KeywordsInfo=new FieldInfo();
		$KeywordsInfo->setTitle("کلمات کلیدی");
		$this->setFieldInfo(sfman_pageinfoEntity::$KEYWORDS,$KeywordsInfo);

		/******** themepage ********/
		$ThemepageInfo=new FieldInfo();
		$ThemepageInfo->setTitle("صفحه قالب");
		$ThemepageInfo->setRequired(true);
		$ThemepageInfo->setMinLength(5);
		$this->setFieldInfo(sfman_pageinfoEntity::$THEMEPAGE,$ThemepageInfo);

		/******** internalurl ********/
		$InternalurlInfo=new FieldInfo();
		$InternalurlInfo->setTitle("آدرس نسبی");
		$this->setFieldInfo(sfman_pageinfoEntity::$INTERNALURL,$InternalurlInfo);

		/******** canonicalurl ********/
		$CanonicalurlInfo=new FieldInfo();
		$CanonicalurlInfo->setTitle("آدرس canonical");
		$this->setFieldInfo(sfman_pageinfoEntity::$CANONICALURL,$CanonicalurlInfo);

		/******** sentenceinurl ********/
		$SentenceinurlInfo=new FieldInfo();
		$SentenceinurlInfo->setTitle("عبارت در آدرس");
		$this->setFieldInfo(sfman_pageinfoEntity::$SENTENCEINURL,$SentenceinurlInfo);
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
	public static $SENTENCEINURL="sentenceinurl";
	/**
	 * @return mixed
	 */
	public function getSentenceinurl(){
		return $this->getField(sfman_pageinfoEntity::$SENTENCEINURL);
	}
	/**
	 * @param mixed $Sentenceinurl
	 */
	public function setSentenceinurl($Sentenceinurl){
		$this->setField(sfman_pageinfoEntity::$SENTENCEINURL,$Sentenceinurl);
	}
}
?>