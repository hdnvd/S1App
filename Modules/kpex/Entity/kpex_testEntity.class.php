<?php
namespace Modules\kpex\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-03-29 - 2018-06-19 14:15
*@lastUpdate 1397-03-29 - 2018-06-19 14:15
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class kpex_testEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("kpex_test");
		$this->setTableTitle("تست");
		$this->setTitleFieldName("id");

		/******** created_at ********/
		$Created_atInfo=new FieldInfo();
		$Created_atInfo->setTitle("تاریخ ایجاد");
		$this->setFieldInfo(kpex_testEntity::$CREATED_AT,$Created_atInfo);
		$this->addTableField('1',kpex_testEntity::$CREATED_AT);

		/******** updated_at ********/
		$Updated_atInfo=new FieldInfo();
		$Updated_atInfo->setTitle("تاریخ بروزرسانی");
		$this->setFieldInfo(kpex_testEntity::$UPDATED_AT,$Updated_atInfo);
		$this->addTableField('2',kpex_testEntity::$UPDATED_AT);

		/******** nouninfluence ********/
		$NouninfluenceInfo=new FieldInfo();
		$NouninfluenceInfo->setTitle("nouninfluence");
		$this->setFieldInfo(kpex_testEntity::$NOUNINFLUENCE,$NouninfluenceInfo);
		$this->addTableField('3',kpex_testEntity::$NOUNINFLUENCE);

		/******** nounoutinfluence ********/
		$NounoutinfluenceInfo=new FieldInfo();
		$NounoutinfluenceInfo->setTitle("nounoutinfluence");
		$this->setFieldInfo(kpex_testEntity::$NOUNOUTINFLUENCE,$NounoutinfluenceInfo);
		$this->addTableField('4',kpex_testEntity::$NOUNOUTINFLUENCE);

		/******** adjectiveinfluence ********/
		$AdjectiveinfluenceInfo=new FieldInfo();
		$AdjectiveinfluenceInfo->setTitle("adjectiveinfluence");
		$this->setFieldInfo(kpex_testEntity::$ADJECTIVEINFLUENCE,$AdjectiveinfluenceInfo);
		$this->addTableField('5',kpex_testEntity::$ADJECTIVEINFLUENCE);

		/******** adjectiveoutinfluence ********/
		$AdjectiveoutinfluenceInfo=new FieldInfo();
		$AdjectiveoutinfluenceInfo->setTitle("adjectiveoutinfluence");
		$this->setFieldInfo(kpex_testEntity::$ADJECTIVEOUTINFLUENCE,$AdjectiveoutinfluenceInfo);
		$this->addTableField('6',kpex_testEntity::$ADJECTIVEOUTINFLUENCE);

		/******** resultcount ********/
		$ResultcountInfo=new FieldInfo();
		$ResultcountInfo->setTitle("resultcount");
		$this->setFieldInfo(kpex_testEntity::$RESULTCOUNT,$ResultcountInfo);
		$this->addTableField('7',kpex_testEntity::$RESULTCOUNT);

		/******** context_fid ********/
		$Context_fidInfo=new FieldInfo();
		$Context_fidInfo->setTitle("context_fid");
		$this->setFieldInfo(kpex_testEntity::$CONTEXT_FID,$Context_fidInfo);
		$this->addTableField('8',kpex_testEntity::$CONTEXT_FID);

		/******** description ********/
		$DescriptionInfo=new FieldInfo();
		$DescriptionInfo->setTitle("توضیحات");
		$this->setFieldInfo(kpex_testEntity::$DESCRIPTION,$DescriptionInfo);
		$this->addTableField('9',kpex_testEntity::$DESCRIPTION);

		/******** words ********/
		$WordsInfo=new FieldInfo();
		$WordsInfo->setTitle("کلمات");
		$this->setFieldInfo(kpex_testEntity::$WORDS,$WordsInfo);
		$this->addTableField('10',kpex_testEntity::$WORDS);

		/******** is_postaged ********/
		$Is_postagedInfo=new FieldInfo();
		$Is_postagedInfo->setTitle("is_postaged");
		$this->setFieldInfo(kpex_testEntity::$IS_POSTAGED,$Is_postagedInfo);
		$this->addTableField('11',kpex_testEntity::$IS_POSTAGED);

		/******** method_fid ********/
		$Method_fidInfo=new FieldInfo();
		$Method_fidInfo->setTitle("method_fid");
		$this->setFieldInfo(kpex_testEntity::$METHOD_FID,$Method_fidInfo);
		$this->addTableField('12',kpex_testEntity::$METHOD_FID);

		/******** apprate ********/
		$ApprateInfo=new FieldInfo();
		$ApprateInfo->setTitle("امتیاز نرم افزار");
		$this->setFieldInfo(kpex_testEntity::$APPRATE,$ApprateInfo);
		$this->addTableField('13',kpex_testEntity::$APPRATE);
	}
	public static $CREATED_AT="created_at";
	/**
	 * @return mixed
	 */
	public function getCreated_at(){
		return $this->getField(kpex_testEntity::$CREATED_AT);
	}
	/**
	 * @param mixed $Created_at
	 */
	public function setCreated_at($Created_at){
		$this->setField(kpex_testEntity::$CREATED_AT,$Created_at);
	}
	public static $UPDATED_AT="updated_at";
	/**
	 * @return mixed
	 */
	public function getUpdated_at(){
		return $this->getField(kpex_testEntity::$UPDATED_AT);
	}
	/**
	 * @param mixed $Updated_at
	 */
	public function setUpdated_at($Updated_at){
		$this->setField(kpex_testEntity::$UPDATED_AT,$Updated_at);
	}
	public static $NOUNINFLUENCE="nouninfluence";
	/**
	 * @return mixed
	 */
	public function getNouninfluence(){
		return $this->getField(kpex_testEntity::$NOUNINFLUENCE);
	}
	/**
	 * @param mixed $Nouninfluence
	 */
	public function setNouninfluence($Nouninfluence){
		$this->setField(kpex_testEntity::$NOUNINFLUENCE,$Nouninfluence);
	}
	public static $NOUNOUTINFLUENCE="nounoutinfluence";
	/**
	 * @return mixed
	 */
	public function getNounoutinfluence(){
		return $this->getField(kpex_testEntity::$NOUNOUTINFLUENCE);
	}
	/**
	 * @param mixed $Nounoutinfluence
	 */
	public function setNounoutinfluence($Nounoutinfluence){
		$this->setField(kpex_testEntity::$NOUNOUTINFLUENCE,$Nounoutinfluence);
	}
	public static $ADJECTIVEINFLUENCE="adjectiveinfluence";
	/**
	 * @return mixed
	 */
	public function getAdjectiveinfluence(){
		return $this->getField(kpex_testEntity::$ADJECTIVEINFLUENCE);
	}
	/**
	 * @param mixed $Adjectiveinfluence
	 */
	public function setAdjectiveinfluence($Adjectiveinfluence){
		$this->setField(kpex_testEntity::$ADJECTIVEINFLUENCE,$Adjectiveinfluence);
	}
	public static $ADJECTIVEOUTINFLUENCE="adjectiveoutinfluence";
	/**
	 * @return mixed
	 */
	public function getAdjectiveoutinfluence(){
		return $this->getField(kpex_testEntity::$ADJECTIVEOUTINFLUENCE);
	}
	/**
	 * @param mixed $Adjectiveoutinfluence
	 */
	public function setAdjectiveoutinfluence($Adjectiveoutinfluence){
		$this->setField(kpex_testEntity::$ADJECTIVEOUTINFLUENCE,$Adjectiveoutinfluence);
	}
	public static $RESULTCOUNT="resultcount";
	/**
	 * @return mixed
	 */
	public function getResultcount(){
		return $this->getField(kpex_testEntity::$RESULTCOUNT);
	}
	/**
	 * @param mixed $Resultcount
	 */
	public function setResultcount($Resultcount){
		$this->setField(kpex_testEntity::$RESULTCOUNT,$Resultcount);
	}
	public static $CONTEXT_FID="context_fid";
	/**
	 * @return mixed
	 */
	public function getContext_fid(){
		return $this->getField(kpex_testEntity::$CONTEXT_FID);
	}
	/**
	 * @param mixed $Context_fid
	 */
	public function setContext_fid($Context_fid){
		$this->setField(kpex_testEntity::$CONTEXT_FID,$Context_fid);
	}
	public static $DESCRIPTION="description";
	/**
	 * @return mixed
	 */
	public function getDescription(){
		return $this->getField(kpex_testEntity::$DESCRIPTION);
	}
	/**
	 * @param mixed $Description
	 */
	public function setDescription($Description){
		$this->setField(kpex_testEntity::$DESCRIPTION,$Description);
	}
	public static $WORDS="words";
	/**
	 * @return mixed
	 */
	public function getWords(){
		return $this->getField(kpex_testEntity::$WORDS);
	}
	/**
	 * @param mixed $Words
	 */
	public function setWords($Words){
		$this->setField(kpex_testEntity::$WORDS,$Words);
	}
	public static $IS_POSTAGED="is_postaged";
	/**
	 * @return mixed
	 */
	public function getIs_postaged(){
		return $this->getField(kpex_testEntity::$IS_POSTAGED);
	}
	/**
	 * @param mixed $Is_postaged
	 */
	public function setIs_postaged($Is_postaged){
		$this->setField(kpex_testEntity::$IS_POSTAGED,$Is_postaged);
	}
	public static $METHOD_FID="method_fid";
	/**
	 * @return mixed
	 */
	public function getMethod_fid(){
		return $this->getField(kpex_testEntity::$METHOD_FID);
	}
	/**
	 * @param mixed $Method_fid
	 */
	public function setMethod_fid($Method_fid){
		$this->setField(kpex_testEntity::$METHOD_FID,$Method_fid);
	}
	public static $APPRATE="apprate";
	/**
	 * @return mixed
	 */
	public function getApprate(){
		return $this->getField(kpex_testEntity::$APPRATE);
	}
	/**
	 * @param mixed $Apprate
	 */
	public function setApprate($Apprate){
		$this->setField(kpex_testEntity::$APPRATE,$Apprate);
	}
}
?>