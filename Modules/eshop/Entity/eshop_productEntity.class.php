<?php
namespace Modules\eshop\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-08-23 - 2017-11-14 18:40
*@lastUpdate 1396-08-23 - 2017-11-14 18:40
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class eshop_productEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("eshop_product");
		$this->setTableTitle("eshop_product");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("title");
		$this->setFieldInfo(eshop_productEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',eshop_productEntity::$TITLE);

		/******** latintitle ********/
		$LatintitleInfo=new FieldInfo();
		$LatintitleInfo->setTitle("latintitle");
		$this->setFieldInfo(eshop_productEntity::$LATINTITLE,$LatintitleInfo);
		$this->addTableField('2',eshop_productEntity::$LATINTITLE);

		/******** description ********/
		$DescriptionInfo=new FieldInfo();
		$DescriptionInfo->setTitle("description");
		$this->setFieldInfo(eshop_productEntity::$DESCRIPTION,$DescriptionInfo);
		$this->addTableField('3',eshop_productEntity::$DESCRIPTION);

		/******** pic1_flu ********/
		$Pic1_fluInfo=new FieldInfo();
		$Pic1_fluInfo->setTitle("pic1_flu");
		$this->setFieldInfo(eshop_productEntity::$PIC1_FLU,$Pic1_fluInfo);
		$this->addTableField('4',eshop_productEntity::$PIC1_FLU);

		/******** pic2_flu ********/
		$Pic2_fluInfo=new FieldInfo();
		$Pic2_fluInfo->setTitle("pic2_flu");
		$this->setFieldInfo(eshop_productEntity::$PIC2_FLU,$Pic2_fluInfo);
		$this->addTableField('5',eshop_productEntity::$PIC2_FLU);

		/******** pic3_flu ********/
		$Pic3_fluInfo=new FieldInfo();
		$Pic3_fluInfo->setTitle("pic3_flu");
		$this->setFieldInfo(eshop_productEntity::$PIC3_FLU,$Pic3_fluInfo);
		$this->addTableField('6',eshop_productEntity::$PIC3_FLU);

		/******** pic4_flu ********/
		$Pic4_fluInfo=new FieldInfo();
		$Pic4_fluInfo->setTitle("pic4_flu");
		$this->setFieldInfo(eshop_productEntity::$PIC4_FLU,$Pic4_fluInfo);
		$this->addTableField('7',eshop_productEntity::$PIC4_FLU);

		/******** price ********/
		$PriceInfo=new FieldInfo();
		$PriceInfo->setTitle("price");
		$this->setFieldInfo(eshop_productEntity::$PRICE,$PriceInfo);
		$this->addTableField('8',eshop_productEntity::$PRICE);

		/******** code ********/
		$CodeInfo=new FieldInfo();
		$CodeInfo->setTitle("code");
		$this->setFieldInfo(eshop_productEntity::$CODE,$CodeInfo);
		$this->addTableField('9',eshop_productEntity::$CODE);

		/******** adddate ********/
		$AdddateInfo=new FieldInfo();
		$AdddateInfo->setTitle("adddate");
		$this->setFieldInfo(eshop_productEntity::$ADDDATE,$AdddateInfo);
		$this->addTableField('10',eshop_productEntity::$ADDDATE);

		/******** visitcount ********/
		$VisitcountInfo=new FieldInfo();
		$VisitcountInfo->setTitle("visitcount");
		$this->setFieldInfo(eshop_productEntity::$VISITCOUNT,$VisitcountInfo);
		$this->addTableField('11',eshop_productEntity::$VISITCOUNT);

		/******** is_exists ********/
		$Is_existsInfo=new FieldInfo();
		$Is_existsInfo->setTitle("is_exists");
		$this->setFieldInfo(eshop_productEntity::$IS_EXISTS,$Is_existsInfo);
		$this->addTableField('12',eshop_productEntity::$IS_EXISTS);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(eshop_productEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(eshop_productEntity::$TITLE,$Title);
	}
	public static $LATINTITLE="latintitle";
	/**
	 * @return mixed
	 */
	public function getLatintitle(){
		return $this->getField(eshop_productEntity::$LATINTITLE);
	}
	/**
	 * @param mixed $Latintitle
	 */
	public function setLatintitle($Latintitle){
		$this->setField(eshop_productEntity::$LATINTITLE,$Latintitle);
	}
	public static $DESCRIPTION="description";
	/**
	 * @return mixed
	 */
	public function getDescription(){
		return $this->getField(eshop_productEntity::$DESCRIPTION);
	}
	/**
	 * @param mixed $Description
	 */
	public function setDescription($Description){
		$this->setField(eshop_productEntity::$DESCRIPTION,$Description);
	}
	public static $PIC1_FLU="pic1_flu";
	/**
	 * @return mixed
	 */
	public function getPic1_flu(){
		return $this->getField(eshop_productEntity::$PIC1_FLU);
	}
	/**
	 * @param mixed $Pic1_flu
	 */
	public function setPic1_flu($Pic1_flu){
		$this->setField(eshop_productEntity::$PIC1_FLU,$Pic1_flu);
	}
	public static $PIC2_FLU="pic2_flu";
	/**
	 * @return mixed
	 */
	public function getPic2_flu(){
		return $this->getField(eshop_productEntity::$PIC2_FLU);
	}
	/**
	 * @param mixed $Pic2_flu
	 */
	public function setPic2_flu($Pic2_flu){
		$this->setField(eshop_productEntity::$PIC2_FLU,$Pic2_flu);
	}
	public static $PIC3_FLU="pic3_flu";
	/**
	 * @return mixed
	 */
	public function getPic3_flu(){
		return $this->getField(eshop_productEntity::$PIC3_FLU);
	}
	/**
	 * @param mixed $Pic3_flu
	 */
	public function setPic3_flu($Pic3_flu){
		$this->setField(eshop_productEntity::$PIC3_FLU,$Pic3_flu);
	}
	public static $PIC4_FLU="pic4_flu";
	/**
	 * @return mixed
	 */
	public function getPic4_flu(){
		return $this->getField(eshop_productEntity::$PIC4_FLU);
	}
	/**
	 * @param mixed $Pic4_flu
	 */
	public function setPic4_flu($Pic4_flu){
		$this->setField(eshop_productEntity::$PIC4_FLU,$Pic4_flu);
	}
	public static $PRICE="price";
	/**
	 * @return mixed
	 */
	public function getPrice(){
		return $this->getField(eshop_productEntity::$PRICE);
	}
	/**
	 * @param mixed $Price
	 */
	public function setPrice($Price){
		$this->setField(eshop_productEntity::$PRICE,$Price);
	}
	public static $CODE="code";
	/**
	 * @return mixed
	 */
	public function getCode(){
		return $this->getField(eshop_productEntity::$CODE);
	}
	/**
	 * @param mixed $Code
	 */
	public function setCode($Code){
		$this->setField(eshop_productEntity::$CODE,$Code);
	}
	public static $ADDDATE="adddate";
	/**
	 * @return mixed
	 */
	public function getAdddate(){
		return $this->getField(eshop_productEntity::$ADDDATE);
	}
	/**
	 * @param mixed $Adddate
	 */
	public function setAdddate($Adddate){
		$this->setField(eshop_productEntity::$ADDDATE,$Adddate);
	}
	public static $VISITCOUNT="visitcount";
	/**
	 * @return mixed
	 */
	public function getVisitcount(){
		return $this->getField(eshop_productEntity::$VISITCOUNT);
	}
	/**
	 * @param mixed $Visitcount
	 */
	public function setVisitcount($Visitcount){
		$this->setField(eshop_productEntity::$VISITCOUNT,$Visitcount);
	}
	public static $IS_EXISTS="is_exists";
	/**
	 * @return mixed
	 */
	public function getIs_exists(){
		return $this->getField(eshop_productEntity::$IS_EXISTS);
	}
	/**
	 * @param mixed $Is_exists
	 */
	public function setIs_exists($Is_exists){
		$this->setField(eshop_productEntity::$IS_EXISTS,$Is_exists);
	}
}
?>