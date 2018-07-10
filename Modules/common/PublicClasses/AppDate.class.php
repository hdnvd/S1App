<?php

namespace Modules\common\PublicClasses;

use core\CoreClasses\SweetDate;
/**
 *
 * @author nahavandi
 *        
 */
class AppDate {
	public static function now()
	{
		date_default_timezone_set("UTC");
		$date = new SweetDate(true, true, 'Asia/Tehran');
		return $date->date("Y-m-d H:i",false,false);
	}
    public static function CNow()
    {
        date_default_timezone_set("UTC");
        $date = new SweetDate(true, false, 'Asia/Tehran');
        return $date->date("Y-m-d H:i",false,false);
    }
	public static function today()
	{
		date_default_timezone_set("UTC");
		$date = new SweetDate(true, true, 'Asia/Tehran');
		return $date->date("Y-m-d",false,false);
	}
}

?>