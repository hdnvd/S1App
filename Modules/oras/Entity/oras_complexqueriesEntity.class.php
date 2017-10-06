<?php
namespace Modules\oras\Entity;
use core\CoreClasses\db\DBField;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\services\FieldInfo;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\services\FieldType;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-12 - 2017-10-04 03:01
*@lastUpdate 1396-07-12 - 2017-10-04 03:01
*@SweetFrameworkHelperVersion 2.014
*@SweetFrameworkVersion 1.018
*/
class oras_complexqueriesEntity extends EntityClass {

	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
	}
    public function getEmployeePointsSum($EmployeeID,$PointSign=null)
    {
        $sq=$this->getPointQuery("sum(points) pointsum",$EmployeeID,$PointSign);
        return $sq->ExecuteAssociated();
    }
    public function getEmployeeRecordsCount($EmployeeID,$PointSign=null)
    {
        $sq=$this->getPointQuery("count(*) recordcount",$EmployeeID,$PointSign);
        return $sq->ExecuteAssociated();
    }
    private function getPointQuery($ResultFields,$EmployeeID,$PointSign=null)
    {
        $sq=$this->getDatabase()->Select($ResultFields)->From(array("oras_record rec","oras_recordtype rectp"))->Where()
            ->Smaller("rec.deletetime",1)->AndLogic()
            ->Smaller("rectp.deletetime","1")->AndLogic()
            ->Equal("rec.recordtype_fid",new DBField("rectp.id",false))->AndLogic()
            ->Equal("rec.employee_fid",$EmployeeID);
        if($PointSign!==null)
        {
            $sq=$sq->AndLogic();
            if($PointSign==0)
                $sq=$sq->Equal('points',0);
            if($PointSign<0)
                $sq=$sq->Smaller('points',0);
            if($PointSign>0)
                $sq=$sq->Bigger('points',0);
        }
        return $sq;
    }

}
?>