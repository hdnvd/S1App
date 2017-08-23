<?php
namespace Modules\buysell\Entity;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-05-25 - 2017-08-16 01:15
*@lastUpdate 1396-05-25 - 2017-08-16 01:15
*@SweetFrameworkHelperVersion 2.001
*@SweetFrameworkVersion 1.018
*/
class buysell_carEntity extends EntityClass {
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("buysell_car");
	}


    public function FindAll(QueryLogic $QueryObject)
    {
        $resFields="*";
        if($QueryObject->getResultFields()!=null)
        {
            $fields=$QueryObject->getResultFields();
            $resFields=$fields[0];
            for($i=1;$i<count($fields);$i++)
                $resFields.="," . $fields[$i];
        }
        $SelectQuery=$this->getDatabase()->Select(array($resFields))->From([$this->getTableName(),'buysell_carmodel cm','buysell_carmaker cmaker'])->Where()->Equal("cm.id",new DBField($this->getTableName() . '.carmodel_fid',true))->AndLogic()->Equal("cmaker.id",new DBField('cm.carmaker_fid',false));
        $this->setSelectQuery($SelectQuery);
        $this->fillSelectParams($QueryObject);

        $SelectQuery=$this->getSelectQuery();
//        echo $SelectQuery->getQueryString() . "\n";
//        die();
        $results= $SelectQuery->ExecuteAssociated();
        $Objects=array();
        for($i=0;$i<count($results);$i++)
        {
            $class=get_class($this);
            $Objects[$i]=new $class($this->getDatabase()->getDBAccessor(),$this->getTableName());
            $Objects[$i]->loadFromArray($results[$i]);

        }
        return $Objects;
    }
    /**
     * @param QueryLogic $QueryObject
     * @return int
     */
    public function FindAllCount(QueryLogic $QueryObject)
    {
        $resFields="count(*) c";
        $SelectQuery=$this->getDatabase()->Select(array($resFields))->From([$this->getTableName(),'buysell_carmodel cm','buysell_carmaker cmaker'])->Where()->Equal("cm.id",new DBField($this->getTableName() . '.carmodel_fid',true))->AndLogic()->Equal("cmaker.id",new DBField('cm.carmaker_fid',false));
        $this->setSelectQuery($SelectQuery);
        $this->fillSelectParams($QueryObject);
        $SelectQuery=$this->getSelectQuery();
        //echo $SelectQuery->getQueryString();
        $results= $SelectQuery->ExecuteAssociated();
        if($results==null || !is_array($results) || count($results)<=0)
            return 0;
        else
            return $results[0]['c'];
    }
	public static $DETAILS="details";
	/**
	 * @return mixed
	 */
	public function getDetails(){
		return $this->getField(buysell_carEntity::$DETAILS);
	}
	/**
	 * @param mixed $Details
	 */
	public function setDetails($Details){
		$this->setField(buysell_carEntity::$DETAILS,$Details);
	}
	public static $PRICE="price";
	/**
	 * @return mixed
	 */
	public function getPrice(){
		return $this->getField(buysell_carEntity::$PRICE);
	}
	/**
	 * @param mixed $Price
	 */
	public function setPrice($Price){
		$this->setField(buysell_carEntity::$PRICE,$Price);
	}
	public static $ADDDATE="adddate";
	/**
	 * @return mixed
	 */
	public function getAdddate(){
		return $this->getField(buysell_carEntity::$ADDDATE);
	}
	/**
	 * @param mixed $Adddate
	 */
	public function setAdddate($Adddate){
		$this->setField(buysell_carEntity::$ADDDATE,$Adddate);
	}
	public static $BODY_CARCOLOR_FID="body_carcolor_fid";
	/**
	 * @return mixed
	 */
	public function getBody_carcolor_fid(){
		return $this->getField(buysell_carEntity::$BODY_CARCOLOR_FID);
	}
	/**
	 * @param mixed $Body_carcolor_fid
	 */
	public function setBody_carcolor_fid($Body_carcolor_fid){
		$this->setField(buysell_carEntity::$BODY_CARCOLOR_FID,$Body_carcolor_fid);
	}
	public static $INNER_CARCOLOR_FID="inner_carcolor_fid";
	/**
	 * @return mixed
	 */
	public function getInner_carcolor_fid(){
		return $this->getField(buysell_carEntity::$INNER_CARCOLOR_FID);
	}
	/**
	 * @param mixed $Inner_carcolor_fid
	 */
	public function setInner_carcolor_fid($Inner_carcolor_fid){
		$this->setField(buysell_carEntity::$INNER_CARCOLOR_FID,$Inner_carcolor_fid);
	}
	public static $PAYTYPE_FID="paytype_fid";
	/**
	 * @return mixed
	 */
	public function getPaytype_fid(){
		return $this->getField(buysell_carEntity::$PAYTYPE_FID);
	}
	/**
	 * @param mixed $Paytype_fid
	 */
	public function setPaytype_fid($Paytype_fid){
		$this->setField(buysell_carEntity::$PAYTYPE_FID,$Paytype_fid);
	}
	public static $CARTYPE_FID="cartype_fid";
	/**
	 * @return mixed
	 */
	public function getCartype_fid(){
		return $this->getField(buysell_carEntity::$CARTYPE_FID);
	}
	/**
	 * @param mixed $Cartype_fid
	 */
	public function setCartype_fid($Cartype_fid){
		$this->setField(buysell_carEntity::$CARTYPE_FID,$Cartype_fid);
	}
	public static $USAGECOUNT="usagecount";
	/**
	 * @return mixed
	 */
	public function getUsagecount(){
		return $this->getField(buysell_carEntity::$USAGECOUNT);
	}
	/**
	 * @param mixed $Usagecount
	 */
	public function setUsagecount($Usagecount){
		$this->setField(buysell_carEntity::$USAGECOUNT,$Usagecount);
	}
	public static $ROLE_SYSTEMUSER_FID="role_systemuser_fid";
	/**
	 * @return mixed
	 */
	public function getRole_systemuser_fid(){
		return $this->getField(buysell_carEntity::$ROLE_SYSTEMUSER_FID);
	}
	/**
	 * @param mixed $Role_systemuser_fid
	 */
	public function setRole_systemuser_fid($Role_systemuser_fid){
		$this->setField(buysell_carEntity::$ROLE_SYSTEMUSER_FID,$Role_systemuser_fid);
	}
	public static $WHERETODATE="wheretodate";
	/**
	 * @return mixed
	 */
	public function getWheretodate(){
		return $this->getField(buysell_carEntity::$WHERETODATE);
	}
	/**
	 * @param mixed $Wheretodate
	 */
	public function setWheretodate($Wheretodate){
		$this->setField(buysell_carEntity::$WHERETODATE,$Wheretodate);
	}
	public static $CARBODYSTATUS_FID="carbodystatus_fid";
	/**
	 * @return mixed
	 */
	public function getCarbodystatus_fid(){
		return $this->getField(buysell_carEntity::$CARBODYSTATUS_FID);
	}
	/**
	 * @param mixed $Carbodystatus_fid
	 */
	public function setCarbodystatus_fid($Carbodystatus_fid){
		$this->setField(buysell_carEntity::$CARBODYSTATUS_FID,$Carbodystatus_fid);
	}
	public static $MAKEDATE="makedate";
	/**
	 * @return mixed
	 */
	public function getMakedate(){
		return $this->getField(buysell_carEntity::$MAKEDATE);
	}
	/**
	 * @param mixed $Makedate
	 */
	public function setMakedate($Makedate){
		$this->setField(buysell_carEntity::$MAKEDATE,$Makedate);
	}
	public static $CARSTATUS_FID="carstatus_fid";
	/**
	 * @return mixed
	 */
	public function getCarstatus_fid(){
		return $this->getField(buysell_carEntity::$CARSTATUS_FID);
	}
	/**
	 * @param mixed $Carstatus_fid
	 */
	public function setCarstatus_fid($Carstatus_fid){
		$this->setField(buysell_carEntity::$CARSTATUS_FID,$Carstatus_fid);
	}
	public static $SHASITYPE_FID="shasitype_fid";
	/**
	 * @return mixed
	 */
	public function getShasitype_fid(){
		return $this->getField(buysell_carEntity::$SHASITYPE_FID);
	}
	/**
	 * @param mixed $Shasitype_fid
	 */
	public function setShasitype_fid($Shasitype_fid){
		$this->setField(buysell_carEntity::$SHASITYPE_FID,$Shasitype_fid);
	}





	public static $ISAUTOGEARBOX="isautogearbox";
	/**
	 * @return mixed
	 */
	public function getIsautogearbox(){
		return $this->getField(buysell_carEntity::$ISAUTOGEARBOX);
	}
	/**
	 * @param mixed $Isautogearbox
	 */
	public function setIsautogearbox($Isautogearbox){
		$this->setField(buysell_carEntity::$ISAUTOGEARBOX,$Isautogearbox);
	}
	public static $CARMODEL_FID="carmodel_fid";
	/**
	 * @return mixed
	 */
	public function getCarmodel_fid(){
		return $this->getField(buysell_carEntity::$CARMODEL_FID);
	}
	/**
	 * @param mixed $Carmodel_fid
	 */
	public function setCarmodel_fid($Carmodel_fid){
		$this->setField(buysell_carEntity::$CARMODEL_FID,$Carmodel_fid);
	}
	public static $CARTAGTYPE_FID="cartagtype_fid";
	/**
	 * @return mixed
	 */
	public function getCartagtype_fid(){
		return $this->getField(buysell_carEntity::$CARTAGTYPE_FID);
	}
	/**
	 * @param mixed $Cartagtype_fid
	 */
	public function setCartagtype_fid($Cartagtype_fid){
		$this->setField(buysell_carEntity::$CARTAGTYPE_FID,$Cartagtype_fid);
	}
	public static $CARENTITYTYPE_FID="carentitytype_fid";
	/**
	 * @return mixed
	 */
	public function getCarentitytype_fid(){
		return $this->getField(buysell_carEntity::$CARENTITYTYPE_FID);
	}
	/**
	 * @param mixed $Carentitytype_fid
	 */
	public function setCarentitytype_fid($Carentitytype_fid){
		$this->setField(buysell_carEntity::$CARENTITYTYPE_FID,$Carentitytype_fid);
	}
}
?>