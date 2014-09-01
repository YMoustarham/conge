<?php
/**
 * Created by PhpStorm.
 * User: GreyFox
 * Date: 8/31/14
 * Time: 9:53 PM
 */
require_once 'DB_Manager.php';
class Period
{
public $From;
public $To;
public $FromAll;
public $ToAll;
public $FromHolyday;
public $ToHolyday;
public $Length=0 ;
public $Cost;
public $AddedDaysAfter = 0;
public $AddedDaysBefor = 0;
public function TotalLength() { return $this->Length + $this->AddedDaysAfter + $this->AddedDaysBefor;  }
public function Balance() {  return (float)($this->Cost)/ $this->TotalLength() ;  }
public $Priority;

public function Period($from, $to, $length,$cost, $addedDaysAfter,$addedDaysBefor)
{
    $this->From = clone $from->dateTime;
    $this->To = clone $to->dateTime;
    $tempFrom =clone $from->dateTime;
    $tempTo =clone $to->dateTime;
    $this->FromAll = $tempFrom->sub(new DateInterval('P'.$addedDaysBefor.'D'));
    $this->ToAll = $tempTo->add(new DateInterval('P'.abs($addedDaysBefor-1).'D'));
    $this->FromHolyday = $from;
    $this->ToHolyday = $to;

    $this->Length = $length;
    $this->Cost = $cost;
    $this->AddedDaysAfter = $addedDaysAfter;
    $this->AddedDaysBefor = $addedDaysBefor;


}

public static function getAsString($period)
{

    $data =
    "period starts from ("
    .$period->From->format('l')
    ." "
    .$period->From->format(" d-m-Y")
    .") and ends in ("
    .$period->To->format('l')
    ." "
    .$period->To->format(" d-m-Y")
    .") with a Cost of "
    .$period->Cost
    ." where you will get "
    .$period->TotalLength()
    ." days "
    ." Priority of "
    .$period->Priority
    ."<br>";

    return $data;
}

public static function calculateDates($holydaysList, $holydayLength)
{
    $list;

    for ($i = 0; $i < count($holydaysList) - $holydayLength; $i++)
    {
        $addedDaysBefor = 0;
        $addedDaysAfter = 0;
        $cost = 0;
        $length = 0;
        $priority = 0;
        for ($j = 0; $j < $holydayLength; $j++)
        {
            $length++;
            $priority += $holydaysList[$i + $j]->Priority;
            if ($holydaysList[$i + $j]->IsHolyday)
            {

            }
            else
            {
                $cost++;
            }
            if ($j == 0)
            {
                $hd = $holydaysList[$i + $j];
                $index = -1;
                while (DB::isNextPrevAHolyday( $hd, $index))
                {

                    $index--;
                    $addedDaysBefor++;
                }
            }
            else if ($j == $holydayLength - 1)
            {
                $hd = $holydaysList[$i + $j];
                $index = 1;
                while (DB::isNextPrevAHolyday( $hd, $index))
                {

                    $index++;
                    $addedDaysAfter++;
                }
            }

        }

        $list[] = new Period(clone $holydaysList[$i],clone $holydaysList[$i + $holydayLength-1], $length, $cost, $addedDaysAfter, $addedDaysBefor);
        $list[count( $list) - 1]->Priority = $priority;
    }

    return $list;
}

public static function Filter($Periods, &$longest, &$cheapest)
{
    $s = "";

     foreach ($Periods as $p)
    {
        if (count($longest) == 0 || $p->TotalLength() > $longest[0]->TotalLength() || ($p->TotalLength() == $longest[0]->TotalLength() && $longest[0]->Priority < $p->Priority))
        {
            $longest=[];
            $longest[] = $p;
        }
        else if (($p->TotalLength() == $longest[0]->TotalLength() && $longest[0]->Priority == $p->Priority))
        {
            $longest[] = $p;
        }

        if (count($cheapest) == 0 || $cheapest[0]->Priority < $p->Priority || ($cheapest[0]->Priority == $p->Priority && $p->TotalLength() > $cheapest[0]->TotalLength()))
        {
            $cheapest=[];
            $cheapest[]=$p;
        }
        else if ($cheapest[0]->Priority == $p->Priority && $p->TotalLength() == $cheapest[0]->TotalLength())
        {
            $cheapest[]=$p;
        }


       /* if (cheapest.Count == 0 || cheapest[0].Cost > p.Cost || (cheapest[0].Cost == p.Cost && p.TotalLength > cheapest[0].TotalLength))
        {
            cheapest.Clear();
            cheapest.Add(p);
        }
        else if (cheapest[0].Cost == p.Cost && p.TotalLength == cheapest[0].TotalLength)
        {
             cheapest.Add(p);
        }*/
      //  echo(self::getAsString(clone $p). "<br>");
       $s= $s . self::getAsString($p) . "<br>";
    }


     return $s;
}
}

