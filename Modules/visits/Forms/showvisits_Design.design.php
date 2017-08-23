<?php 
namespace Modules\visits\Forms;
use core\CoreClasses\services\WidgetDesign;
class showvisits_Design extends WidgetDesign
{
	private $yearvisits;
	private $monthvisits;
	private $dayvisits;
	private $totalvisits;
	private $agehour;
	private $ageminute;
	private $agesecond;
	private $yesterdayvisits;
	private $yearTitle,$MonthTitle,$TotalTitle,$DayTitle,$YesterdayTitle,$BirthdayTitle;
	public function setAgehour($agehour)
	{
		$this->agehour=$agehour;
	}
	public function setAgeminute($ageminute)
	{
		$this->ageminute=$ageminute;
	}
	public function setAgesecond($agesecond)
	{
		$this->agesecond=$agesecond;
	}
	public function setYearvisits($yearvisits)
	{
		$this->yearvisits=$yearvisits;
	}
	public function setMonthvisits($monthvisits)
	{
		$this->monthvisits=$monthvisits;
	}
	public function setDayvisits($dayvisits)
	{
		$this->dayvisits=$dayvisits;
	}
	public function setYesterdayvisits($yesterdayvisits)
	{
		$this->yesterdayvisits=$yesterdayvisits;
	}
	public function setTotalvisits($totalvisits)
	{
		$this->totalvisits=$totalvisits;
	}
	public function getBodyHTML()
	{
		$res="<ul>";
		$res.= "<li>" . $this->DayTitle .  ":" .$this->dayvisits . "</li>"; 
		$res.="<li>" . $this->YesterdayTitle .  ":" .$this->yesterdayvisits . "</li>";
		$res.= "<li>" . $this->MonthTitle .  ":" .$this->monthvisits . "</li>"; 
		$res.= "<li>" . $this->yearTitle .  ":" .$this->yearvisits . "</li>"; 
		$res.= "<li>" . $this->TotalTitle .  ":" . $this->totalvisits . "</li>";
		$res.= "<li id='age' dir='rtl'></li>";  
		/*echo "<script language='javascript'>
		var hour=" . $this->agehour . ";
		var minute=" . $this->ageminute . ";
		var second=" . $this->agesecond . ";
		
		function startTimer()
		{
			second++;
			if(second==60)
			{
				second=0;
				minute++;
				if(minute==60)
				{
					minute=0;
					hour++;
				}
			}
			$('#age').html('عمر سایت:'+hour+'ساعت و'+minute+' دقیقه و'+second+' ثانیه');
		}
		setInterval(function (){startTimer()},1000);
		</script>";*/
		$res.= "</ul>";
		return $res;
	}

	public function setYearTitle($yearTitle)
	{
	    $this->yearTitle = $yearTitle;
	}

	public function setMonthTitle($MonthTitle)
	{
	    $this->MonthTitle = $MonthTitle;
	}

	public function setTotalTitle($TotalTitle)
	{
	    $this->TotalTitle = $TotalTitle;
	}

	public function setDayTitle($DayTitle)
	{
	    $this->DayTitle = $DayTitle;
	}

	public function setYesterdayTitle($YesterdayTitle)
	{
	    $this->YesterdayTitle = $YesterdayTitle;
	}

	public function setBirthdayTitle($BirthdayTitle)
	{
	    $this->BirthdayTitle = $BirthdayTitle;
	}
}


?>
