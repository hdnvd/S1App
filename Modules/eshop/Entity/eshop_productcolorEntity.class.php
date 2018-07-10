<?php
namespace Modules\eshop\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-08-26 - 2017-11-17 22:11
*@lastUpdate 1396-08-26 - 2017-11-17 22:11
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class eshop_productcolorEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("eshop_productcolor");
		$this->setTableTitle("eshop_productcolor");
		$this->setTitleFieldName("id");

		/******** product_fid ********/
		$Product_fidInfo=new FieldInfo();
		$Product_fidInfo->setTitle("product_fid");
		$this->setFieldInfo(eshop_productcolorEntity::$PRODUCT_FID,$Product_fidInfo);
		$this->addTableField('1',eshop_productcolorEntity::$PRODUCT_FID);

		/******** color_fid ********/
		$Color_fidInfo=new FieldInfo();
		$Color_fidInfo->setTitle("color_fid");
		$this->setFieldInfo(eshop_productcolorEntity::$COLOR_FID,$Color_fidInfo);
		$this->addTableField('2',eshop_productcolorEntity::$COLOR_FID);
	}
	public static $PRODUCT_FID="product_fid";
	/**
	 * @return mixed
	 */
	public function getProduct_fid(){
		return $this->getField(eshop_productcolorEntity::$PRODUCT_FID);
	}
	/**
	 * @param mixed $Product_fid
	 */
	public function setProduct_fid($Product_fid){
		$this->setField(eshop_productcolorEntity::$PRODUCT_FID,$Product_fid);
	}
	public static $COLOR_FID="color_fid";
	/**
	 * @return mixed
	 */
	public function getColor_fid(){
		return $this->getField(eshop_productcolorEntity::$COLOR_FID);
	}
	/**
	 * @param mixed $Color_fid
	 */
	public function setColor_fid($Color_fid){
		$this->setField(eshop_productcolorEntity::$COLOR_FID,$Color_fid);
	}
}
?>