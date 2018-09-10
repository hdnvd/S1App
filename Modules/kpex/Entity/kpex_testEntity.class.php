<?php
namespace Modules\kpex\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-06-17 - 2018-09-08 05:12
*@lastUpdate 1397-06-17 - 2018-09-08 05:12
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class kpex_testEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("kpex_test");
		$this->setTableTitle("kpex_test");
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

		/******** similarity_threshold ********/
		$Similarity_thresholdInfo=new FieldInfo();
		$Similarity_thresholdInfo->setTitle("similarity_threshold");
		$this->setFieldInfo(kpex_testEntity::$SIMILARITY_THRESHOLD,$Similarity_thresholdInfo);
		$this->addTableField('7',kpex_testEntity::$SIMILARITY_THRESHOLD);

		/******** similarity_influence ********/
		$Similarity_influenceInfo=new FieldInfo();
		$Similarity_influenceInfo->setTitle("similarity_influence");
		$this->setFieldInfo(kpex_testEntity::$SIMILARITY_INFLUENCE,$Similarity_influenceInfo);
		$this->addTableField('8',kpex_testEntity::$SIMILARITY_INFLUENCE);

		/******** resultcount ********/
		$ResultcountInfo=new FieldInfo();
		$ResultcountInfo->setTitle("resultcount");
		$this->setFieldInfo(kpex_testEntity::$RESULTCOUNT,$ResultcountInfo);
		$this->addTableField('9',kpex_testEntity::$RESULTCOUNT);

		/******** context_fid ********/
		$Context_fidInfo=new FieldInfo();
		$Context_fidInfo->setTitle("context_fid");
		$this->setFieldInfo(kpex_testEntity::$CONTEXT_FID,$Context_fidInfo);
		$this->addTableField('10',kpex_testEntity::$CONTEXT_FID);

		/******** description ********/
		$DescriptionInfo=new FieldInfo();
		$DescriptionInfo->setTitle("توضیحات");
		$this->setFieldInfo(kpex_testEntity::$DESCRIPTION,$DescriptionInfo);
		$this->addTableField('11',kpex_testEntity::$DESCRIPTION);

		/******** words ********/
		$WordsInfo=new FieldInfo();
		$WordsInfo->setTitle("کلمات");
		$this->setFieldInfo(kpex_testEntity::$WORDS,$WordsInfo);
		$this->addTableField('12',kpex_testEntity::$WORDS);

		/******** is_postaged ********/
		$Is_postagedInfo=new FieldInfo();
		$Is_postagedInfo->setTitle("is_postaged");
		$this->setFieldInfo(kpex_testEntity::$IS_POSTAGED,$Is_postagedInfo);
		$this->addTableField('13',kpex_testEntity::$IS_POSTAGED);

		/******** is_similarityedgeweighed ********/
		$Is_similarityedgeweighedInfo=new FieldInfo();
		$Is_similarityedgeweighedInfo->setTitle("is_similarityedgeweighed");
		$this->setFieldInfo(kpex_testEntity::$IS_SIMILARITYEDGEWEIGHED,$Is_similarityedgeweighedInfo);
		$this->addTableField('14',kpex_testEntity::$IS_SIMILARITYEDGEWEIGHED);

		/******** method_fid ********/
		$Method_fidInfo=new FieldInfo();
		$Method_fidInfo->setTitle("method_fid");
		$this->setFieldInfo(kpex_testEntity::$METHOD_FID,$Method_fidInfo);
		$this->addTableField('15',kpex_testEntity::$METHOD_FID);

		/******** apprate ********/
		$ApprateInfo=new FieldInfo();
		$ApprateInfo->setTitle("apprate");
		$this->setFieldInfo(kpex_testEntity::$APPRATE,$ApprateInfo);
		$this->addTableField('16',kpex_testEntity::$APPRATE);

		/******** precisionrate ********/
		$PrecisionrateInfo=new FieldInfo();
		$PrecisionrateInfo->setTitle("precisionrate");
		$this->setFieldInfo(kpex_testEntity::$PRECISIONRATE,$PrecisionrateInfo);
		$this->addTableField('17',kpex_testEntity::$PRECISIONRATE);

		/******** recall ********/
		$RecallInfo=new FieldInfo();
		$RecallInfo->setTitle("recall");
		$this->setFieldInfo(kpex_testEntity::$RECALL,$RecallInfo);
		$this->addTableField('18',kpex_testEntity::$RECALL);

		/******** fscore ********/
		$FscoreInfo=new FieldInfo();
		$FscoreInfo->setTitle("fscore");
		$this->setFieldInfo(kpex_testEntity::$FSCORE,$FscoreInfo);
		$this->addTableField('19',kpex_testEntity::$FSCORE);
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
	public static $SIMILARITY_THRESHOLD="similarity_threshold";
	/**
	 * @return mixed
	 */
	public function getSimilarity_threshold(){
		return $this->getField(kpex_testEntity::$SIMILARITY_THRESHOLD);
	}
	/**
	 * @param mixed $Similarity_threshold
	 */
	public function setSimilarity_threshold($Similarity_threshold){
		$this->setField(kpex_testEntity::$SIMILARITY_THRESHOLD,$Similarity_threshold);
	}
	public static $SIMILARITY_INFLUENCE="similarity_influence";
	/**
	 * @return mixed
	 */
	public function getSimilarity_influence(){
		return $this->getField(kpex_testEntity::$SIMILARITY_INFLUENCE);
	}
	/**
	 * @param mixed $Similarity_influence
	 */
	public function setSimilarity_influence($Similarity_influence){
		$this->setField(kpex_testEntity::$SIMILARITY_INFLUENCE,$Similarity_influence);
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
	public static $IS_SIMILARITYEDGEWEIGHED="is_similarityedgeweighed";
	/**
	 * @return mixed
	 */
	public function getIs_similarityedgeweighed(){
		return $this->getField(kpex_testEntity::$IS_SIMILARITYEDGEWEIGHED);
	}
	/**
	 * @param mixed $Is_similarityedgeweighed
	 */
	public function setIs_similarityedgeweighed($Is_similarityedgeweighed){
		$this->setField(kpex_testEntity::$IS_SIMILARITYEDGEWEIGHED,$Is_similarityedgeweighed);
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
	public static $PRECISIONRATE="precisionrate";
	/**
	 * @return mixed
	 */
	public function getPrecisionrate(){
		return $this->getField(kpex_testEntity::$PRECISIONRATE);
	}
	/**
	 * @param mixed $Precisionrate
	 */
	public function setPrecisionrate($Precisionrate){
		$this->setField(kpex_testEntity::$PRECISIONRATE,$Precisionrate);
	}
	public static $RECALL="recall";
	/**
	 * @return mixed
	 */
	public function getRecall(){
		return $this->getField(kpex_testEntity::$RECALL);
	}
	/**
	 * @param mixed $Recall
	 */
	public function setRecall($Recall){
		$this->setField(kpex_testEntity::$RECALL,$Recall);
	}
	public static $FSCORE="fscore";
	/**
	 * @return mixed
	 */
	public function getFscore(){
		return $this->getField(kpex_testEntity::$FSCORE);
	}
	/**
	 * @param mixed $Fscore
	 */
	public function setFscore($Fscore){
		$this->setField(kpex_testEntity::$FSCORE,$Fscore);
	}
}
?>