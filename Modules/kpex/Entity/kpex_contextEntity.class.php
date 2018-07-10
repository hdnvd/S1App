<?php
namespace Modules\kpex\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-03-22 - 2018-06-12 15:31
*@lastUpdate 1397-03-22 - 2018-06-12 15:31
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class kpex_contextEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("kpex_context");
		$this->setTableTitle("متن");
		$this->setTitleFieldName("title");

		/******** created_at ********/
		$Created_atInfo=new FieldInfo();
		$Created_atInfo->setTitle("تاریخ ایجاد");
		$this->setFieldInfo(kpex_contextEntity::$CREATED_AT,$Created_atInfo);
		$this->addTableField('1',kpex_contextEntity::$CREATED_AT);

		/******** url ********/
		$UrlInfo=new FieldInfo();
		$UrlInfo->setTitle("آدرس");
		$this->setFieldInfo(kpex_contextEntity::$URL,$UrlInfo);
		$this->addTableField('2',kpex_contextEntity::$URL);

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(kpex_contextEntity::$TITLE,$TitleInfo);
		$this->addTableField('3',kpex_contextEntity::$TITLE);

		/******** content ********/
		$ContentInfo=new FieldInfo();
		$ContentInfo->setTitle("محتوا");
		$this->setFieldInfo(kpex_contextEntity::$CONTENT,$ContentInfo);
		$this->addTableField('4',kpex_contextEntity::$CONTENT);

		/******** updated_at ********/
		$Updated_atInfo=new FieldInfo();
		$Updated_atInfo->setTitle("تاریخ بروزرسانی");
		$this->setFieldInfo(kpex_contextEntity::$UPDATED_AT,$Updated_atInfo);
		$this->addTableField('5',kpex_contextEntity::$UPDATED_AT);

		/******** words ********/
		$WordsInfo=new FieldInfo();
		$WordsInfo->setTitle("کلمات");
		$this->setFieldInfo(kpex_contextEntity::$WORDS,$WordsInfo);
		$this->addTableField('6',kpex_contextEntity::$WORDS);
	}
	public static $CREATED_AT="created_at";
	/**
	 * @return mixed
	 */
	public function getCreated_at(){
		return $this->getField(kpex_contextEntity::$CREATED_AT);
	}
	/**
	 * @param mixed $Created_at
	 */
	public function setCreated_at($Created_at){
		$this->setField(kpex_contextEntity::$CREATED_AT,$Created_at);
	}
	public static $URL="url";
	/**
	 * @return mixed
	 */
	public function getUrl(){
		return $this->getField(kpex_contextEntity::$URL);
	}
	/**
	 * @param mixed $Url
	 */
	public function setUrl($Url){
		$this->setField(kpex_contextEntity::$URL,$Url);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(kpex_contextEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(kpex_contextEntity::$TITLE,$Title);
	}
	public static $CONTENT="content";
	/**
	 * @return mixed
	 */
	public function getContent(){
		return $this->getField(kpex_contextEntity::$CONTENT);
	}
	/**
	 * @param mixed $Content
	 */
	public function setContent($Content){
		$this->setField(kpex_contextEntity::$CONTENT,$Content);
	}
	public static $UPDATED_AT="updated_at";
	/**
	 * @return mixed
	 */
	public function getUpdated_at(){
		return $this->getField(kpex_contextEntity::$UPDATED_AT);
	}
	/**
	 * @param mixed $Updated_at
	 */
	public function setUpdated_at($Updated_at){
		$this->setField(kpex_contextEntity::$UPDATED_AT,$Updated_at);
	}
	public static $WORDS="words";
	/**
	 * @return mixed
	 */
	public function getWords(){
		return $this->getField(kpex_contextEntity::$WORDS);
	}
	/**
	 * @param mixed $Words
	 */
	public function setWords($Words){
		$this->setField(kpex_contextEntity::$WORDS,$Words);
	}
}
?>