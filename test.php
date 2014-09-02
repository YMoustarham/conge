<?php
/**
 * Created by PhpStorm.
 * User: GreyFox
 * Date: 9/1/14
 * Time: 12:33 PM
 */

require_once 'modules/HolyDay.php';
require_once 'modules/DB_Manager.php';
require_once 'modules/Period.php';
require_once 'modules/smarty_config.php';

$fromDate = new DateTime('2014-03-01');
$toDate = new DateTime('2014-03-31');

echo "calculation from :".$fromDate->format('Y-m-d')." to: ".$toDate->format('Y-m-d')."<br/>";


$holydays;


echo "<pre>";
$holydays =HolyDay::GetolyDays($fromDate,$toDate,true,true) ;
foreach ($holydays as $hd) {
    $hd->show_as_text();
}

$periods = Period::calculateDates($holydays,7,true,true) ;

$longest;
$cheapest;

(Period::Filter($periods,$longest,$cheapest));


foreach ($longest as $l)
{
    echo Period::getAsString($l);
}

foreach ($cheapest as $l)
{
    echo Period::getAsString($l);
}

echo"</pre>";


function getAll(DateTime $fromDate ,DateTime $toDate)
{

    $curentIndexdate=$fromDate;

    $cal=array();

    while($curentIndexdate!=$toDate)
    {
        $y = $curentIndexdate->format('Y');
        $m = $curentIndexdate->format('m');
        $d = $curentIndexdate->format('d');
        $hd =  new HolyDay($curentIndexdate);

        $hd = DB::checkIsHolyday($hd,true,true);
        $hd->dateTime = new DateTime($y.'-'.$m.'-'.$d);
        $cal[$y][$m][$d] = $hd;
        $holydays_out[]= $hd;
        $curentIndexdate->add(new DateInterval('P1D'));

    }

    return $holydays_out;
    //return $cal;
}
