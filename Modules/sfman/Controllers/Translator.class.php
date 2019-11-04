<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 2/17/2018
 * Time: 9:45 AM
 */

namespace Modules\sfman\Controllers;
use Stichoza\GoogleTranslate\GoogleTranslate;


class Translator
{
private $Translations;
    public function __construct()
    {
        $this->Translations=[
            'title'=>'عنوان',
            'day'=>'روز',
            'factor'=>'ضریب',
            'role'=>'سمت',
            'name'=>'نام',
            'latinname'=>'نام لاتین',
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
            'active'=>'فعال/غیرفعال',
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
            'city'=>'شهر',
            'province'=>'استان',
            'is_payable'=>'قابل پرداخت',
            'passportnumber'=>'شماره پاسپورت',
            'passportserial'=>'شماره سریال پاسپورت',
            'entrance_date'=>'تاریخ ورود',
            'visatype'=>'نوع ویزا',
            'employmentcode'=>'کد استخدام',
            'visaexpire_date'=>'تاریخ انقضا ویزا',
            'internationalemployee'=>'کارکنان غیر ایرانی',
            'iranianemployee'=>'کارکنان ایرانی',
            'hesabno'=>'شماره حساب',
            'branch'=>'شعبه',
            'nationalcode'=>'کد ملی',
            'personelno'=>'کد پرسنلی',
            'birthplace'=>'محل تولد',
            'certificationnumber'=>'شماره شناسنامه',
            'gender'=>'جنسیت',
            'birth_date'=>'تاریخ تولد',
            'hmeli'=>'شماره حساب بانک ملی',
            'vlu'=>'مقدار',
            'tag'=>'تگ',
            'readonly'=>'وضعیت',
            'unit'=>'بخش',
            'subject'=>'موضوع',
            'answertext'=>'متن پاسخ',
            'questiontext'=>'متن سوال',
            'degree'=>'درجه',
            'orderserial'=>'کد رهگیری',
            'sendertel'=>'تلفن ارسال کننده',
            'messagereceiver'=>'دریافت کننده پیام',
            'sendername'=>'نام ارسال کننده',
            'devicetype'=>'نوع سخت افزار',
            'post'=>'مطلب',
            'summary'=>'خلاصه',
            'content'=>'محتوا',
            'thumbnail'=>'تصویر شاخص',
            'code'=>'شماره سریال',
            'needssecurityacceptance'=>'نیاز به تایید حفاظت اطلاعات',
            'mother__requesttype'=>'نوع درخواست مادر',
            'requesttype'=>'نوع درخواست',
            'priority'=>'اولویت',
            'commited'=>'به اتمام رسیده',
            'successful'=>'اتمام موفق',
            'needsadminapproval'=>'نیاز به تایید مدیر',
            'req'=>'درخواست',
            'sendtonext'=>'ارجاع به دیگری',
            'setstatus'=>'ثبت وضعیت',
            'changepriority'=>'تغییر اولویت',
            'user__user'=>'کاربر',
            'admin__user'=>'مدیر',
            'source__unit'=>'بخش مبدا',
            'destination__unit'=>'بخش مقصد(بعدی)',
            'security__user'=>'حفاظت',
            'note'=>'یادداشت',
            'owner__unit'=>'بخش مالک',
            'device'=>'تجهیز',
            'component'=>'قطعه',
            'attachment'=>'ضمیمه',
            'status'=>'وضعیت',
            'sender__unit'=>'بخش ارسال کننده',
            'current__unit'=>'بخش فعلی',
            'adminacceptance'=>'تایید مدیر',
            'securityacceptance'=>'تایید حفاظت',
            'fullsend'=>'ارسال نهایی',
            'letternumber'=>'شماره نامه',
            'letter'=>'نامه',
            'logo'=>'لوگو',
            'unittype'=>'نوع بخش',
            'sender__user'=>'کاربر ارسال کننده',
            'request'=>'درخواست',
            'description'=>'توضیحات',
            'hardwareneeded'=>'نیازمند ثبت سخت افزار',
            'backuptel'=>'تلفن شماره ۲',
            'backupmobile'=>'تلفن همراه شماره ۲',
            'email'=>'ایمیل',
            'photo'=>'تصویر',
            'nationalcard'=>'تصویر کارت ملی',
            'area'=>'منطقه',
            'placeman_area'=>'منطقه',
            'shabacode'=>'کد شبا',
            'areatype'=>'بافت',
            'roomcount'=>'تعداد اتاق',
            'capacity'=>'ظرفیت به نفر',
            'maxguests'=>'حداکثر تعداد مهمان',
            'structurearea'=>'متراژ بنا',
            'totalarea'=>'متراژ کل',
            'placeman_place'=>'محل',
            'addedbyowner'=>'دارای سند مالکیت به نام کاربر',
            'viewtype'=>'چشم انداز',
            'structuretype'=>'نوع ساختمان',
            'fulltimeservice'=>'تحویل ۲۴ ساعته',
            'timestart'=>'تحویل/تخلیه',
            'owningtype'=>'نوع اقامتگاه',
            'documentphoto'=>'سند مالکیت',
            'latitude'=>'عرض جغرافیایی',
            'longitude'=>'طول جغرافیایی',
            'visits'=>'تعداد بازدید',
            'price'=>'قیمت',
            'villa'=>'ویلا',
            'orderstatus'=>'وضعیت سفارش',
            'order'=>'سفارش',
            'start'=>'شروع',
            'duration'=>'مدت',
            'user'=>'کاربر',
            'amount'=>'مقدار',
            'transaction'=>'تراکنش',
            'reservefinancetransaction'=>'تراکنش',
            'transactionid'=>'کد تراکنش',
            'normalprice'=>'قیمت در روزهای عادی',
            'holidayprice'=>'قیمت در روزهای تعطیل',
            'weeklyoff'=>'تخفیف رزرو بیش از یک هفته',
            'monthlyoff'=>'تخفیف رزرو بیش از یک ماه',
        ];
    }
    public function getPersian($Word,$DefaultValue)
    {
        $Word=trim(strtolower($Word));
        $Result="";
        if(strlen($Word)>5)
        {
            $LastPart=substr($Word,strlen($Word)-4);
            $LastPart2=substr($Word,strlen($Word)-5);
            $LastPart3=substr($Word,strlen($Word)-3);
            $Prefix1=substr($Word,0,2);
            $Prefix2=substr($Word,0,3);
            $Prefix3=substr($Word,0,4);
            if($LastPart=="_fid" || $LastPart=="_flu" || $LastPart=="_igu")
            {
                $Word=substr($Word,0,strlen($Word)-4);
            }
            if($LastPart3=="_id")
            {
                $Word=substr($Word,0,strlen($Word)-3);
            }
            if($LastPart=="_num" || $LastPart=="_prc" || $LastPart=="_int")
            {
                $Word=substr($Word,0,strlen($Word)-4);
            }
            if($LastPart2=="_bnum")
            {
                $Word=substr($Word,0,strlen($Word)-5);
//                $Result=$Result."زمان ";
            }
            if($LastPart=="_clk")
            {
                $Word=substr($Word,0,strlen($Word)-4);
                $Result=$Result."زمان ";
            }
            if($LastPart2=="_time")
            {
                $Word=substr($Word,0,strlen($Word)-5);
                $Result=$Result."زمان ";
            }
            if($LastPart2=="_date")
            {
                $Word=substr($Word,0,strlen($Word)-5);
                $Result=$Result."تاریخ ";
            }
            if($LastPart3=="_te")
            {
                $Word=substr($Word,0,strlen($Word)-3);
            }
            if($Prefix3=="can_")
            {
                $Word=substr($Word,4);
                $Result=$Result."قابلیت ";
            }

            elseif($Prefix2=="is_")
                $Word=substr($Word,3);
            elseif($Prefix1=="is")
                $Word=substr($Word,2);
        }
        if(key_exists($Word,$this->Translations)){
//            echo $Word . ":".$this->Translations[$Word]."<br>";
            return $Result . $this->Translations[$Word];
        }
        else
        {
            try {
                $translate = new GoogleTranslate();
                $translate->setSource(); // Translate from English
                $translate->setTarget('fa'); // Translate to Georgian
                return $translate->translate($Word);
            }catch (\Exception $ex){}
        }
//        echo $Word . " Has No Translation<br>";
        return $DefaultValue;
    }
}