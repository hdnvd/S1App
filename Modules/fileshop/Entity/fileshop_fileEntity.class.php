<?php
namespace Modules\fileshop\Entity;
use core\CoreClasses\db\DBField;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-10-28 - 2018-01-18 12:02
*@lastUpdate 1396-10-28 - 2018-01-18 12:02
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class fileshop_fileEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("fileshop_file");
		$this->setTableTitle("فایل");
		$this->setTitleFieldName("title");

		/******** file_flu ********/
		$File_fluInfo=new FieldInfo();
		$File_fluInfo->setTitle("فایل");
		$this->setFieldInfo(fileshop_fileEntity::$FILE_FLU,$File_fluInfo);
		$this->addTableField('1',fileshop_fileEntity::$FILE_FLU);

		/******** title ********/
		$TitleInfo=new FieldInfo();
		$TitleInfo->setTitle("عنوان");
		$this->setFieldInfo(fileshop_fileEntity::$TITLE,$TitleInfo);
		$this->addTableField('2',fileshop_fileEntity::$TITLE);

		/******** thumbnail_flu ********/
		$Thumbnail_fluInfo=new FieldInfo();
		$Thumbnail_fluInfo->setTitle("تصویر");
		$this->setFieldInfo(fileshop_fileEntity::$THUMBNAIL_FLU,$Thumbnail_fluInfo);
		$this->addTableField('3',fileshop_fileEntity::$THUMBNAIL_FLU);

		/******** add_date ********/
		$Add_dateInfo=new FieldInfo();
		$Add_dateInfo->setTitle("تاریخ افزودن");
		$this->setFieldInfo(fileshop_fileEntity::$ADD_DATE,$Add_dateInfo);
		$this->addTableField('4',fileshop_fileEntity::$ADD_DATE);

		/******** description ********/
		$DescriptionInfo=new FieldInfo();
		$DescriptionInfo->setTitle("توضیحات");
		$this->setFieldInfo(fileshop_fileEntity::$DESCRIPTION,$DescriptionInfo);
		$this->addTableField('5',fileshop_fileEntity::$DESCRIPTION);

		/******** price ********/
		$PriceInfo=new FieldInfo();
		$PriceInfo->setTitle("قیمت");
		$this->setFieldInfo(fileshop_fileEntity::$PRICE,$PriceInfo);
		$this->addTableField('6',fileshop_fileEntity::$PRICE);

		/******** filecount ********/
		$FilecountInfo=new FieldInfo();
		$FilecountInfo->setTitle("تعداد فایل موجود");
		$this->setFieldInfo(fileshop_fileEntity::$FILECOUNT,$FilecountInfo);
		$this->addTableField('7',fileshop_fileEntity::$FILECOUNT);

		/******** filetype_fid ********/
		$Filetype_fidInfo=new FieldInfo();
		$Filetype_fidInfo->setTitle("نوع فایل");
		$this->setFieldInfo(fileshop_fileEntity::$FILETYPE_FID,$Filetype_fidInfo);
		$this->addTableField('8',fileshop_fileEntity::$FILETYPE_FID);

		/******** role_systemuser_fid ********/
		$Role_systemuser_fidInfo=new FieldInfo();
		$Role_systemuser_fidInfo->setTitle("اضافه کننده");
		$this->setFieldInfo(fileshop_fileEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fidInfo);
		$this->addTableField('9',fileshop_fileEntity::$ROLE_SYSTEMUSER_FID);
	}
	public static $FILE_FLU="file_flu";
	/**
	 * @return mixed
	 */
	public function getFile_flu(){
		return $this->getField(fileshop_fileEntity::$FILE_FLU);
	}
	/**
	 * @param mixed $File_flu
	 */
	public function setFile_flu($File_flu){
		$this->setField(fileshop_fileEntity::$FILE_FLU,$File_flu);
	}
	public static $TITLE="title";
	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->getField(fileshop_fileEntity::$TITLE);
	}
	/**
	 * @param mixed $Title
	 */
	public function setTitle($Title){
		$this->setField(fileshop_fileEntity::$TITLE,$Title);
	}
	public static $THUMBNAIL_FLU="thumbnail_flu";
	/**
	 * @return mixed
	 */
	public function getThumbnail_flu(){
		return $this->getField(fileshop_fileEntity::$THUMBNAIL_FLU);
	}
	/**
	 * @param mixed $Thumbnail_flu
	 */
	public function setThumbnail_flu($Thumbnail_flu){
		$this->setField(fileshop_fileEntity::$THUMBNAIL_FLU,$Thumbnail_flu);
	}
	public static $ADD_DATE="add_date";
	/**
	 * @return mixed
	 */
	public function getAdd_date(){
		return $this->getField(fileshop_fileEntity::$ADD_DATE);
	}
	/**
	 * @param mixed $Add_date
	 */
	public function setAdd_date($Add_date){
		$this->setField(fileshop_fileEntity::$ADD_DATE,$Add_date);
	}
	public static $DESCRIPTION="description";
	/**
	 * @return mixed
	 */
	public function getDescription(){
		return $this->getField(fileshop_fileEntity::$DESCRIPTION);
	}
	/**
	 * @param mixed $Description
	 */
	public function setDescription($Description){
		$this->setField(fileshop_fileEntity::$DESCRIPTION,$Description);
	}
	public static $PRICE="price";
	/**
	 * @return mixed
	 */
	public function getPrice(){
		return $this->getField(fileshop_fileEntity::$PRICE);
	}
	/**
	 * @param mixed $Price
	 */
	public function setPrice($Price){
		$this->setField(fileshop_fileEntity::$PRICE,$Price);
	}
	public static $FILECOUNT="filecount";
	/**
	 * @return mixed
	 */
	public function getFilecount(){
		return $this->getField(fileshop_fileEntity::$FILECOUNT);
	}
	/**
	 * @param mixed $Filecount
	 */
	public function setFilecount($Filecount){
		$this->setField(fileshop_fileEntity::$FILECOUNT,$Filecount);
	}
	public static $FILETYPE_FID="filetype_fid";
	/**
	 * @return mixed
	 */
	public function getFiletype_fid(){
		return $this->getField(fileshop_fileEntity::$FILETYPE_FID);
	}
	/**
	 * @param mixed $Filetype_fid
	 */
	public function setFiletype_fid($Filetype_fid){
		$this->setField(fileshop_fileEntity::$FILETYPE_FID,$Filetype_fid);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(fileshop_fileEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(fileshop_fileEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}

	public function getCatPurchasedFiles($CatID,$SystemUserID)
    {
        $sq=$this->getDatabase()->Select("f.*");
        $sq=$sq->From(['fileshop_file f','finance_transaction tr','fileshop_filetransaction ft','fileshop_filecategory fc'])->Where()
            ->Smaller('f.deletetime','0')
            ->AndLogic()->Smaller('ft.deletetime','0')
            ->AndLogic()->Smaller('fc.deletetime','0')
            ->AndLogic()->Smaller('tr.deletetime','0');
        $sq->AndLogic()->Equal('ft.file_fid',new DBField('f.id',false));
        $sq->AndLogic()->Equal('fc.file_fid',new DBField('f.id',false));
        $sq->AndLogic()->Equal('ft.finance_transaction_fid',new DBField('tr.id',false));
        $sq->AndLogic()->Equal('tr.issuccessful','1');
        $sq->AndLogic()->Equal('tr.role_systemuser_fid',$SystemUserID);
        $sq->AndLogic()->Equal('fc.common_category_fid',$CatID);
        $res= $sq->ExecuteAssociated();
        $AllCount1 = count($res);
        $result=array();
        for ($i = 0; $i < $AllCount1; $i++) {
            $item=$res[$i];
            $obj=new fileshop_fileEntity($this->getDatabase()->getDBAccessor());
            $obj->loadFromArray($res[$i]);
            $result[$i]=$obj;
        }
        return $result;
    }
    public function getFileIsPurchased($FileID,$SystemUserID)
    {
        $sq=$this->getDatabase()->Select("*");
        $sq=$sq->From(['finance_transaction tr','fileshop_filetransaction ft'])->Where()
            ->Smaller('ft.deletetime','0')
            ->AndLogic()->Smaller('tr.deletetime','0');
        $sq->AndLogic()->Equal('ft.file_fid',$FileID);
        $sq->AndLogic()->Equal('ft.finance_transaction_fid',new DBField('tr.id',false));
        $sq->AndLogic()->Equal('tr.issuccessful','1');
        $sq->AndLogic()->Equal('tr.role_systemuser_fid',$SystemUserID);
//        echo $sq->getQueryString();
        $res= $sq->ExecuteAssociated();
        if($res==null || count($res)<=0) return false;
        return true;
    }
}
?>