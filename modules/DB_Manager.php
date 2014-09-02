<?php
/**
 * User: Yassine Moustarham
 * Date: 8/30/14
 * Time: 1:02 PM
 */
require_once 'HolyDay.php';

class DB
{
    public static $Logs = 'none';
    public static  $connection;

    public static function ConnectDB()
    {
        if (!isset(self::$connection))
        {
            self::$connection = new PDO('mysql:host=localhost; dbname=agenda','root','toor',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $Logs =  'just connected<br>';
            return  true;
        }
        else
        {
            $Logs = 'already connected<br>';
        }
        return false;
    }

    public static function add_user($id,$first_name,$last_name,$email,$gender,$tel,$birthday,&$Logs=NULL)
    {
        self::ConnectDB();
        if (isset(self::$connection))
        {


            $sql = "SELECT id FROM users WHERE id = '$id'";
            if(self::$connection->query($sql)->rowCount()>=1)
            {
                $Logs = "User Alredy Exist";
            }
            else

            {
                $signup_date =  date('Y-m-d H:i:s');

                $birthday = DateTime::createFromFormat('m/d/Y',$birthday)->format('Y-m-d');

                //checking values
                $tel = (isset($tel))? "$tel" : null;
                $birthday = (isset($birthday))? "$birthday" : null;
                $email = (isset($email))? "$email" : null;

                $sql = "INSERT INTO users (id ,first_name ,last_name ,email,gender,tel,birthday,signup_date) VALUES ('$id','$first_name','$last_name',?,'$gender',?,?,'$signup_date')";
                $p = self::$connection->prepare($sql);

                if($p->execute(array($email,$tel,$birthday)))
                {
                    $Logs = "user added :) <br>";
                    return true;
                }
                else
                {
                    $Logs = "user not added  :( <br>" .(self::$connection->errorInfo())."<br>";
                }
            }
        }
        else
        {
            $Logs = "connection Error";
        }
        return false;
    }
    //check if is a registred user(for loggin)
    public static function check_user($id,&$output=null)
    {
        self::ConnectDB();
        if (isset(self::$connection))
        {
            $sql = "SELECT * FROM users WHERE id = '$id' ";
            $Logs = "<br>".$sql."<br>";
            $q = self::$connection->query($sql);
            if($q)
            {
                if($q->rowCount()>=1)
                {
                    if ($output!=null)
                    {
                        $output = $q;
                    }
                    $Logs = "your are a user";
                    return  true;
                }
                else
                {
                    $Logs = "you are not a user";

                }
            }
            else
            {
                $Logs = self::$connection->errorInfo();
            }
        }
        else
        {
            $Logs = "connection Error";
        }
        return  false;
    }
    //check if twoo fields exsit in a row
    public static function is_fields_linked($table_name ,$field1,$field2,$value1,$value2,&$output=null)
    {
        self::ConnectDB();
        if (isset(self::$connection))
        {
            $sql = "SELECT * FROM $table_name WHERE $field1 = '$value1' AND $field2 = '$value2'";
            $Logs = "<br>".$sql."<br>";
            $q = self::$connection->query($sql);
            if($q)
            {
                if($q->rowCount()>=1)
                {
                    if($output!=null)
                    {
                        $output = $q;
                    }
                    return true;
                }

            }
            else
            {
                $Logs = self::$connection->errorInfo() ;
            }
        }
        else
        {
            $Logs = "connection Error";
        }
        print_r(  $Logs);
        return  false;
    }
    //check if a day match a holy day and return a new hly dy object containing holyday name(s) and new state
    public  static  function checkIsHolyday($holyday,$include_saturdays,$include_sundays)
    {

        self::ConnectDB();
        if (isset(self::$connection))
        {
            $sql = "SELECT * FROM test_national WHERE date = '$holyday->Date' ";
            $Logs = "<br>".$sql."<br>";
            $q = self::$connection->query($sql);
            if($q)
            {
                if($q->rowCount()>=1)
                {
                    $data = $q->fetch();
                    $holyday->HolydayName = $data['name'];
                    $holyday->IsHolyday = true;
                    $holyday->Priority = 3;
                }
                else
                {


                }
            }
            else
            {
                $Logs = self::$connection->errorInfo();
            }
        }
        else
        {
            $Logs = "connection Error";
        }

        if (($holyday->dateTime->format('w') == 6 && $include_saturdays) || ($holyday->dateTime->format('w') == 0 && $include_sundays))
        {

            if ($holyday->IsHolyday)
            {
                $holyday->HolydayName = $holyday->HolydayName . " and " . $holyday->dateTime->format('w');
                $holyday->Priority = 1;
            }
            else
            {
                $holyday->HolydayName = $holyday->dateTime->format('l');
            }
            $holyday->IsHolyday = true;
            $holyday->Priority = 1;
        }




    return clone $holyday;
    }

    public static function isNextPrevAHolyday(HolyDay &$holyday,&$holydaysList , $PrevNex,$include_saturdays,$include_sundays)
    {
        $newDate =clone $holyday->dateTime;
        $hd;
        if($PrevNex>0)
        {
            $hd = new HolyDay($newDate->add(new DateInterval('P'.$PrevNex.'D')));
        }
        else
        {
            $Absval = abs($PrevNex);
            $hd = new HolyDay($newDate->sub(new DateInterval('P'.$Absval.'D')));
        }

        $hd = self::CheckIsHolyDay($hd,$include_saturdays,$include_sundays);
        if ($hd->IsHolyday)
        {
            if ($PrevNex > 0)
            {
            $holyday->NextIsHolyday = true;
            }
            else if ($PrevNex < 0)
            {
                $holyday->PreviousIsHolyday = true;
            }
            $holydaysList[] = $hd;

        return true;
        }
        else
        {
            return false;
        }
    }
}


