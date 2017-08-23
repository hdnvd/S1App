<?php
namespace Modules\visits\Forms;
use core\CoreClasses\services\WidgetCode;
use Modules\visits\PublicClasses\stat;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\languages\PublicClasses\LanguageTranslator;
class showvisits_Code extends WidgetCode
{
	public function load()
	{
		$LangName=CurrentLanguageManager::getCurrentLanguageName();
		$Translator=new LanguageTranslator();
		$Translator->setLanguageName($LangName);
		
		
		$design=new showvisits_Design();
		$stat=new stat("system");
		$stat->updateStats();
		$design->setDayvisits($stat->getTodayVisits());
		$design->setYesterdayvisits($stat->getYesterdayVisits());
		$design->setMonthvisits($stat->getMonthVisits());
		$design->setYearvisits($stat->getYearVisits());
		$design->setTotalvisits($stat->getTotalVisits());
		
		$LangName=CurrentLanguageManager::getCurrentLanguageName();
		$design->setTotalTitle($Translator->getWordTranslation("totalvisits"));
		$design->setYearTitle($Translator->getWordTranslation("yearvisits"));
		$design->setMonthTitle($Translator->getWordTranslation("monthvisits"));
		$design->setDayTitle($Translator->getWordTranslation("dayvisits"));
		$design->setYesterdayTitle($Translator->getWordTranslation("yesterdayvisits"));
		
		
		
		$age=$stat->getBirthday();
		$design->setAgehour($age['hours']);
		$design->setAgeminute($age['minutes']);
		$design->setAgesecond($age['seconds']);
		return $design->getBodyHTML();
	}
}


?> 
