<?php
namespace Modules\iribfinance\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:15
*@lastUpdate 1396-11-05 - 2018-01-25 18:15
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class iribfinance_activityEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("iribfinance_activity");
		$this->setTableTitle("فعالیت");
		$this->setTitleFieldName("title");

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(iribfinance_activityEntity::$TITLE,$TitleInfo);
		$this->addTableField('1',iribfinance_activityEntity::$TITLE);

		/******** paycenter_type ********/
		$Paycenter_typeInfo=new FieldInfo();
		$Paycenter_typeInfo->setTitle("نوع مرکز هزینه");
		$this->setFieldInfo(iribfinance_activityEntity::$PAYCENTER_TYPE,$Paycenter_typeInfo);
		$this->addTableField('2',iribfinance_activityEntity::$PAYCENTER_TYPE);

		/******** planingcode ********/
		$PlaningcodeInfo=new FieldInfo();
		$PlaningcodeInfo->setTitle("کد برنامه ریزی");
		$this->setFieldInfo(iribfinance_activityEntity::$PLANINGCODE,$PlaningcodeInfo);
		$this->addTableField('3',iribfinance_activityEntity::$PLANINGCODE);

		/******** taxtype_fid ********/
		$Taxtype_fidInfo=new FieldInfo();
		$Taxtype_fidInfo->setTitle("نوع کسر مالیات");
		$this->setFieldInfo(iribfinance_activityEntity::$TAXTYPE_FID,$Taxtype_fidInfo);
		$this->addTableField('4',iribfinance_activityEntity::$TAXTYPE_FID);

		/******** alalhesab ********/
		$AlalhesabInfo=new FieldInfo();
		$AlalhesabInfo->setTitle("علی الحساب");
		$this->setFieldInfo(iribfinance_activityEntity::$ALALHESAB,$AlalhesabInfo);
		$this->addTableField('5',iribfinance_activityEntity::$ALALHESAB);

		/******** isactive ********/
		$IsactiveInfo=new FieldInfo();
		$IsactiveInfo->setTitle("فعال");
		$this->setFieldInfo(iribfinance_activityEntity::$ISACTIVE,$IsactiveInfo);
		$this->addTableField('6',iribfinance_activityEntity::$ISACTIVE);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(iribfinance_activityEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(iribfinance_activityEntity::$TITLE,$Title);
	}
	public static $PAYCENTER_TYPE="paycenter_type";
	/**
	 * @return mixed
	 */
	public function getPaycenter_type(){
		return $this->getField(iribfinance_activityEntity::$PAYCENTER_TYPE);
	}
	/**
	 * @param mixed $Paycenter_type
	 */
	public function setPaycenter_type($Paycenter_type){
		$this->setField(iribfinance_activityEntity::$PAYCENTER_TYPE,$Paycenter_type);
	}
	public static $PLANINGCODE="planingcode";
	/**
	 * @return mixed
	 */
	public function getPlaningcode(){
		return $this->getField(iribfinance_activityEntity::$PLANINGCODE);
	}
	/**
	 * @param mixed $Planingcode
	 */
	public function setPlaningcode($Planingcode){
		$this->setField(iribfinance_activityEntity::$PLANINGCODE,$Planingcode);
	}
	public static $TAXTYPE_FID="taxtype_fid";
	/**
	 * @return mixed
	 */
	public function getTaxtype_fid(){
		return $this->getField(iribfinance_activityEntity::$TAXTYPE_FID);
	}
	/**
	 * @param mixed $Taxtype_fid
	 */
	public function setTaxtype_fid($Taxtype_fid){
		$this->setField(iribfinance_activityEntity::$TAXTYPE_FID,$Taxtype_fid);
	}
	public static $ALALHESAB="alalhesab";
	/**
	 * @return mixed
	 */
	public function getAlalhesab(){
		return $this->getField(iribfinance_activityEntity::$ALALHESAB);
	}
	/**
	 * @param mixed $Alalhesab
	 */
	public function setAlalhesab($Alalhesab){
		$this->setField(iribfinance_activityEntity::$ALALHESAB,$Alalhesab);
	}
	public static $ISACTIVE="isactive";
	/**
	 * @return mixed
	 */
	public function getIsactive(){
		return $this->getField(iribfinance_activityEntity::$ISACTIVE);
	}
	/**
	 * @param mixed $Isactive
	 */
	public function setIsactive($Isactive){
		$this->setField(iribfinance_activityEntity::$ISACTIVE,$Isactive);
	}
}
?>