<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 2/17/2018
 * Time: 9:45 AM
 */

namespace Modules\sfman\Controllers;


class Translator
{
private $Translations;
    public function __construct()
    {
        $this->Translations=[
            'title'=>'عنوان',
            'role'=>'سمت',
            'name'=>'نام',
            'family'=>'نام خانوادگی',
            'ismale'=>'جنسیت',
            'ismarried'=>'وضعیت تاهل',
            'shsh'=>'شماره شناسنامه',
            'mellicode'=>'کد ملی',
            'fathername'=>'نام پدر',
            'latintitle'=>'عنوان لاتین',
            'paycenter'=>'مرکز هزینه',
            'group'=>'گروه',
            'type'=>'عنوان',
            'isactive'=>'فعال/غیرفعال',
            'activity'=>'فعالیت',
            'bank'=>'بانک',
            'chapter'=>'سرفصل',
            'accountingcode'=>'کد حسابداری',
            'employee'=>'کارکنان',
            'class'=>'طبقات برنامه سازی',
            'prosperityfunds'=>'صندوق رفاه',
            'shshserial'=>'سریال شناسنامه',
            'personelcode'=>'کد پرسنلی',
            'employmenttype'=>'نوع بکارگیری',
            'born_date'=>'تاریخ تولد',
            'childcount'=>'تعداد فرزندان',
            'mobile'=>'موبایل',
            'tel'=>'تلفن',
            'address'=>'آدرس',
            'zipcode'=>'کدپستی',
            'accountnumber'=>'شماره حساب',
            'cardnumber'=>'شماره کارت',
            'isneededinsurance'=>'نیاز به بیمه',
            'education'=>'تحصیلات',
            'nationality'=>'ملیت',
            'common_city'=>'شهر',
            'is_payable'=>'قابل پرداخت',
            'passportnumber'=>'شماره پاسپورت',
            'passportserial'=>'شماره سریال پاسپورت',
            'entrance_date'=>'تاریخ ورود',
            'visatype'=>'نوع ویزا',
            'employmentcode'=>'کد استخدام',
            'visaexpire_date'=>'تاریخ انقضا ویزا',
            'internationalemployee'=>'کارکنان غیر ایرانی',
            'iranianemployee'=>'کارکنان ایرانی',
        ];
    }
    public function getPersian($Word,$DefaultValue)
    {
        $Word=trim(strtolower($Word));
        if(strlen($Word)>4 && substr($Word,strlen($Word)-4)=="_fid")
        {
            $Word=substr($Word,0,strlen($Word)-4);
        }

        if(key_exists($Word,$this->Translations))
            return $this->Translations[$Word];
        return $DefaultValue;
    }
}