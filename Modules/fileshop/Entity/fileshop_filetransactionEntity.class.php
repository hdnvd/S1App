<?php
namespace Modules\fileshop\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-29 - 2018-01-19 13:06
*@lastUpdate 1396-10-29 - 2018-01-19 13:06
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class fileshop_filetransactionEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("fileshop_filetransaction");
		$this->setTableTitle("fileshop_filetransaction");
		$this->setTitleFieldName("id");

		/******** file_fid ********/
		$File_fidInfo=new FieldInfo();
		$File_fidInfo->setTitle("file_fid");
		$this->setFieldInfo(fileshop_filetransactionEntity::$FILE_FID,$File_fidInfo);
		$this->addTableField('1',fileshop_filetransactionEntity::$FILE_FID);

		/******** finance_transaction_fid ********/
		$Finance_transaction_fidInfo=new FieldInfo();
		$Finance_transaction_fidInfo->setTitle("finance_transaction_fid");
		$this->setFieldInfo(fileshop_filetransactionEntity::$FINANCE_TRANSACTION_FID,$Finance_transaction_fidInfo);
		$this->addTableField('2',fileshop_filetransactionEntity::$FINANCE_TRANSACTION_FID);
	}
	public static $FILE_FID="file_fid";
	/**
	 * @return mixed
	 */
	public function getFile_fid(){
		return $this->getField(fileshop_filetransactionEntity::$FILE_FID);
	}
	/**
	 * @param mixed $File_fid
	 */
	public function setFile_fid($File_fid){
		$this->setField(fileshop_filetransactionEntity::$FILE_FID,$File_fid);
	}
	public static $FINANCE_TRANSACTION_FID="finance_transaction_fid";
	/**
	 * @return mixed
	 */
	public function getFinance_transaction_fid(){
		return $this->getField(fileshop_filetransactionEntity::$FINANCE_TRANSACTION_FID);
	}
	/**
	 * @param mixed $Finance_transaction_fid
	 */
	public function setFinance_transaction_fid($Finance_transaction_fid){
		$this->setField(fileshop_filetransactionEntity::$FINANCE_TRANSACTION_FID,$Finance_transaction_fid);
	}
}
?>