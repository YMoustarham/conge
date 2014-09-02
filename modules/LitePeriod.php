<?php
/**
 * Created by PhpStorm.
 * User: GreyFox
 * Date: 9/2/14
 * Time: 3:22 PM
 */
require_once 'LiteHolyday.php';
class LitePeriod
{
    public $From;
    public $To;
    public $Holydays;

    public function LitePeriod($from,$to,$holydays=null)
    {
        $this->From = $from;
        $this->To = $to;
        $this->Holydays = $holydays;
    }

    public static function ExtractLiteVersion(Period $period ,$only_holydays)
    {
        $From =$period->From->format('d-m-Y');
        $To =$period->To->format('d-m-Y');
        $holydays=array();
        foreach ($period->HolydaysList as $h)
        {
            if($only_holydays && $h->IsHolyday)
            {
            $holydays[] = LiteHolyday::ExtractLiteVersion($h);
            }
        }

        return new LitePeriod($From,$To,$holydays);
    }
} 