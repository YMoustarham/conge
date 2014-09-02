<?php
/**
 * Created by PhpStorm.
 * User: GreyFox
 * Date: 9/1/14
 * Time: 12:33 PM
 */

require_once '../modules/HolyDay.php';
require_once '../modules/DB_Manager.php';
require_once '../modules/Period.php';
require_once '../modules/smarty_config.php';
require_once '../modules/LitePeriod.php';
if(isset($_GET['from']) && isset($_GET['to']) && isset($_GET['days']) && isset($_GET['sun']) && isset($_GET['sat']))
{
    $fromDate = new DateTime($_GET['from']);
    $toDate = new DateTime($_GET['to']);

   // echo "calculation from :".$fromDate->format('Y-m-d')." to: ".$toDate->format('Y-m-d')."<br/>";

    $include_sun = ($_GET['sun']=='true')? true:false;
    $include_sat = ($_GET['sat']=='true')? true:false;
    $dayscount = intval($_GET['days']);
    $holydays;
    $resultData=array();


    //get the list of days between given dates
    $holydays =HolyDay::GetolyDays($fromDate,$toDate,$include_sat,$include_sun) ;
    foreach ($holydays as $hd) {
      //  $hd->show_as_text();
    }

    //get periods
    $periods = Period::GetPeriods($holydays,$dayscount,$include_sat,$include_sun) ;

    $longest;
    $cheapest;

    (Period::Filter($periods,$longest,$cheapest));

    $longestLite =array();
    $cheapestLite=array();
    foreach ($longest as $l)
    {
        $longestLite[]= LitePeriod::ExtractLiteVersion($l,true);
        $resultData[] = Period::getAsString($l);
    }

    foreach ($cheapest as $l)
    {
        $cheapestLite[]= LitePeriod::ExtractLiteVersion($l,true);
        $resultData[] = Period::getAsString($l);
    }

    //repakcing

    $pack = array('economique'=>$cheapestLite,'longue'=>$longestLite);
    echo json_encode($pack,true);



}


function getAll(DateTime $fromDate ,DateTime $toDate)
{

    $curentIndexdate=$fromDate;
    $cal=array();

    while($curentIndexdate!=$toDate)
    {
        $y = $curentIndexdate->format('Y');
        $m = $curentIndexdate->format('m');
        $d = $curentIndexdate->format('d');

        $cal[$y][$m][$d] = $d;
        $curentIndexdate->add(new DateInterval('P1D'));

    }

    return $cal;
}