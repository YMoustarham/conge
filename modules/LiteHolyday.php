<?php
/**
 * Created by PhpStorm.
 * User: GreyFox
 * Date: 9/2/14
 * Time: 3:22 PM
 */

class LiteHolyday
{
    public  $Date;
    public  $Name;
    public  $is_holyday;

    public  function LiteHolyday($date,$name,$is_holyday)
    {
        $this->Date= $date;
        $this->Name = $name;
        $this->is_holyday=$is_holyday;

    }
    public static function ExtractLiteVersion(HolyDay $holyday)
    {
        $date =$holyday->dateTime->format("d-m-Y");
        $name =$holyday->HolydayName;
        $is_holyday = $holyday->IsHolyday;
        return new LiteHolyday($date,$name,$is_holyday);
    }
} 