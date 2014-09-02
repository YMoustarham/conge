<?php
/**
 * Created by PhpStorm.
 * User: GreyFox
 * Date: 8/31/14
 * Time: 11:44 PM
 */
require_once 'DB_Manager.php';
class HolyDay
{
    public $IsHolyday=false;
    public $Date;
    public $HolydayName="";
    public $dateTime;

    public $NextIsHolyday = false;
    public $PreviousIsHolyday = false;
    public $Priority;

    public function show_as_text()
    {
        $data;
        if($this->IsHolyday)
        {
            $data="<b>". $this->HolydayName."</b>"." ".
            $this->dateTime->format('l d-m-Y')." ";

        }
        else
        {
            $data = "Normal day :)  ".
            $this->dateTime->format('l d-m-Y')." ";
        }
        echo($data."<br>");
    }

    public function HolyDay($dateTime)
    {
        $this->Date =intval( $dateTime->format('d') . $dateTime->format('m'));
        $this->dateTime = $dateTime;
    }

    public function ToHijri()
    {
       /* UmAlQuraCalendar uq = new UmAlQuraCalendar();
       DateTime dt = new DateTime(dateTime.Year, GetMonthFromInt(Date.ToString("D4")), GetDayFromInt(Date.ToString("D4")));

      // dt = DateTime.Now.AddDays(-1);

       return int.Parse( uq.GetDayOfMonth(dt).ToString("D2") + uq.GetMonth(dt).ToString("D2"));*/


    }

    public static function GetDayFromInt(string $date)
    {
        $d = $date.Remove(2, 2);
        return intval($d);
    }

    public static function GetMonthFromInt(string $date)
    {
        $d = date.Remove(0, 2);
        return intval($d);
    }

    public static function GetolyDays(DateTime $from, DateTime $to,$include_saturdays ,$include_sundays,  string &$output=null)
    {
        $holydays=array();
        $datediff = $from->diff( $to);
        $days = $datediff->days;



        $loopDate = $from;
        for ($i = 0; $i <= $days; $i++)
        {



            $holydays[] =DB::checkIsHolyday( new HolyDay(clone $loopDate),$include_saturdays,$include_sundays);

            $output = $output + $holydays[count($holydays) - 1]->Date . "<br>";
            $loopDate->add( new DateInterval('P1D'));
        }
        return $holydays;
    }
}
